<?php

/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 22:11
 */

use Entity\Ad;
use Entity\Cv;
use Entity\User;
use Handlebars\Handlebars;

class HomeController extends BaseController
{
    private $templatePath = __DIR__ . '/../templates/home.php';
    
    /**
     * HomeController constructor.
     * @param $options
     */
    function __construct($options)
    {
        parent::__construct($options);
    }
    
    public function indexAction()
    {
        $role = $this->getRole();

        $em = $this->em;

        $qbuilder = function($limit, $type) use($em) {

            $qb = $em->createQueryBuilder();

            switch ($type) {

                case Ad::class:

                    $qb
                        ->select('ad')
                        ->from('Entity\Ad', 'ad')
                        ->where($qb->expr()->eq('ad.isConfirmed', 1))
                        ->orderBy('ad.publishedAt', 'DESC')
                        ->setMaxResults($limit)
                    ;

                    break;

                case Cv::class:

                    $qb
                        ->select('cv')
                        ->from('Entity\Cv', 'cv')
                        ->orderBy('cv.createdAt', 'DESC')
                        ->setMaxResults($limit)
                    ;

                    break;

                default:
                    $qb = null;
            }

            return $qb;
        };

        switch (true){

            case Constants::STUDENT_ROLE === $role:
                /** @var Ad[] $ads */
                $ads = $qbuilder(10, Ad::class)->getQuery()->getResult();
                break;

            case Constants::EMPLOYER_ROLE === $role:
                /** @var Cv[] $cvs */
                $cvs = $qbuilder(10, Cv::class)->getQuery()->getResult();
                break;

            case Constants::ADMIN_ROLE === $role:
                /** @var \Doctrine\ORM\QueryBuilder $qb */
                $qb = $qbuilder(10, Ad::class);
                $qb->resetDQLPart('where');
                $qb->where($qb->expr()->eq('ad.isConfirmed', 0));
                $ads = $qb->getQuery()->getResult();
                break;

            default:

                $cvs = $qbuilder(3, Cv::class)->getQuery()->getResult();
                $ads = $qbuilder(3, Ad::class)->getQuery()->getResult();
        }

        $active_item = 'home';
        require $this->templatePath;
    }

    /**
     * About
     */
    public function aboutAction()
    {
        $active_item = 'about';

        $offContent = true;

        require __DIR__ . '/../templates/about.php';
    }
    
    /**
     * @param $request
     */
    public function getAdsAjaxAction($request)
    {
        $params = Utils::arraySerialization(['offset'], $request);

        if (!in_array(null, $params)) {

            $params = Utils::arraySerialization([
                'limit',
                'filters'

            ], $request, $params);

            $em = $this->em;

            $qb = $em->createQueryBuilder();
            $expr = $qb->expr();

            $qb
                ->select('ad')
                ->from('Entity\Ad', 'ad')
                ->where($qb->expr()->eq('ad.isConfirmed', $this->getRole() === Constants::ADMIN_ROLE ? 0 : 1));


            if ($params['filters']) {
                foreach ($params['filters'] as $filter => $value) {

                    switch (true) {
                        case ('sphere' === $filter && $value !== '*'):
                            $qb->andWhere($expr->eq('ad.sphere', $expr->literal($value)));
                            break;
                    }

                }
            }

            $qb
                ->orderBy('ad.publishedAt', 'DESC')
                ->setFirstResult($params['offset'])
                ->setMaxResults($params['limit'] ? $params['limit'] : 10)
            ;

            /** @var Ad[] $ads */
            $ads = $qb->getQuery()->getResult();

            $isCvSendAble = ($user = $this->currentUser) && $user->getRole() === Constants::STUDENT_ROLE && $user->getPerson()->getCvs()->count();

            $rootActionsBlockHtml = null;
            if (Constants::ADMIN_ROLE === $this->getRole()) {

                /** @var Handlebars $engine */
                $engine = new Handlebars;
                $rootActionsBlockHtml = $engine->render(file_get_contents(__DIR__ . '/../templates/hbs/rootActionsBlock.hbs'), []);
            }

            $result = [];
            foreach ($ads as $ad) {

                $person = $ad->getPerson();

                $result[] = [
                    'id'              => $ad->getId(),
                    'name'            => ucfirst($ad->getName()),
                    'details'         => strip_tags($ad->getDetails()),
                    'salary'          => $ad->getSalary(),
                    'published_at'    => date('d/m/Y H:i:s', $ad->getPublishedAt()),
                    'user_img_url'    => $person->getUser()->getImgUrl(),
                    'sphere'          => Utils::getSpheresTitles()[ $ad->getSphere() ],
                    'person'          => [
                        'last_name'    => $person->getLastName(),
                        'full_name'    => $person->getFullName(),
                        'organisation' => $person->getOrganisation()
                    ],
                    'is_cv_send_able' => $isCvSendAble,
                    'html'            => $rootActionsBlockHtml
                ];
            }

        } else {

            $result = [
                'error' => 1,
                'message' => 'Неверные данные'
            ];
        }
        
        echo json_encode($result);
    }

