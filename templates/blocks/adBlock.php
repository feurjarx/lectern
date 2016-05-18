<?php
/**
 * Created by PhpStorm.
 * Date: 18.05.2016
 * Time: 21:23
 */
use Entity\Ad;
/** @var Ad $ad */
?>

<?php if (isset($ad) and $ad instanceof Ad and $ad): ?>

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
    <span class="badge badge-salary pull-right">

        <?php if ($ad->getSalary()): ?>

            <?php echo $ad->getSalary(); ?>&nbsp;

            <i class="fa fa-rub" aria-hidden="true"></i>

        <?php else: ?>
            <?php echo 'Не указано'; ?>
        <?php endif; ?>

    </span>

<?php endif; ?>

