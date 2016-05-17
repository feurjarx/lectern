<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 21:06
 */
?>

<?php ob_start() ?>
    <script src="<?php echo Constants::getHttpHost(); ?>/assets/js/ad-plus.js"></script>
    <script src="<?php echo Constants::getHttpHost(); ?>/assets/js/ad-remove.js"></script>
<?php $afterJs = ob_get_clean(); ?>

<div class="row">

    <div class="col-lg-6 col-xs-12">
        <ul class="nav nav-pills cabinet-menu-block">
            <li class="active"><a data-toggle="pill" href="#ads">Объявления</a></li>
            <li><a data-toggle="pill" href="#cvs">Заявки</a></li>
        </ul>
    </div>

    <div class="col-lg-6 hidden-xs">
        <div class="cabinet-actions btn-group btn-group-md pull-right">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#ad-plus-modal">
                <em class="glyphicon glyphicon glyphicon-plus"></em> Добавить
            </button>
            <button class="btn btn-danger" type="button" id="ad-remove-button">
                <em class="glyphicon glyphicon-trash"></em> Удалить
            </button>
        </div>
    </div>

</div>

<div class="tab-content">
    <div id="ads" class="tab-pane fade in active">
        <ul class="list-group ads">

            <?php if (isset($ads) && count($ads)): ?>

                <?php /** @var \Entity\Ad[] $ads */ ?>
                <?php foreach ($ads as $index => $ad): ?>

                    <li class="col-lg-12 list-group-item ad" href="#ad-details-<?php echo $ad->getId(); ?>" data-toggle="collapse">
                        <div class="col-lg-1 col-xs-2 checkbox-block">
                            <input type="checkbox" placeholder=""  data-toggle="checkbox-x" data-size="sm"
                                   data-three-state="false" data-ad-id="<?php echo $ad->getId(); ?>">
                        </div>

                        <div class="col-lg-11 col-xs-10">
                            <a class="list-group-item-heading">
                                <?php echo ucfirst($ad->getName()); ?>
                            </a>

                            <pre id="ad-details-<?php echo $ad->getId(); ?>" class="list-group-item-text panel-collapse collapse"><?php echo trim(strip_tags(ucfirst($ad->getDetails()))); ?></pre>
                        </div>
                        <span class="badge badge-salary pull-right"><?php echo $ad->getSalary() ? $ad->getSalary() : 'Не указано'; ?></span>
                    </li>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-lg-12 alert alert-info list-group-item">
                    <strong>
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <span class="sr-only">Информация!</span>
                        Объявлений не найдено
                    </strong>
                </div>

            <?php endif ?>

        </ul>
    </div>

    <div id="cvs" class="tab-pane fade">
        <h3>тут будут резюме 1</h3>
    </div>
</div>

<?php include 'adPlusModal.php' ?>