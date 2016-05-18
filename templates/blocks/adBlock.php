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

        <div class="col-lg-1 col-xs-2 checkbox-block">
            <input type="checkbox" placeholder=""  data-toggle="checkbox-x" data-size="sm"
                   data-three-state="false" data-ad-id="<?php echo $ad->getId(); ?>">
        </div>

    <?php endif; ?>

    <div class="<?php echo $isCabinet ? 'col-lg-11 col-xs-10' : 'col-lg-12 col-xs-12' ?>">
        <a class="list-group-item-heading">
            <strong><?php echo ucfirst($ad->getName()); ?></strong>

            <br>

            <?php if (!$isCabinet): ?>

                <span class="text-muted">размещено от <?php echo $ad->getUser()->getFullName(); ?></span>

                <?php if ($org = $ad->getUser()->getOrganisation()): ?>

                    <span class="text-muted">(<?php echo $org; ?>)</span>

                <?php endif; ?>

            <?php endif; ?>

            <?php if ($ad->getPublishedAt()): ?>

                <small class="text-muted"><?php echo date('d/m/Y H:i:s', $ad->getPublishedAt()); ?></small>

            <?php endif; ?>

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

