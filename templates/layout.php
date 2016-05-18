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
    <link href="<?php echo Constants::getHttpHost(); ?>/bower_components/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/bower_components/noty/demo/animate.css" rel="stylesheet">
    
    <link href="<?php echo Constants::getHttpHost(); ?>/assets/css/layout.css" rel="stylesheet">

    <?php if (isset($css) && $css): ?>
        <?php echo $css ?>
    <?php endif; ?>

    <script src="<?php echo Constants::getHttpHost(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo Constants::getHttpHost(); ?>/bower_components/bootstrap-checkbox-x/js/checkbox-x.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/bower_components/jquery-serialize-object/dist/jquery.serialize-object.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>

    <script src="<?php echo Constants::getHttpHost(); ?>/assets/js/main.js"></script>
    
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

                            <li class="<?php echo isset($active_item) && $active_item === 'about' ? 'active' : '' ?>">
                                <a href="/about">О нас<span class="sr-only">(current)</span></a>
                            </li>
                            
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
            <div class="<?php if (isset($isContainer) and $isContainer): ?>container<?php else: ?>col-lg-12 col-md-12 col-xs-12<?php endif ?> height-100">

                <?php if (isset($content) && $content): ?>
                    <?php echo $content ?>
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