    /**
     * @param $request
     * @throws Exception
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function cvSendingAjaxAction($request)
    {
        if (!($user = $this->currentUser)) {
            throw new Exception('Access denied');
        }

        if ($user->getRole() !== Constants::STUDENT_ROLE || !$user->getPerson()->getCvs()->count()) {
            throw new Exception('Access denied');
        }

        $params = Utils::arraySerialization([
            'ad_id',
            'flash'

        ], $request);

        if (!in_array(null, $params)) {

            if ($params['flash'] === $_SESSION['previos_flash']) {

                /** @var Ad $ad */
                if ($ad = $this->em->find('Entity\Ad', $params['ad_id'])) {
                    /** @var Cv $cv */
                    $cv = $user->getPerson()->getCvs()[0];

                    /** @var Handlebars $engine */
                    $engine = new Handlebars;

                    try {

                        $html = $engine->render(
                            file_get_contents(__DIR__ . '/../templates/hbs/cv.hbs'), [
                                'cv' => Utils::cvToArray($cv, false),
                                'student' => Utils::personInformationToArray($cv->getPerson())
                            ]
                        );

                        (new Letter())
                            ->setTo([ $ad->getPerson()->getUser()->getEmail() => '' ])
                            ->setFrom("yakoann03@gmail.com", "Ваш lectern")
                            ->setSubject("Резюме от " . $cv->getPerson()->getFullName())
                            ->setBody($html)
                            ->send()
                        ;
                        
                        $result = [
                            'type' => 'success',
                            'message' => 'Ваше резюме успешно отправлено работодателю!'
                        ];

                    } catch (Exception $exc) {

                        $result = [
                            'type' => 'error',
                            'message' => 'Ошибка сервера №' . $exc->getCode()
                        ];

                    }

                } else {

                    $result = [
                        'type' => 'error',
                        'message' => 'Выбранное объявление не существует'
                    ];
                }

            } else {

                $result = [
                    'type' => 'error',
                    'message' => 'Ошибка доступа'
                ];
            }

        } else {

            $result = [
                'type' => 'error',
                'message' => 'Неверные данные'
            ];
        }

        echo json_encode($result);
    }


    /**
     * @param $request
     */
    public function getCvsAjaxAction($request)
    {
        $params = Utils::arraySerialization(['offset'], $request);

        if (!in_array(null, $params)) {

            $params = Utils::arraySerialization(['limit'], $request, $params);

            $em = $this->em;

            $qb = $em->createQueryBuilder();
            $expr = $qb->expr();

            $qb
                ->select('cv')
                ->from('Entity\Cv', 'cv')
                ->where($expr->eq('cv.accessType', $expr->literal(Constants::ACCESS_TYPE_PUBLIC)))
                ->orderBy('cv.createdAt', 'DESC')
                ->setFirstResult($params['offset'])
                ->setMaxResults($params['limit'] ? $params['limit'] : 10)
            ;

            /** @var Cv[] $cvs */
            $cvs = $qb->getQuery()->getResult();

            $result = [];
            foreach ($cvs as $cv) {

                $person = $cv->getPerson();

                $result[] = [
                    'id'              => $cv->getId(),
                    'sphere'          => Utils::getSpheresTitles()[ $cv->getSphere() ],
                    'education'       => Utils::getEducationsTitles()[ $cv->getEducation() ],
                    'skills'          => $cv->getSkills(),
                    'work_experience' => Utils::getWorkExperiencesTitles()[ $cv->getWorkExperience() ],
                    'hobbies'         => $cv->getHobbies(),
                    'about'           => $cv->getAbout(),
                    'user_img_url'    => $cv->getPerson()->getUser()->getImgUrl(),
                    'created_at'      => date('d/m/Y', $cv->getCreatedAt()),
                    'person'          => [
                        'last_name'    => $person->getLastName(),
                        'full_name'    => $person->getFullName(),
                        'organisation' => $person->getOrganisation()
                    ],
                ];
            }

        } else {

            $result = [
                'type' => 'error',
                'message' => 'Неверные данные'
            ];
        }

        echo json_encode($result);
    }

    /**
     * IFRAME LOAD
     */
    public function animationAction()
    {
        require __DIR__ . '/../templates/blocks/animation.php';
    }
}