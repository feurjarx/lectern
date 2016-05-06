<?php

/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 22:11
 */
class HomeController extends BaseController
{
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
        $active_item = 'home';
        require __DIR__ . '/../templates/layout.php';
    }
}