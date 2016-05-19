<?php
/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 21:34
 */

require_once __DIR__ . '/../entity/User.php';

use Entity\User;

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
        $post = $request['post'];

        $firstName = isset($post['first_name']) && $post['first_name'] ? $post['first_name'] : null;
        $email = isset($post['email']) && $post['email'] ? $post['email'] : null;
        $role = isset($post['role']) && $post['role'] ? $post['role'] : null;
        $organisation = isset($post['organisation']) && $post['organisation'] ? $post['organisation'] : null;

        $lastName = isset($post['last_name']) && $post['last_name'] ? $post['last_name'] : '';
        $imgName = isset($post['img_name']) && $post['img_name'] ? $post['img_name'] : null;
        
        if ($firstName && $email && $role && $organisation) {

            $em = $this->em;

            $user = $em->getRepository('Entity\User')->findBy([
                'email' => $email
            ]);

            if ($user) {

                $errMsg = 'Пользователь с почтовым ящиком ' . $email . ' уже существует. Введите другой.';

                unset($email);

            } else {

                try {

                    $user = new User();

                    $user->setFirstName($firstName);
                    $user->setEmail($email);
                    $user->setRole($role);
                    $user->setOrganisation($organisation);

                    $user->setLastName($lastName);
                    $user->setimgUrl($imgName ? Constants::UPLOAD_PHOTOS_URL . $imgName : Constants::DEFAULT_PHOTO_URL);
                    
                    $em->persist($user);
                    $em->flush();

                    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                        ->setUsername('yakoann03@gmail.com')
                        ->setPassword('Pm4h1nCkCZd4');

                    $mailer = Swift_Mailer::newInstance($transport);

                    $confirmUrl = $_SERVER['HTTP_HOST'] . '/signup/confirm?' . 'id=' . $user->getId() . '&hash=' . md5( strval($user->getCreatedAt()) . $user->getPassword() );

                    $message = Swift_Message::newInstance();
                    $message
                        ->setTo([ $email => $firstName ])
                        ->setSubject("Подтверждение регистрации")
                        ->setBody($firstName . ', добро пожаловать на <a href="http://lectern/">lectern</a>. Для подтверждения регистрации перейдите по <a href="' . $confirmUrl . '">http://'. $confirmUrl .'</a>', 'text/html');

                    $message->setFrom("yakoann03@gmail.com", "Ваш lectern");

                    try {

                        $mailer->send($message);

                        $isSuccess = 1;
                        $doneMsg = 'Заявка принята. На почтовый ящик ' . $email . ' отправлено письмо с подтверждением.';

                    } catch (Exception $exp2) {

                        $em->remove($user);
                        $em->flush();

                        $errMsg = 'Ошибка на сервере' . ($exp2->getCode() ? (' (' . $exp2->getCode() .').') : '.');
                        header('Error: smtp');
                    }

                } catch (Exception $exp1) {

                    $errMsg = 'Ошибка на сервере' . ($exp1->getCode() ? (' (' . $exp1->getCode() .').') : '.');
                    header('Error: db');
                }
            }
        }

        $active_item = 'none';
        $signinFormOff = 1;
        require $this->templatePath;
    }

    /**
     * @param $request
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function signUpConfirmAction($request)
    {
        $userId = $request['id'];
        $confirmHash = $request['hash'];

        $user = $this->em->find('Entity\User', $userId);

        /** @var User $user */
        if ($user && $confirmHash === md5( strval($user->getCreatedAt()) . $user->getPassword() )) {

            $newPassSession = md5($user->getFirstName() . $user->getEmail() . $user->getPassword());
            $isConfirmSuccess = 1;

        } else {

            $isConfirmError = 1;
            $errMsg = 'Неверные данные.';
        }

        $signinFormOff = 1;
        require $this->templatePath;
    }

    /**
     * @param $request
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function signUpFinallyAction($request)
    {
        $userId = $request['id'];
        $password = $request['password'];
        $newPassSession = $request['new_pass_session'];

        if ($userId) {

            $user = $this->em->find('Entity\User', $userId);

            if ($user && md5( $user->getFirstName() . $user->getEmail()) === $newPassSession) {

                $user->setPassword(md5($password));
                $this->em->flush();

                header('Location: ' . Constants::getHttpHost());
                exit();

            } else {

                $isConfirmError = 1;
                $errMsg = 'Неверные данные.';
            }

        } else {

            $isConfirmError = 1;
            $errMsg = 'Неверные данные.';
        }

        $signinFormOff = 1;
        require $this->templatePath;
    }
}