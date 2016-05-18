<?php
/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 21:34
 */

use Doctrine\ORM\EntityManager;
use Entity\User;

require_once __DIR__ . '/../model/Cryptograph.php';

class BaseController
{
    /**
     * BaseController constructor.
     * @param $options
     */
    function __construct($options) {

        $this->em = $options['em'];
        $this->conf = $options['conf'];

        $this->initCurrentUser($_COOKIE);

        if (isset($options['is_verify']) && $options['is_verify'] && is_null($this->currentUser)) {
            header('Location: ' . Constants::getHttpHost() . '/' . 'access/denied');
            exit();
        }
    }

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @return mixed
     */
    protected $conf;

    /**
     * @var User
     */
    protected $currentUser = null;

    /**
     * @var string
     */
    protected $flash;
    
    /**
     * @return User
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    /**
     * @param $cookie
     * @return $this
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function initCurrentUser($cookie)
    {
        session_start();

        if (isset($_SESSION['current_user_id']) && $_SESSION['current_user_id']) {

            $this->currentUser = $this->em->getRepository('Entity\User')->find($_SESSION['current_user_id']);

        } else {

            if (isset($cookie['uid']) && $cookie['uid'] && isset($cookie['vid']) && $cookie['vid']) {

                $crypto = new Cryptograph($cookie['vid']);

                $currentUserId = $crypto->decrypt($cookie['uid'], $_SERVER['HTTP_HOST']);

                if ($currentUserId && is_string($currentUserId)) {

                    $currentUserId = (int)$currentUserId;

                    $qb = $this->em->createQueryBuilder();

                    $qb
                        ->select('u')
                        ->from('Entity\User', 'u')
                        ->where($qb->expr()->eq('u', $currentUserId))
                    ;

                    $this->currentUser = $qb->getQuery()->getOneOrNullResult();

                    if ($this->currentUser) {
                        $_SESSION['current_user_id'] = $currentUserId;
                    }

                } else {

                    $this->currentUser = null;
                }

            } else {

                $this->currentUser = null;
            }
        }

        $_SESSION['previos_flash'] = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
        $_SESSION['flash'] = $this->flash = $this->currentUser  ? md5(time() . $this->currentUser->getEmail()) : null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConf()
    {
        return $this->conf;
    }

    /**
     * @param $conf
     * @return $this
     */
    public function setConf($conf)
    {
        $this->conf = $conf;
        return $this;
    }
}