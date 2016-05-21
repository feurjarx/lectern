<?php $title = 'Доска объявлений'; ?>

<?php ob_start() ?>
    <link href="../assets/css/ads.css" rel="stylesheet">
<?php $css = ob_get_clean() ?>

<?php ob_start() ?>
<?php $beforeJs = ob_get_clean() ?>

<?php ob_start() ?>
<?php $afterJs = ob_get_clean() ?>

<?php ob_start() ?>

    <div class="row margin-none">
        <h2 class="content-title">Свежие объявления</h2>
    </div>

    <ul class="list-group ads">

        <?php if (isset($ads) and count($ads)):?>

            <?php /** @var \Entity\Ad[] $ads */ ?>
            <?php foreach ($ads as $index => $ad): ?>

                <li class="col-lg-12 col-md-12 col-xs-12 list-group-item ad">

                    <?php include __DIR__ . '/blocks/adBlock.php'?>

                </li>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="alert alert-info" style="padding: 10px; margin: 10px 0;">
                <strong>
                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                    <span class="sr-only">Информация!</span>
                    <span>Объявлений не найдено</span>
                </strong>
            </div>

        <?php endif; ?>

    </ul>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>