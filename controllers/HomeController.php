<?php

/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 22:11
 */

use Entity\Ad;

require_once __DIR__ . '/../entity/Ad.php';

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
        /*$em = $this->em;

        $qb = $em->createQueryBuilder();

        $qb
            ->select('ad')
            ->from('Entity\Ad', 'ad')
            ->orderBy('ad.publishedAt', 'DESC')
            ->setMaxResults(10)
        ;*/

        /** @var Ad[] $ads */
//        $ads = $qb->getQuery()->getResult();

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

            $result = [];
            foreach ($ads as $ad) {

                $person = $ad->getPerson();

                $result[] = [
                    'id'           => $ad->getId(),
                    'name'         => ucfirst($ad->getName()),
                    'details'      => strip_tags($ad->getDetails()),
                    'salary'       => $ad->getSalary(),
                    'published_at' => date('d/m/Y H:i:s', $ad->getPublishedAt()),
                    'user_img_url' => $person->getUser()->getImgUrl(),
                    'person'       => [
                        'last_name'    => $person->getLastName(),
                        'full_name'    => $person->getFullName(),
                        'organisation' => $person->getOrganisation()
                    ]
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
}