<!DOCTYPE html>
<html>

<head>
    
    <title>
        <?php echo (isset($title) && $title) ? $title : 'Главная' ?>
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  vendor styles  -->
    <link href="<?php echo Constants::getHttpHost(); ?>/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/bower_components/bootstrap-checkbox-x/css/checkbox-x.min.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/bower_components/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/bower_components/noty/demo/animate.css" rel="stylesheet">

    <!--  vendor font styles  -->

    <!--  custom styles  -->
    <link href="<?php echo Constants::getHttpHost(); ?>/assets/css/layout.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/assets/css/bootstrap-overload.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/assets/css/header.css" rel="stylesheet">
    <link href="<?php echo Constants::getHttpHost(); ?>/assets/css/footer.css" rel="stylesheet">

    <?php if (isset($css) && $css): ?>
        <?php echo $css ?>
    <?php endif; ?>

    <!--  vendor scripts  -->
    <script src="<?php echo Constants::getHttpHost(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo Constants::getHttpHost(); ?>/bower_components/bootstrap-checkbox-x/js/checkbox-x.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/bower_components/jquery-serialize-object/dist/jquery.serialize-object.min.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>

    <!--  custom scripts  -->
    <script src="<?php echo Constants::getHttpHost(); ?>/assets/js/main.js"></script>
    
    <?php if (isset($beforeJs) && $beforeJs): ?>
        <?php echo $beforeJs ?>
    <?php endif; ?>

</head>

<?php $active_item = (isset($active_item) and $active_item) ? $active_item : 'home' ?>

<body>

    <div class="container-fluid min-height-100 height-100" style="overflow: auto">

        <!-- Header -->
        <div class="row header">
            <?php include __DIR__ . '/blocks/headerBlock.php'?>
        </div>

        <!-- Main -->
        <div class="row main">
            <div class="container <?php echo (isset($offContent) and $offContent) ? '' : 'content' ?>">

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
