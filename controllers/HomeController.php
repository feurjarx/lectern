<?php

/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 22:11
 */

use Entity\Ad;
use Entity\Cv;
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
        $em = $this->em;

        $qb = $em->createQueryBuilder();

        $qb
            ->select('ad')
            ->from('Entity\Ad', 'ad')
            ->orderBy('ad.publishedAt', 'DESC')
            ->setMaxResults(10)
        ;

        /** @var Ad[] $ads */
        $ads = $qb->getQuery()->getResult();

        $active_item = 'home';
        
        require $this->templatePath;
    }
    
    public function aboutAction()
    {
        $active_item = 'about';

        $offContent = true;

        require __DIR__ . '/../templates/about.php';
    }


    public function getAdsAjaxAction($request)
    {
        $result = [];
        
        $params = Utils::arraySerialization(['offset'], $request);

        if (!in_array(null, $params)) {

            $params = Utils::arraySerialization(['limit'], $request, $params);

            $em = $this->em;

            $qb = $em->createQueryBuilder();

            $qb
                ->select('ad')
                ->from('Entity\Ad', 'ad')
                ->orderBy('ad.publishedAt', 'DESC')
                ->setFirstResult($params['offset'])
                ->setMaxResults($params['limit'] ? $params['limit'] : 10)
            ;

            /** @var Ad[] $ads */
            $ads = $qb->getQuery()->getResult();

            $isCvSendAble = ($user = $this->currentUser) && $user->getRole() === Constants::STUDENT_ROLE && $user->getPerson()->getCvs()->count();
            
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
                    'person'          => [
                        'last_name'    => $person->getLastName(),
                        'full_name'    => $person->getFullName(),
                        'organisation' => $person->getOrganisation()
                    ],
                    'is_cv_send_able' => $isCvSendAble
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
     */
    public function cvSendingAjaxAction($request)
    {
        if (!($user = $this->currentUser)) {
            throw new \Symfony\Component\Finder\Exception\AccessDeniedException();
        }

        if ($user->getRole() !== Constants::STUDENT_ROLE || !$user->getPerson()->getCvs()->count()) {
            throw new \Symfony\Component\Finder\Exception\AccessDeniedException();
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
}