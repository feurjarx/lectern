<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 21:06
 */
?>

<?php ob_start() ?>
    <script src="<?php echo Utils::getHttpHost(); ?>/assets/js/ad-plus.js"></script>
    <script src="<?php echo Utils::getHttpHost(); ?>/assets/js/ad-remove.js"></script>
<?php $afterJs = ob_get_clean(); ?>

<div class="col-lg-12 col-md-12 col-xs-12 padding-none">

    <div class="col-lg-9 col-xs-12 cabinet-menu-block">
        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#ads">Объявления</a></li>
            <li><a data-toggle="pill" href="#cvs">Заявки</a></li>
        </ul>
    </div>

    <div class="col-lg-3 col-xs-12 padding-none">
        <div class="pull-right cabinet-actions-block">
            <div class="btn-group btn-group-md cabinet-actions">

                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#ad-plus-modal">
                    <em class="glyphicon glyphicon glyphicon-plus"></em> Добавить
                </button>
                <button class="btn btn-danger" type="button" id="ad-remove-button">
                    <em class="glyphicon glyphicon-trash"></em> Удалить
                </button>
            </div>
        </div>
    </div>

</div>

<div class="tab-content">
    <div id="ads" class="tab-pane fade in active">
        <ul class="list-group ads">

            <?php if (isset($ads) && count($ads)): ?>

                <?php /** @var \Entity\Ad[] $ads */ ?>
                <?php foreach ($ads as $index => $ad): ?>

                    <li class="col-lg-12 col-md-12 col-xs-12 list-group-item ad">
                        <?php include __DIR__ . '/../blocks/adBlock.php'?>
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