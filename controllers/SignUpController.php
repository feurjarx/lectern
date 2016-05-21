<?php
/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 21:34
 */

require_once __DIR__ . '/../entity/User.php';
require_once __DIR__ . '/../entity/Person.php';
require_once __DIR__ . '/../entity/Address.php';
require_once __DIR__ . '/../entity/Contact.php';

use Entity\User;
use Entity\Person;
use Entity\Address;
use Entity\Contact;

class SignUpController extends BaseController
{
    /**
     * SignUpController constructor.
     * @param $options
     */
    function __construct($options)
    {
        parent::__construct($options);
        if ($this->currentUser) {
            header('Location: ' . Constants::getHttpHost() . '/' . 'access/denied');
            exit();
        }
    }

    private $templatePath = __DIR__ . '/../templates/signup.php';

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function signUpAction($request)
    {
        $post = $request['POST'];

        $params = Utils::arraySerialization(['email', 'role'], $post);

        if (count($params) && !in_array(null, $params)) {

            $em = $this->em;

            $user = $em->getRepository('Entity\User')->findBy([
                'email' => $params['email']
            ]);

            if ($user) {

                $errMsg = 'Пользователь с почтовым ящиком ' . $params['email'] . ' уже существует. Введите другой.';

                unset($email);

            } else {

                $user = new User();
                $person = new Person();

                try {

                    $user
                        ->setEmail($params['email'])
                        ->setRole($params['role'])
                        ->setIsConfirmed(false)
                    ;

                    $em->persist($user);

                    $person->setUser($user);
                    $em->persist($person);

                    $em->flush();

                    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                        ->setUsername('yakoann03@gmail.com')
                        ->setPassword('Pm4h1nCkCZd4');

                    $mailer = Swift_Mailer::newInstance($transport);

                    $confirmUrl = $_SERVER['HTTP_HOST'] . '/signup/confirm?' . 'id=' . $user->getId() . '&hash=' . md5( strval($user->getCreatedAt()) . $user->getPassword() );

                    $message = Swift_Message::newInstance();
                    $message
                        ->setTo([ $params['email'] => '' ])
                        ->setFrom("yakoann03@gmail.com", "Ваш lectern")
                        ->setSubject("Подтверждение регистрации")
                        ->setBody('Добро пожаловать на <a href="http://lectern/">lectern</a>. Для подтверждения регистрации перейдите по <a href="' . $confirmUrl . '">http://'. $confirmUrl .'</a>', 'text/html')
                    ;

                    $mailer->send($message);

                    $isSuccess = 1;
                    $doneMsg = 'Заявка принята. На почтовый ящик ' . $params['email'] . ' отправлено письмо с подтверждением.';

                } catch (Exception $exp) {

                    switch (true) {
                        case $exp instanceof \Doctrine\DBAL\Exception\DriverException:
                            header('error: db');
                            break;
                        case $exp instanceof Swift_TransportException:

                            $em->remove($person);
                            $em->remove($user);
                            $em->flush();

                            header('error: smtp');
                            break;

                    }

                    $errMsg = 'Ошибка на сервере' . ($exp->getCode() ? (' (' . $exp->getCode() .').') : '.');
                }
            }
        }

        $active_item = 'none';
        require $this->templatePath;
    }

    /**
     * @param $request
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function signUpConfirmAction($request)
    {
        $params = Utils::arraySerialization([
            'id',
            'hash'
        ], $request);

        if (!in_array(null, $params)) {

            $user = $this->em->find('Entity\User', $params['id']);

            /** @var User $user */
            if ($user && $params['hash'] === md5( strval($user->getCreatedAt()) . $user->getPassword() )) {

                if ($user->getIsConfirmed()) {

                    $isConfirmError = 1;
                    $errMsg = 'Вы уже подтверждали свою регистрацию. Если нет, тогда обратитесь в техническую поддержку сайта.';

                    $em = $this->em;
                    $em->remove($user);
                    $em->flush();

                } else {

                    $user->setIsConfirmed(true);
                    
                    $newPassSession = md5($user->getEmail() . $user->getPassword());
                    $isConfirmSuccess = 1;

                    $this->em->flush();
                }

            } else {

                $isConfirmError = 1;
                $errMsg = 'Неверные данные.';
            }

        } else {

            $isConfirmError = 1;
            $errMsg = 'Неверные данные.';
        }

        $active_item = 'none';
        require $this->templatePath;
    }

    /**
     * @param $request
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function signUpFinallyAction($request)
    {

        $params = Utils::arraySerialization([
            'id',
            'password',
            'new_pass_session'

        ], $request);

        if (!in_array(null, $params) && is_numeric($params['id'])) {

            /** @var User $user */
            $user = $this->em->find('Entity\User', $params['id']);

            if ($user && md5($user->getEmail()) === $params['new_pass_session']) {

                $params = Utils::arraySerialization([
                    'last_name',
                    'first_name',
                    'gender',
                    'organisation',
                    'phone',
                    'city'
                ], $request, $params);
                
                if (!in_array(null, $params)) {

                    $em = $this->em;

                    $params = Utils::arraySerialization([
                        'street',
                        'house_number',
                        'apartment_number',
                        'websites',
                        'date_birth',
                        'father_name',
                        'img_url'

                    ], $request, $params);
                    
                    $address = new Address();
                    $address
                        ->setCity($params['city'])
                        ->setStreet($params['street'])
                        ->setHouseNumber($params['house_number'])
                        ->setApartmentNumber($params['apartment_number'])
                    ;

                    $em->persist($address);

                    $contact = new Contact();
                    $contact
                        ->setAddress($address)
                        ->setPhone($params['phone'])
                        ->setWebsites($params['websites'])
                    ;

                    $em->persist($contact);

                    $person = $user->getPerson();

                    $person
                        ->setContact($contact)
                        ->setGender($params['gender'])
                        ->setOrganisation($params['organisation'])
                        ->setLastName($params['last_name'])
                        ->setFirstName($params['first_name'])
                        ->setFatherName($params['father_name'])
                        ->setDateBirth(new DateTime($params['date_birth']))
                    ;

                    $user
                        ->setimgUrl($params['img_url'])
                        ->setPassword(md5($params['password']))
                        ->setIsConfirmed(true)
                    ;

                    try {

                        $this->em->flush();

                        header('Location: ' . Constants::getHttpHost());
                        exit();

                    } catch(Exception $exp) {

                        $isConfirmError = 1;
                        header('error: db');
                    }

                } else {

                    $isConfirmError = 1;
                }

            } else {

                $isConfirmError = 1;
            }

        } else {

            $isConfirmError = 1;

        }

        if ($isConfirmError) {
            $errMsg = isset($errMsg) ? $errMsg : 'Неверные данные.';
        }

        $active_item = 'none';
        require $this->templatePath;
    }
}