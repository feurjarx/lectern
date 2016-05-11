<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 22:17
 */
require_once __DIR__ . '/../entity/User.php';
require_once __DIR__ . '/../entity/Company.php';

use Entity\Company;
use Entity\Ad;


class CabinetController extends BaseController
{
    /**
     * CabinetController constructor.
     * @param $options
     */
    function __construct($options)
    {
        parent::__construct($options);
    }

    /**
     * @var string
     */
    private $templatePath = __DIR__ . '/../templates/cabinet.php';

    /**
     * @param $role
     */
    function indexAction($role) {
        
        if ($this->currentUser->getRole() !== $role) {
            header('Location: ' . Constants::getHttpHost() . '/' . 'access/denied');
            exit();
        }

        /*$c = new Company();
        $c
            ->setName('test')
            ->setAddress('test')
        ;*/

        //$this->em->persist($c);
        /** @var Company $c */

        /*$c = $this->em->find('Entity\Company', 54);
        
        $a = new Ad();
        $a
            ->setName('test')
            ->setSalary(1)
            ->setDetails('test')
            ->setCompany($c)
            ->setUser($this->em->getReference('Entity\User', $this->currentUser->getId()))
        ;

        $this->em->persist($a);
        $this->em->flush();

        var_dump($a);*/
        //die();

        switch ($role) {
            case Constants::STUDENT_ROLE:
                break;
            case Constants::EMPLOYER_ROLE:

                /** @var Ad[] $ads */
                $ads = $this->currentUser->getAds();
                break;
        }

        require_once $this->templatePath;
    }
}