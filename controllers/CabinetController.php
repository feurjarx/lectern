<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 22:17
 */
require_once __DIR__ . '/../entity/User.php';
require_once __DIR__ . '/../entity/Ad.php';

use Entity\Ad;

class CabinetController extends BaseController
{
    private $isVerify = true;
    /**
     * CabinetController constructor.
     * @param $options
     */
    function __construct($options)
    {
        parent::__construct($options);
        if ($this->isVerify && is_null($this->currentUser)) {
            header('Location: ' . Constants::getHttpHost() . '/' . 'access/denied');
            exit();
        }
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

    /**
     * @param $request
     * @throws \Doctrine\ORM\ORMException
     */
    public function createAjaxAction($request)
    {
        $params['name'] = isset($request['name']) ? $request['name'] : null;
        $params['details'] = isset($request['details']) ? $request['details'] : null;

        if (!in_array(null, $params)) {

            $ad = (new Ad())
                ->setName($params['name'])
                ->setDetails($params['details'])
                ->setUser($this->em->getReference('Entity\User', $this->currentUser->getId()))
            ;
            
            if (isset($request['salary']) && $request['salary']) {
                $ad->setSalary($request['salary']);
            }

            $this->em->persist($ad);
            $this->em->flush();

            $jsonResult = json_encode([
                'complete_id' => $ad->getId(),
                'type' => 'success',
                'message' => 'Объявление о работе успешно создано и опубликовано!'
            ]);

        } else {

            $jsonResult = json_encode([
                'type' => 'error',
                'message' => 'Неверные данные'
            ]);
        }
        
        echo $jsonResult;
    }

    /**
     * @param $request
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeAjaxAction($request)
    {
        if (isset($request['ids']) && $request['ids']) {

            /** @var Ad[] $ads */
            $em = $this->em;
            $ads = $this->em->getRepository('Entity\Ad')->findBy([
                'id' => $request['ids']
            ]);

            try {

                foreach ($ads as $ad) {
                    $em->remove($ad);
                }

                $em->flush();

                $jsonResult = json_encode([
                    'type' => 'success',
                    'message' => 'Объявления успешно удалены!'
                ]);

            } catch (Exception $e){

                $jsonResult = json_encode([
                    'type' => 'error',
                    'message' => 'Серверная ошибка!'
                ]);
            }

        } else {

            $jsonResult = json_encode([
                'type' => 'error',
                'message' => 'Неверные данные'
            ]);
        }

        echo $jsonResult;
    }
}