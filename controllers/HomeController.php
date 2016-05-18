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
        
        $isContainer = true;
        
        require $this->templatePath;
    }

    public function aboutAction()
    {
        $active_item = 'about';
        $isContainer = true;
        require __DIR__ . '/../templates/about.php';
    }
}