<?php
/**
 * Created by PhpStorm.
 * Date: 30.05.2016
 * Time: 19:09
 */
?>

<?php if ($this->getCurrentUser()): ?>

    <div class="row margin-none" style="display: inline-block">
        <h2 class="content-title">Свежие резюме студентов</h2>
    </div>

<?php else: ?>

    <div class="row margin-none text-center">
        <h2 class="content-title">Свежие резюме студентов</h2>
    </div>

<?php endif ?>

<ul class="scrollbox list-group brick-wall list-unstyled" data-hbs="<?php echo Utils::getHttpHost()?>/templates/hbs/cvBlock.hbs" data-ajax-url="/get/cvs">

    <?php if (isset($cvs) and count($cvs)):?>

        <?php /** @var \Entity\Cv[] $cvs */ ?>
        <?php foreach ($cvs as $index => $cv): ?>
            
            <li class="col-lg-12 col-md-12 col-xs-12 list-group-item brick scroller-item" data-id="<?php echo $cv->getId(); ?>">

                <?php include __DIR__ . '/../blocks/cvBlock.php'?>

            </li>

        <?php endforeach; ?>

    <?php else: ?>

        <li class="alert alert-info scroller-item">
            <strong>
                <span class="sr-only">Внимание!</span>
                <span>Резюме не найдено</span>
            </strong>
        </li>

    <?php endif; ?>

</ul>