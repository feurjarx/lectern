<?php $title = 'Доска объявлений'; ?>

<?php ob_start() ?>
    <link href="../assets/css/about.css" rel="stylesheet" type="text/css">
<?php $css = ob_get_clean() ?>

<?php ob_start() ?>
<?php $beforeJs = ob_get_clean() ?>

<?php ob_start() ?>
<?php $afterJs = ob_get_clean() ?>

<?php ob_start() ?>

    <div class="content-effect hidden-xs" style="top: inherit; bottom: 0">
        <div class="visible-effect" style="width: 405px">
            <p class="effect">Кафедра
                <span class="glyphicon glyphicon-hand-right" style="vertical-align: middle"></span>
            </p>
            <ul class="effect" style="padding-left: 210px">
                <li>теперь</li>
                <li>найти</li>
                <li>работу</li>
                <li>просто</li>
            </ul>
        </div>
    </div>

    <div class="jumbotron" style="font-family: 'Muli'; margin-top: 10px">
        <h2>Добро пожаловать на кафедру!</h2>
        <p>Если ты студент - найди себе работу, если ты работодатель - предложи вакансию студентам!</p>

        <?php if (is_null($this->currentUser)): ?>

            <p class="text-center">
                <a class="btn btn-primary btn-large" href="/signup">Регистрация</a>
            </p>

        <?php endif ?>

    </div>

    <div class="pull-left"><i class="fa-5x fa fa-graduation-cap" aria-hidden="true"></i></div>
    <div class="pull-right"><i class="fa-5x fa fa-briefcase" aria-hidden="true"></i></div>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>