<form class="navbar-form navbar-right" role="form" method="post" action="/auth">

    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input required type="email" class="form-control" name="login" placeholder="Логин">
    </div>

    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input required type="password" class="form-control" name="password" placeholder="Пароль">
    </div>

    <button type="submit" class="btn btn-primary">
        <small><b>Войти</b></small>
        <span class="glyphicon glyphicon-log-in"></span>
    </button>

    <a href="/signup" class="btn btn-success">
        <small><b>Регистрация</b></small>
        <span class="glyphicon glyphicon-plus"></span>
    </a>

</form>