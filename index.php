<?php
require_once 'bootstrap.php';
require_once 'model/Constants.php';
require_once 'model/Utils.php';
require_once 'controllers/BaseController.php';

foreach (scandir(__DIR__ . '/controllers') as $f) {
    if  (!($f === '.' || $f === '..' || $f === 'BaseController.php')) {
        require_once __DIR__ . '/controllers/' . $f;
    }
}

$options = [
    'em'   => $em,
    'conf' => [
        'root_dir' => $_SERVER['DOCUMENT_ROOT']
    ]
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch (true) {

    // INDEX
    case (in_array($uri, ['/index.php', '/']) !== FALSE):
        (new HomeController($options))->indexAction();
        break;
    case ('/about' === $uri):
        (new HomeController($options))->aboutAction();
        break;
    case ('/get/ads' === $uri && Utils::isAjax() && $_POST):
        (new HomeController($options))->getAdsAjaxAction($_POST);
        break;

    

    // SIGNUP
    case ('/signup' === $uri):
        (new SignUpController($options))->signUpAction([
            'POST'  => $_POST,
            'FILES' => $_FILES
        ]);
        break;
    case ('/signup/confirm' === $uri && isset($_GET['id']) && isset($_POST['password']) && isset($_POST['new_pass_session'])):
        (new SignUpController($options))->signUpFinallyAction($_REQUEST);
        break;
    case ('/signup/confirm' === $uri && isset($_GET['id']) && isset($_GET['hash'])):
        (new SignUpController($options))->signUpConfirmAction($_GET);
        break;

    case ('/auth' === $uri && isset($_POST['login']) && isset($_POST['password'])):
        (new AuthController($options))->signInAction($_POST);
        break;
    case ('/logout' === $uri && isset($_POST['flash'])):
        (new AuthController($options))->logoutAction($_POST);
        break;

    // UPLOAD
    case ('/upload' === $uri && isset($_POST) && isset($_FILES)):
        (new UploadAjaxContoller($options))->uploadAction([
            'POST'  => $_POST,
            'FILES' => $_FILES
        ]);
        break;

    // CABINET
    case ('/'. Constants::STUDENT_ROLE . '/cabinet' === $uri):
        (new CabinetController($options))->indexAction(Constants::STUDENT_ROLE);
        break;
    case ('/'. Constants::EMPLOYER_ROLE . '/cabinet' === $uri):
        (new CabinetController($options))->indexAction(Constants::EMPLOYER_ROLE);
        break;
    case ('/'. Constants::ADMIN_ROLE . '/cabinet' === $uri):
        (new CabinetController($options))->indexAction(Constants::EMPLOYER_ROLE);
        break;
    case ('/employer/ad/plus' === $uri && isset($_POST)):
        (new CabinetController($options))->createAjaxAction($_POST);
        break;
    case ('/employer/ad/remove' === $uri && isset($_POST)):
        (new CabinetController($options))->removeAjaxAction($_POST);
        break;

    // ERRORS
    case ('/access/denied' === $uri):
        (new ErrorController($options))->errorRenderAction(Constants::ERROR_ACCESS_DENIED);
        break;
    default:
        header('Status: 404 Not Found');
        (new ErrorController($options))->errorRenderAction(Constants::ERROR_NOT_FOUND);
}