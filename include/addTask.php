<?php addTask(); ?>

<form action="/index.php?task=add" method="post">
    <div class="form-group">
        <label for="text">Заголовок задачи:</label>
        <input class="form-control" id="text" size="30" name="text">
        <label for="user">Пользователь:</label>
        <input class="form-control" id="user" size="30" name="user">
        <label for="email">Email:</label>
        <input class="form-control" id="email" size="30" name="email">
        <input class="btn btn-secondary" name="add" type="submit" value="Добавить">
    </div>
</form>
