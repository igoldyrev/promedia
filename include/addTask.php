<?php addTask(); ?>

<form action="/index.php?task=add" method="post">
    <label for="text">Заголовок задачи:</label>
    <input id="text" size="30" name="text">
    <label for="user">Пользователь:</label>
    <input id="user" size="30" name="user">
    <label for="email">Email:</label>
    <input id="email" size="30" name="email">
    <input class="btn btn-secondary" name="add" type="submit" value="Добавить">
</form>
