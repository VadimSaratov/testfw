<form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Авторизуйтесь</h1>
    <span class="text-danger"><?=isset($errors['signIn']) ? $errors['signIn'] : ''?></span>
    <label for="inputEmail" class="sr-only">Login:</label>
    <input type="text" id="inputLogin" class="form-control" name="login" placeholder="Логин" value="<?=isset($_POST['login']) ? $_POST['login'] : ''?>"  autofocus>
    <span class="text-danger"><?=isset($errors['login']) ? $errors['login'] : ''?></span>
    <label for="inputPassword" class="sr-only">Password:</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Пароль" >
    <span class="text-danger"><?=isset($errors['password']) ? $errors['password'] : ''?></span>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
</form>