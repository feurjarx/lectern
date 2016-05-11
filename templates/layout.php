<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo (isset($title) && $title) ? $title : 'Главная' ?>
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo Constants::getHttpHost(); ?>/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/bower_components/bootstrap-checkbox-x/css/checkbox-x.min.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/assets/css/layout.css" rel="stylesheet">

    <?php if (isset($css) && $css): ?>
        <?php echo $css ?>
    <?php endif; ?>

    <script src="<?php echo Constants::getHttpHost(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/bower_components/bootstrap-checkbox-x/js/checkbox-x.min.js"></script>

    <?php if (isset($beforeJs) && $beforeJs): ?>
        <?php echo $beforeJs ?>
    <?php endif; ?>

</head>

<?php $active_item = (isset($active_item) and $active_item) ? $active_item : 'home' ?>

<body>

    <div class="container-fluid min-height-100 height-100">

        <!-- Header -->
        <div class="row header">
            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                        <a class="navbar-brand" href="/" style="padding: 0 15px;">
                            <img src="/assets/img/logo.gif" class="img-rounded" alt="" style="max-height: 100%">
                        </a>
                    </div>
                    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">

                            <li class="<?php echo isset($active_item) && $active_item === 'home' ? 'active' : '' ?>">
                                <a href="/">Главная<span class="sr-only">(current)</span></a>
                            </li>

                            <?php if ($this->currentUser): ?>

                                <?php if (isset($this->currentUser) && $this->currentUser): ?>

                                    <li class="<?php echo isset($active_item) && $active_item === 'cabinet' ? 'active' : '' ?>">
                                        <a href="/<?php echo $this->currentUser->getRole(); ?>/cabinet">

                                            <?php if ($this->currentUser->getRole() === Constants::STUDENT_ROLE): ?>

                                                <span class="glyphicon glyphicon-education"></span>

                                            <?php else: ?>

                                                <span class="glyphicon glyphicon-briefcase"></span>

                                            <?php endif ?>

                                            <span>Личный кабинет</span>
                                        </a>
                                    </li>

                                <?php endif ?>
                                
                                <!--<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Другое <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Действие 1</a></li>
                                        <li><a href="#">Действие 2</a></li>
                                        <li><a href="#">Действие 3</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Другое действие</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Еще действие</a></li>
                                    </ul>
                                </li>-->

                            <?php endif; ?>

                        </ul>

                        <?php if ($this->currentUser): ?>

                            <?php include 'forms/profileForm.php'; ?>

                        <?php elseif (!(isset($signinFormOff) && $signinFormOff)): ?>

                            <?php include 'forms/signinForm.php'; ?>

                        <?php endif ?>
                        
                    </div>

                </div>
            </nav>
        </div>

        <!-- Main -->
        <div class="row main">
            <div class="col-lg-12 col-md-12 col-xs-12 height-100">

                <?php if (isset($content) && $content): ?>
                    <?php echo $content ?>
                <?php else: ?>

                    <div class="jumbotron">
                        <h2>
                            Hello, world!
                        </h2>
                        <p>
                            This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
                        </p>
                        <p>
                            <a class="btn btn-primary btn-large" href="#">Learn more</a>
                        </p>
                    </div>

                <?php endif ?>

            </div>
        </div>

        <!-- Footer -->
        <div id="footer" class="row well well-sm">
            <span class="label label-primary pull-right">АлтГТУ им. И.И. Ползунова, 2016</span>
        </div>


    </div>

    <?php if (isset($afterJs) && $afterJs): ?>
        <?php echo $afterJs ?>
    <?php endif; ?>
</body>

</html>
