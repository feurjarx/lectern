<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 22:17
 */
require_once __DIR__ . '/../entity/User.php';
require_once __DIR__ . '/../entity/Ad.php';
require_once __DIR__ . '/../entity/Person.php';

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
                $ads = $this->currentUser->getPerson()->getAds();
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
        $params = Utils::arraySerialization([
            'name',
            'details'

        ], $request);

        if (!in_array(null, $params)) {

            $params = Utils::arraySerialization(['salary'], $request, $params);

            $ad = (new Ad())
                ->setName($params['name'])
                ->setDetails($params['details'])
                ->setPerson($this->em->getReference('Entity\Person', $this->currentUser->getPerson()->getId()))
                ->setSalary($params['salary'])
            ;

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

            $ads = $em->getRepository('Entity\Ad')->findBy([
                'id' => $request['ids']
            ]);

            $badAdsIds = [];
            foreach ($ads as $ad) {

                try {

                    $em->remove($ad);
                    $em->flush();

                } catch (Exception $e) {

                    $badAdsIds[] = $ad->getId();
                    continue;
                }
            }

            switch(true) {
                case (count($request['ids']) == count($badAdsIds)):

                    $jsonResult = json_encode([
                        'type' => 'error',
                        'message' => 'Внимание! Ни одно объявление не удалено. Обратитесь в тех. поддержку'
                    ]);
                    break;

                case (count($badAdsIds) > 0):

                    $jsonResult = json_encode([
                        'type' => 'warning',
                        'message' => 'Внимание! Некоторые объявление не были удалены. Обратитесь в тех. поддержку',
                        'complete_ids' => array_diff($request['ids'], $badAdsIds)
                    ]);
                    break;

                case (count($badAdsIds) == 0):

                    $jsonResult = json_encode([
                        'type' => 'success',
                        'message' => 'Успешно! Отмеченные объявления были удалены',
                        'complete_ids' => $request['ids']
                    ]);
                    break;

                default:
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