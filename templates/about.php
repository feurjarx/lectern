<?php $titlePage = 'Доска объявлений'; ?>

<?php ob_start() ?>
    <link href="../assets/css/about.css" rel="stylesheet" type="text/css">
<?php $css = ob_get_clean() ?>

<?php ob_start() ?>
<?php $beforeJs = ob_get_clean() ?>

<?php ob_start() ?>
<?php $afterJs = ob_get_clean() ?>

<?php ob_start() ?>

    <div class="content-effect hidden-xs" style="top: inherit; bottom: 0">
        <div class="visible-effect" style="width: 625px">
            <p class="effect">Теперь найти работу
                <span class="glyphicon glyphicon-hand-right" style="vertical-align: middle"></span>
            </p>
            <ul class="effect" style="padding-left: 420px">
                <li>легко</li>
                <li>просто</li>
                <li>удобно</li>
                <li>быстро</li>
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

    <div class="flexbox" style="height: 220px">
        <div style="order: 1; align-self: center">
            <i class="fa-5x fa fa-graduation-cap" aria-hidden="true"></i>
        </div>

        <div style="order: 2; flex: 1"></div>

        <div style="order: 3; align-self: center">
            <i class="fa-5x fa fa-briefcase" aria-hidden="true"></i>
        </div>
    </div>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>