<?php $title = 'Доска объявлений'; ?>

<?php ob_start() ?>
    <link href="../assets/css/ads.css" rel="stylesheet">
<?php $css = ob_get_clean() ?>

<?php ob_start() ?>
<?php $beforeJs = ob_get_clean() ?>

<?php ob_start() ?>
<?php $afterJs = ob_get_clean() ?>

<?php ob_start() ?>

    <div class="row" style="margin: 0">
        <h1>Свежие объявления</h1>
    </div>

    <ul class="list-group ads">

        <?php /** @var \Entity\Ad[] $ads */ ?>
        <?php foreach ($ads as $index => $ad): ?>

            <li class="col-lg-12 col-md-12 col-xs-12 list-group-item ad" href="#ad-details-<?php echo $ad->getId(); ?>" data-toggle="collapse">

                <?php include __DIR__ . '/blocks/adBlock.php'?>

            </li>

        <?php endforeach; ?>

    </ul>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>