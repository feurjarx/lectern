<?php
/**
 * Created by PhpStorm.
 * Date: 18.05.2016
 * Time: 21:23
 */
use Entity\Ad;

$isCabinet = '/'. Constants::EMPLOYER_ROLE . '/cabinet' === parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/** @var Ad $ad */
?>

<?php if (isset($ad) and $ad instanceof Ad and $ad): ?>

    <?php if ($isCabinet): ?>

        <div class="col-lg-1 col-md-1 col-xs-2 checkbox-block padding-none">
            <input type="checkbox" placeholder=""  data-toggle="checkbox-x" data-size="sm"
                   data-three-state="false" data-ad-id="<?php echo $ad->getId(); ?>">
        </div>

    <?php else: ?>

        <div class="col-lg-1 col-md-1 col-xs-2 thumbnail">
            <img src="<?php echo $ad->getPerson()->getUser()->getImgUrl(); ?>" alt="<?php echo $ad->getPerson()->getLastName(); ?>">
        </div>

    <?php endif ?>

    <div class="col-lg-11 col-lg-11 col-xs-10">

        <div class="list-group-item-heading" data-target="#ad-details-<?php echo $ad->getId(); ?>" data-toggle="collapse" aria-expanded="false">
            
            <?php if ($isCabinet): ?>

                <a href="#" class="ellipsis-box" style="width: 75%">
                    <b><?php echo ucfirst($ad->getName()); ?></b>
                </a>

            <?php else: ?>

                <h3 class="margin-none">
                    <a href="#" class="ellipsis-box font-size-xs" style="width: 70%"><?php echo ucfirst($ad->getName()); ?></a>
                </h3>
                <?php echo $ad->getPerson()->getFullName(); ?>

                <?php if ($org = $ad->getPerson()->getOrganisation()): ?>

                    (<?php echo $org; ?>)

                <?php endif; ?>

                <br>

            <?php endif; ?>

            <?php if ($ad->getPublishedAt()): ?>

                <small class="text-muted">размещено: <?php echo date('d/m/Y H:i:s', $ad->getPublishedAt()); ?></small>

            <?php endif; ?>

        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12 padding-none">
        <div class="collapse list-group-item-text" id="ad-details-<?php echo $ad->getId(); ?>">
            <pre class="well margin-none"><?php echo trim(strip_tags(ucfirst($ad->getDetails()))); ?></pre>
        </div>
    </div>

    <span class="badge badge-salary pull-right">

        <?php if ($ad->getSalary()): ?>
            <?php echo $ad->getSalary(); ?>

            <i class="fa fa-rub" aria-hidden="true"></i>

        <?php else: ?>
            <?php echo 'Не указано'; ?>
        <?php endif; ?>

    </span>

<?php endif; ?>

