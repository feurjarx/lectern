<?php
include 'requires.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$options = [
    'em'    => $em,
    'conf'  => [
        'root_dir' => $_SERVER['DOCUMENT_ROOT']
    ],
    'route' => $uri
];

switch (true) {

    // INDEX
    case (in_array($uri, ['/index.php', '/']) !== FALSE):
        (new HomeController($options))->indexAction();
        break;
    case ('/about' === $uri):
        (new HomeController($options))->aboutAction();
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
    case ('/cabinet' === $uri):
        (new CabinetController($options))->indexAction();
        break;

    // AD
    case ('/employer/ad/plus' === $uri && isset($_POST) && Utils::isAjax()):
        (new CabinetController($options))->createAdAjaxAction($_POST);
        break;
    case ('/employer/ad/remove' === $uri && isset($_POST) && Utils::isAjax()):
        (new CabinetController($options))->removeAdAjaxAction($_POST);
        break;
    case ('/get/ads' === $uri && Utils::isAjax() && $_POST):
        (new HomeController($options))->getAdsAjaxAction($_POST);
        break;
    case (isset($_SESSION['flash']) && ('/ad/accept/' . $_SESSION['flash']) === $uri && Utils::isAjax() && $_POST):
        (new AdminController($options))->adProcessingAction($_POST);
        break;
        

    // CV
    case ('/student/cv/save' === $uri && isset($_POST) && Utils::isAjax()):
        (new CabinetController($options))->saveCvAjaxAction($_POST);
        break;
    case ('/get/cvs' === $uri && Utils::isAjax() && $_POST):
        (new HomeController($options))->getCvsAjaxAction($_POST);
        break;

    case ('/student/cv/send' === $uri && isset($_POST) && Utils::isAjax()):
        (new HomeController($options))->cvSendingAjaxAction($_POST);
        break;

    // VACANCIES
    case ('/vacancies' === $uri):
        (new VacanciesController($options))->indexAction();
        break;
    
    // REVIEWS
    case ('/reviews' === $uri):
        (new ReviewsController($options))->indexAction();
        break;
    case ('/review/new' === $uri && Utils::isAjax() && $_POST):
        (new ReviewsController($options))->createReviewAction($_POST);
        break;
    

    // ERRORS
    case ('/access/denied' === $uri):
        (new ErrorController($options))->errorRenderAction(Constants::ERROR_ACCESS_DENIED);
        break;

    // IFRAME ANIMATION
    case ('/animation' === $uri):

        $options['is_flash'] = false;

        (new HomeController($options))->animationAction();
        break;
    
    default:
        header('Status: 404 Not Found');
        (new ErrorController($options))->errorRenderAction(Constants::ERROR_NOT_FOUND);
}