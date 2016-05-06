<?php
/**
 * Created by PhpStorm.
 * Date: 02.05.2016
 * Time: 20:41
 */
?>

<form role="form" method="post">
    <div class="col-lg-6 col-lg-push-3">

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input autofocus required type="password" class="form-control" name="password" id="password"
                       placeholder="Придумайте пароль" onkeyup="checkPasswords()">
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input required type="password" class="form-control" id="repeat-password"
                       placeholder="Введите еще раз" onkeyup="checkPasswords()">
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>

        <div class="col-lg-12 col-xs-12 col-lg-push-4">
            <div class="input-group" style="margin-top: 3px">
                <input disabled type="submit" name="submit" id="set-password-submit" value="Завершить регистрацию" class="btn btn-success">
                <input name="new_pass_session" type="hidden" value="<?php echo isset($newPassSession) ? $newPassSession : 'hack'?>">
            </div>
        </div>

    </div>
</form>