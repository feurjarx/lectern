<?php
/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 20:43
 */
?>

<form role="form" method="post" enctype="multipart/form-data">

    <div class="form-content col-lg-6 col-xs-12">

        <div class="form-group">
            <label for="last-name-input">Фамилия</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="last_name" id="last-name-input"
                       value="<?php echo isset($lastName) && $lastName ? $lastName : '' ?>"
                       placeholder="Введите фамилию">
            </div>
        </div>

        <div class="form-group">
            <label for="first-name-input">Имя</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input autofocus type="text" class="form-control" name="first_name" id="first-name-input"
                       value="<?php echo isset($firstName) && $firstName ? $firstName : '' ?>"
                       placeholder="Введите имя" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="email-input">Email</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="email" class="form-control" name="email" id="email-input"
                       value="<?php echo isset($email) && $email ? $email : '' ?>"
                       placeholder="Введите почтовый ящик" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>

        <div class="form-group">
            <label>Фотография</label>
            <div class="input-group">
                <label class="input-group-addon btn btn-primary btn-upload" for="image-input" title="Upload image file">
                    <input type="file" class="sr-only" id="image-input" name="file" accept="image/*">
                    <span class="glyphicon glyphicon-camera"></span>
                </label>
                <input id="image-name-input" name="img_name" type="text" class="form-control" readonly placeholder="Выберите фотографию">
                <span disabled id="crop-button" class="btn btn-success input-group-addon">
                    <i class="glyphicon glyphicon-scissors"></i>
                </span>
            </div>
        </div>
        
        <div class="form-group">
            <label>Статус</label>
            <br>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default active">
                    <input type="radio" name="role" id="is-student-input" value="student" autocomplete="off" checked> Студент
                </label>
                <label class="btn btn-default">
                    <input type="radio" name="role" id="is-employer-input" value="employer" autocomplete="off"> Работодатель
                </label>
            </div>
        </div>

        <label for="organisation-input">Учебное заведение</label>
        <br>
        <div class="form-group col-lg-9 col-xs-12 padding-none">
             <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="text" class="form-control" name="organisation" id="organisation-input"
                       placeholder="Введите название учебного заведения" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>

        <div class="form-group col-lg-3 col-xs-12 padding-none">
            <input type="submit" name="submit" id="submit" value="Продолжить" class="btn btn-primary pull-right">
        </div>

    </div>

    <div class="col-lg-6 col-xs-12" style="margin-bottom: 15px">
        <div class="img-container">
            <img id="image" src="../../assets/img/default-avatar.png" style="padding: 15px;">
        </div>
    </div>

    <div class="signup-footer col-lg-12 col-xs-12">

        <?php if (isset($errMsg) && $errMsg): ?>

            <div class="alert alert-danger" role="alert" style="padding: 10px">
                <strong>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Ошибка:</span>

                    <?php
                    if (isset($errMsg) && $errMsg):
                        echo $errMsg;
                    endif;
                    ?>

                </strong>
            </div>

        <?php endif; ?>

    </div>
</form>