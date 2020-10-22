<?php
$queryEditSelect = "select t.id, t.text, t.username, t.email from `tasks` t where t.id = " . mysqli_real_escape_string(connect(), $_GET['task_id']);
$resEditSelect = mysqli_query(connect(), $queryEditSelect);

While ($row = mysqli_fetch_assoc($resEditSelect))
{
    $editText = $row['text'];
    $editUsername = $row['username'];
    $editEmail = $row['email'];
}

if(isset($_POST['edit'])) {
    $taskEditText = htmlspecialchars($_POST['text']);
    $taskEditUser = htmlspecialchars($_POST['user']);
    $taskEditEmail = htmlspecialchars($_POST['email']);

    $queryEditTask = "update tasks set text = '" . $taskEditText . "', username = '" . $taskEditUser . "', email = '" . $taskEditEmail . "'  where id = " . mysqli_real_escape_string(connect(), $_GET['task_id']) . "";

    mysqli_query(connect(), $queryEditTask);
} ?>

<form action="/index.php?task_id=<?=$_GET['task_id'] ?>" method="post">
    <div class="form-group">
        <input class="form-control" type="hidden" name="id" value="<?=$_GET['id']?>">
        <label for="text">Заголовок задачи:</label>
        <input class="form-control" id="text" size="30" name="text" value="<?=$editText?>">
        <label for="user">Пользователь:</label>
        <input class="form-control" id="user" size="30" name="user" value="<?=$editUsername?>">
        <label for="email">Email:</label>
        <input class="form-control" id="email" size="30" name="email" value="<?=$editEmail?>">
        <input class="btn btn-secondary" name="edit" type="submit" value="Редактировать">
    </div>
</form>
