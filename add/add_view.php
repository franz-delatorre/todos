<?php
    session_start();
?>

<html>
    <head>
        <title>Add View</title>
    </head>
    <body>
        <form action="add_process.php" method="POST">
            Title: <input type="textarea" name="title" required>
            Description: <input type="textarea" name="description" required>
            <input type="submit">
        </form>
    </body>
</html>