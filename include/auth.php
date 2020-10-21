<?php
if(isset($_POST['auth'])) {
    $authLogin = isset($_COOKIE['login']) ? $_COOKIE['login'] : htmlspecialchars($_POST['login']);
    $authPassword = htmlspecialchars($_POST['password']);

    if ($result = mysqli_query(connect(), getUserByLogin($authLogin))) {

        while ($row = mysqli_fetch_assoc($result)) {
            $loginFromDb = $row['login'];
            $emailFromDb = $row['email'];
            $passwordFromDb = $row['password'];
        }

        if (($authLogin == $loginFromDb || $authLogin == $emailFromDb) && password_verify($authPassword, $passwordFromDb)) {
            $isAuth = true;
            setcookie('login', $authLogin, time() + 60*60*24*30, '/');
            $_SESSION['login'] = $authLogin;
        }
    }

    if(!$isAuth) {
        $nameVal = $authLogin;
        $passVal = $authPassword;
    }
}
