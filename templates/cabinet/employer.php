<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 21:06
 */
?>

<div class="row">

    <div class="col-lg-6 col-xs-12">
        <ul class="nav nav-pills cabinet-menu-block">
            <li class="active"><a data-toggle="pill" href="#ads">Объявления</a></li>
            <li><a data-toggle="pill" href="#cvs">Заявки</a></li>
        </ul>
    </div>

    <div class="col-lg-6 hidden-xs">
        <div class="cabinet-actions btn-group btn-group-md pull-right">
            <button class="btn btn-success" type="button">
                <em class="glyphicon glyphicon glyphicon-plus"></em> Добавить
            </button>
            <button class="btn btn-danger" type="button">
                <em class="glyphicon glyphicon-trash"></em> Удалить
            </button>
        </div>
    </div>

</div>

<div class="tab-content">
    <div id="ads" class="tab-pane fade in active">
        <ul class="list-group ads">

            <?php if (isset($ads) && count($ads)): ?>

                <?php foreach ($ads as $ad): ?>

                    <li class="col-lg-12 list-group-item ad">
                        <div class="col-lg-1 col-xs-1 checkbox-block">
                            <input type="checkbox" placeholder="" data-toggle="checkbox-x" data-three-state="false">
                        </div>

                        <div class="col-lg-11">
                            <h4 class="list-group-item-heading">
                                <?php echo $ad->getName(); ?>
                            </h4>
                            <p class="list-group-item-text">
                                <?php echo $ad->getDetails(); ?>
                            </p>
                        </div>
                    </li>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-lg-12 alert alert-warning list-group-item">
                    <strong>
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="sr-only">Внимание!</span>
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

