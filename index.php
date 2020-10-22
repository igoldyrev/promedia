<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/session_header.php');
include ($_SERVER['DOCUMENT_ROOT'].'/include/auth.php');
include ($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

    <div class="tasks">
        <div class="left-collum-index">
            <h1 class="left-collum-index-h1">Задачник</h1>
            <div>
                <a class="btn btn-primary" href="/?task=add">Добавить задачу</a>
                <?php
                if(!empty($_GET['task']) && $_GET['task'] == 'add') {
                    include ($_SERVER['DOCUMENT_ROOT'].'/include/addTask.php');
                } elseif(!empty($_GET['task_id'])) {
                    include ($_SERVER['DOCUMENT_ROOT'].'/include/editTask.php');
                } elseif(!empty($_GET['complete_id'])) {
                    include ($_SERVER['DOCUMENT_ROOT'].'/include/completeTask.php');
                } ?>
            </div>
            <?php $orderBy = ''; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a href="/?orderby=name">Название</a></th>
                        <th scope="col"><a href="/?orderby=author">Автор</a></th>
                        <th scope="col"><a href="/?orderby=email">Email</a></th>
                        <th scope="col"><a href="/?orderby=status">Статус</a></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php
                if(!empty($_GET['orderby']) && $_GET['orderby'] == 'name') {
                    $orderBy = 'text';
                } elseif(!empty($_GET['orderby']) && $_GET['orderby'] == 'author') {
                    $orderBy = 'username';
                } elseif(!empty($_GET['orderby']) && $_GET['orderby'] == 'email') {
                    $orderBy = 'email';
                } elseif(!empty($_GET['orderby']) && $_GET['orderby'] == 'status') {
                    $orderBy = 'name';
                } else {
                    $orderBy = 'tasks.id';
                } ?>
                <tbody>
                    <?=getTasks($orderBy) ?>

        </div>
        <div class="right-collum-index">
            <div class="project-folders-menu">
                <?php
                $authLink = !isAuth() ? '/?logout=yes' : '/?login=yes';
                $authName = !isAuth() ? 'Выйти' : 'Авторизация';
                ?>
                <a class="project-folders-v project-folders-v-active" href=<?=$authLink?>><?=$authName?></a>
            </div>

            <?php

            if(!empty($_GET['login']) && $_GET['login'] == 'yes') { ?>
                <div class="index-auth">
                    <form action="/index.php?login=yes" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <?php
                            if(!isset($_COOKIE['login'])) { ?>

                                <tr>
                                <td class="iat">
                                    <label for="login_id">Ваш e-mail или логин:</label>
                                    <input id="login_id" size="30" name="login" value="<?= htmlspecialchars($nameVal); ?>">
                                </td>
                                </tr><?php
                            } else { ?>
                                <div class="auth-login-wrap">
                                <span class="auth-login">Ваш логин </span>
                                <span class="auth-login auth-login--dotted"><?=$_COOKIE['login'] ?></span>
                                </div><?php
                            }
                            if(!isset($_SESSION['login'])) { ?>
                                <tr>
                                    <td class="iat">
                                        <label for="password_id">Ваш пароль:</label>
                                        <input id="password_id" size="30" name="password" type="password" value="<?=$passVal; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="btn btn-primary" name="auth" type="submit" value="Войти"></td>
                                </tr><?php
                            } ?>
                        </table>
                    </form>
                    <?php
                    if(isset($_POST['auth'])) {

                        if($isAuth) {
                            include ($_SERVER['DOCUMENT_ROOT'].'/include/success.php');
                        } else {
                            include ($_SERVER['DOCUMENT_ROOT'].'/include/error.php');
                        }

                    } ?>

                </div>
            <?php }
            if(!empty($_GET['logout']) && $_GET['logout'] == 'yes') {
                $_SESSION['login'] = '';
                session_destroy();
            } ?>
        </div>


    </div>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
