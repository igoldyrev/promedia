<?php
$queryCompleteSelect = "select tasks.id, statuses.name from `tasks` inner join `statuses` on tasks.status_id = statuses.id where tasks.id = " . mysqli_real_escape_string(connect(), $_GET['complete_id']);
$resCompleteSelect = mysqli_query(connect(), $queryCompleteSelect);

While ($row = mysqli_fetch_assoc($resCompleteSelect))
{
    $completeId = $row['id'];
    $completeStatusName = $row['name'];
}

var_dump($completeId);
var_dump($completeStatusName);

if(isset($_GET['complete_id'])) {

    $queryCompleteTask = "update tasks set status_id = 2 where id = " . mysqli_real_escape_string(connect(), $_GET['complete_id']) . "";

    mysqli_query(connect(), $queryCompleteTask);
} ?>
