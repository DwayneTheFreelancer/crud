<?php

require "database.php";
initMigration($pdo);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Simple Crud</title>
    </head>
    <body>
        <a href="create.php">Create User</a>
        <a href="read.php?show=all">Show All Users</a>
    </body>
</html>