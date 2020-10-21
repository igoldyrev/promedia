<?php
function connect() {
    $host="localhost";
    $user="046588651_media";
    $password="32vgpfQpbf<2";
    $dbname="9082410193_promedia";
    static $con;

    if(empty($con)) {
        $con = mysqli_connect($host, $user, $password, $dbname)
        or die ('Нет соединения с сервером ' . mysqli_connect_error());
    }

    if(!$con -> set_charset("utf-8")) {
        mysqli_error($con);
    } else {
        mysqli_character_set_name($con);
    }

    return $con;
}

function isAuth() {
    return empty($_SESSION['login']);
}

function getUserByLogin($login) {
    $userQuery = "SELECT login, email, password FROM users WHERE login = '" . mysqli_real_escape_string(connect(),  $login) . "' OR email = '" . mysqli_real_escape_string(connect(),  $login) . "'";
    return $userQuery;
}

function getTasks($orderBy) {
    $onPage = 3;
    $queryCountTasks = "select count(*) from `tasks` inner join `statuses` on tasks.status_id = statuses.id";
    $resCountTasks = mysqli_query(connect(), $queryCountTasks);
    $countTasks = mysqli_fetch_row($resCountTasks);
    $countRecords = $countTasks[0];
    $numPages = ceil($countRecords / $onPage);
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    if ($currentPage < 1) {
        $currentPage = 1;
    } elseif ($currentPage > $numPages) {
        $currentPage = $numPages;
    }

    $startFrom = ($currentPage - 1) * $onPage;
    $queryTasksOnPage = "select tasks.id, tasks.text, tasks.username, tasks.email, statuses.name from `tasks` inner join `statuses` on tasks.status_id = statuses.id order by $orderBy asc limit $startFrom, $onPage";
    $resCountTasksOnPage = mysqli_query(connect(), $queryTasksOnPage);

    While ($row = mysqli_fetch_assoc($resCountTasksOnPage))
    {?>
        <p><?=$row['text'] . ' ' . $row['username'] . ' ' . $row['email'] . ' ' . $row['name']; editAdmin($row['id'])?></p><?php

       if(isset($_SESSION['login'])) {?>
           <a href="/?task_id=<?=$row['id']?>">Редактировать</a>
           <a href="/?complete_id=<?=$row['id']?>">Пометить выполненным</a><?php
       }
    }?>

    <ul class="pagination"><?php
        for ($page = 1; $page <= $numPages; $page++)
        {
            if ($page == $currentPage) {?>
                <li class="page-item page-link"><?=$page ?></li><?php
            } else {
                echo '<li class="page-item"><a class="page-link" href="/?page='.$page.'">'.$page.'</a></li>';
            }
        } ?>
    </ul><?php
}

function addTask() {
    if(isset($_POST['add'])) {
        $taskText = htmlspecialchars($_POST['text']);
        $taskUser = htmlspecialchars($_POST['user']);
        $taskEmail = htmlspecialchars($_POST['email']);

        $queryAddTask = "insert into tasks (text, username, email, status_id) VALUES ('". $taskText . "','" . $taskUser . "','" . $taskEmail . "', 1);";

        mysqli_query(connect(), $queryAddTask);
    }
}

function editAdmin($id) {
    $queryEditSelect = "select tasks.status_id from `tasks` where tasks.id = " . mysqli_real_escape_string(connect(), $id);
    $resEditSelect = mysqli_query(connect(), $queryEditSelect);

    While ($row = mysqli_fetch_assoc($resEditSelect))
    {
        $editId = $row['status_id'];
    }

    if($editId == 2) {
        echo 'Отредактировано администратором';
    }
}
