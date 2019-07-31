<?php
    session_start();
    require "../cons/cons.php";
    require "../dbconnect/dbconnect.php";
    require "../functions/functions.php";  
    require "../functions/prompts.php";
    
    $id = $_SESSION['id'];
?>

<html>
    <head>
        <title>USER VIEW</title>
    </head>
    <body>
        <a href="../logout/logout.php">Logout</a> <br>
        <!-- for NON-ADMIN users -->
        <?php if($_SESSION['roleId']==101) {
            addTaskPrompt();
            deleteTodoPrompt();
            editTodoPrompt();
            markDonePrompt();
        ?>
        <!-- Add Task -->
        <a href="../add/add_view.php">ADD TASK</a>
        <br>

        <!-- View All tasks -->
        <?php
            $sql = userView($id);
            $result = $conn->query($sql);

            if($result->num_rows > 0){ 
        ?>
                <table>
                        <tr>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
        <?php
                while($row = $result->fetch_assoc()){ 
        ?>
                        <tr>
                            <td>

                                <!-- marks selected task as done -->
                                <form action="../markDone/mark_Done_Process.php" method="POST">
                                    <input type="hidden" name='id' value="<?php echo $row['id'];  ?>">
                                    <input type="submit" value="DONE">
                                </form>
                            </td>
                            <td><?php echo $row["description"]; ?></td>
                            <td><?php echo $row["status"]; ?></td>
                            <td>
                                
                                <!-- deletes current selected task -->
                                <form action="../delete_todo/delete_todo_process.php" method="POST">
                                    <input type="hidden" id="id" name="id" value='<?php echo $row["id"]; ?>'>
                                    <input type="submit" value="DELETE">
                                </form>
                            </td>
                            <td>

                                <!-- updates current selected task -->
                                <form action="../edit/edit_view.php" method="POST">
                                    <input type="hidden" id="description" name="description" value='<?php echo $row["description"]; ?>'>
                                    <input type="hidden" id="id" name="id" value='<?php echo $row["id"]; ?>'>
                                    <input type="submit" value="EDIT">
                                </form>
                            </td>
                        </tr>

        <?php } echo "</table>";
            }else{
                echo "No current Task!";
            }
        ?>

        <!-- for ADMIN -->
        <?php }elseif($_SESSION['roleId']==100){?>
            <a href="user_view.php?adminopt=ShowUser" >Show Users</a><br>
            <a href="user_view.php?adminopt=ShowTodo" >Show Todos</a><br>
            <br>
        <?php
            $get = $_GET['adminopt'] ?? "";

                // If admin wants to see the users
                if($get == "ShowUser"){
                    // prompts added user by admin
                    if(isset($_SESSION['addUser'])){
                        addUser();
                        unset($_SESSION['addUser']);
                    }

                    // Add User
                    echo "<a href='../register/register.php?fromadmin=yes'>Add User</>";
                    

                    $sql = 
                }
        ?>

        <?php } ?>
    </body>

</html>