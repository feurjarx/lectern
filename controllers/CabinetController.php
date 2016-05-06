<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 22:17
 */
require_once __DIR__ . '/../entity/User.php';

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

        require_once $this->templatePath;
    }
}