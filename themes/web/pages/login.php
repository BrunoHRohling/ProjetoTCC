<?php

use Autoload\Models\User;

if (isset($_POST['login'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo 'Informe um e-mail válido';
    } else {
        $user = new User();
        if ($user->login($_POST['email'], $_POST['password'])) {
            redirect('../app/');
        }
        echo $user->getMessage();
    }
}
?>

<div class="form-styling">
    <h1 style="color:grey">Fazer Login</h1>

    <form action method="post" autocomplete="off">

        <label for="email"></label>
        <input type="email" name="email" id="email" placeholder="E-mail" required/>

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Senha" required/>

        <br/>
        <button type="submit" name="login">Logar-se</button>

    </form>
    <p>Ainda não possui uma conta? Faça o <a href="<?= url('web/register') ?>">Cadastro</a></p>
</div>