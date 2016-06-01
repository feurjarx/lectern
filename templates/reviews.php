<?php
/**
 * Created by PhpStorm.
 * Date: 01.06.2016
 * Time: 20:54
 */
/** @var BaseController $this */
?>

<?php ob_start() ?>
    <link href="/assets/css/brick-wall.css" rel="stylesheet">
<?php $css = ob_get_clean() ?>

<?php ob_start() ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<?php $beforeJs = ob_get_clean() ?>

<?php ob_start() ?>
    <script src="/bower_components/jRate/src/jRate.js"></script>
    <script src="/assets/js/reviews-page.js"></script>
<?php $afterJs = ob_get_clean() ?>

<?php ob_start() ?>

    <div id="top-panel">

        <div class="visible-part col-lg-12 col-md-12 col-xs-12">

            <div class="col-lg-8 col-md-8 col-xs-12">
                <h2 class="content-title">Отзывы пользователей сайта</h2>
            </div>

            <div class="hidden-part-toggle flexbox col-lg-4 col-md-4 col-xs-12" style="order: 2">
                <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#review-poster" aria-expanded="false"
                        onclick="$(this).toggleClass('btn-primary')">

                    <b>Оставить отзыв</b>
                    &nbsp;
                    <i class="fa fa-pencil"></i>
                </button>
            </div>
        </div>

        <form id="review-poster" class="hidden-part collapse fade col-lg-12 col-md-12 col-xs-12">
            <div class="col-lg-10 col-md-10 col-xs-12">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Заголовок</span>
                        <input required type="text" class="form-control" name="title" placeholder="Введите заголовок отзыва">
                    </div>
                </div>
                <div class="form-group">
                    <textarea required style="resize: vertical" rows="5" class="form-control" name="description"
                              placeholder="Пожалуйста, напишите преимущества и недостатки нашего сайта"></textarea>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-12">
                <div class="g-recaptcha" data-size="compact" data-sitekey="6LcxfSETAAAAAM9wtdV2QpraUlfp7tVsXoVsC1KB"></div>

                <div class="flexbox">

                    <div id="jRate" style="align-self: center"></div>
                    <input type="hidden" name="rating" value="1">

                    <button type="submit" class="btn btn-sm btn-success pull-right" style="margin-left: 4px">
                        <span>ОК <i class="fa fa-paper-plane"></i></span>
                    </button>
                </div>
            </div>
        </form>

    </div>

    <ul class="scrollbox list-group brick-wall list-unstyled" data-hbs="/templates/hbs/reviewBlock.hbs" data-ajax-url="/get/reviews">
        <?php if (isset($reviews) and count($reviews)):?>

            <?php /** @var \Entity\Review[] $reviews */ ?>
            <?php foreach ($reviews as $index => $review): ?>

                <li class="col-lg-12 col-md-12 col-xs-12 list-group-item brick scroller-item" data-id="<?php echo $review->getId(); ?>">

                    <?php include __DIR__ . '/blocks/reviewBlock.php'?>

                </li>

            <?php endforeach; ?>

        <?php else: ?>

            <li class="alert alert-info scroller-item">
                <strong>
                    <span>Отзывов пока нет</span>
                </strong>
            </li>

        <?php endif; ?>

    </ul>

    <input type="hidden" name="flash" value="<?php echo $_SESSION['flash']; ?>">

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>

