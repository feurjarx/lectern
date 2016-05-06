<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 20:58
 */
?>
<?php $title = 'Личный кабинет'; ?>

<?php ob_start() ?>
    <link href="../assets/css/cabinet.css" rel="stylesheet">
<?php $css = ob_get_clean() ?>

<?php $active_item = 'cabinet' ?>

<?php ob_start() ?>

    <div class="container cabinet-box">

        <?php if (isset($role)): ?>
            <?php if ($role === Constants::STUDENT_ROLE): ?>

                <?php include 'cabinet/student.php' ?>

            <?php elseif ($role === Constants::EMPLOYER_ROLE): ?>

                <?php include 'cabinet/employer.php' ?>

            <?php endif; ?>
        <?php endif; ?>

    </div>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>