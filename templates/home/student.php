<?php
/**
 * Created by PhpStorm.
 * Date: 30.05.2016
 * Time: 19:09
 */
/** @var BaseController $this */
?>

<?php if ($this->getCurrentUser()): ?>

    <?php if (Constants::ADMIN_ROLE === $this->getRole()): ?>

        <div class="row margin-none">
            <h2 class="content-title">Ожидающие подтверждения объявления вакансий</h2>
        </div>

    <?php endif; ?>

    <?php if (Constants::STUDENT_ROLE === $this->getRole()): ?>

        <div class="row margin-none" style="display: inline-block">
            <h2 class="content-title">Свежие вакансии</h2>
        </div>

    <?php endif; ?>

<?php else: ?>

    <div class="row margin-none text-center">
        <h2 class="content-title">Свежие вакансии</h2>
    </div>

<?php endif ?>

<ul class="scrollbox list-group brick-wall list-unstyled" data-hbs="<?php echo Utils::getHttpHost()?>/templates/hbs/adBlock.hbs" data-ajax-url="/get/ads">

    <?php if (isset($ads) and count($ads)):?>

        <?php /** @var \Entity\Ad[] $ads */ ?>
        <?php foreach ($ads as $index => $ad): ?>

            <li class="col-lg-12 col-md-12 col-xs-12 list-group-item brick scroller-item" data-id="<?php echo $ad->getId(); ?>">

                <?php include __DIR__ . '/../blocks/adBlock.php'?>

            </li>

        <?php endforeach; ?>

    <?php else: ?>

        <li class="alert alert-info scroller-item">
            <strong>
                <span class="sr-only">Внимание!</span>
                <span>Объявлений не найдено</span>
            </strong>
        </li>

    <?php endif; ?>

</ul>
