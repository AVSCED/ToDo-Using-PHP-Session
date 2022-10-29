<?php
session_start();
if (isset($_POST['resetData'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO List</title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<?php
if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = []; // To intialise the session Task array if not intialised
}
if (!isset($_SESSION['addEdit'])) {
    $_SESSION['addEdit'] = '<button type="submit" name="addTask">Add</button>'; // To store the update button in session variable to switch between add and update
}
if (!isset($_SESSION['taskToBeEdited'])) {
    $_SESSION['taskToBeEdited'] = "";
}
if (!isset($_SESSION['insert_index'])) {
    $_SESSION['insert_index'] = 0;
}
if (!isset($_SESSION['insert_index'])) {
    $_SESSION['editTaskStatus'] = 0;
}
?>

<body>
    <div class="container">
        <h2>TODO LIST</h2>
        <h3>Add Item</h3>
        <p>
            <!-- To let the user add Task into the Task Array -->
        <form method="POST" action="./todoCrud.php"><input name="new_task" value="<?php echo $_SESSION['taskToBeEdited'] ?>" type="text" required="required"><?php echo $_SESSION['addEdit']; ?></form>
        </p>
        <h3>Todo</h3>
        <?php
        $k = 0;
        //To Dynamically display $_SESSION['data'] task array in two segments of completed and incomplete Tasks
        $incomplete .= '<ul id="incomplete-tasks">';
        $completed .= '<h3>Completed</h3><ul id="completed-tasks">';
        foreach ($_SESSION['data'] as $key => $value) {
            if ($value["Status"] == 0) {

                $incomplete .= '<li><form method="POST" action="./todoCrud.php"><input type="hidden" name="taskIndex" value="' . $k . '">
                <input type="checkbox" name="checkTask" onChange="submit();"><label>' . $value["Task"] . '</label></form>
                <form method="POST" action="./todoCrud.php"><input type="hidden" name="taskIndex" value="' . $k . '">
                <button class="edit" type="submit" name="edit">Edit</button>
                <button type="submit" name="delete"  class="delete">Delete</button></form></li>';
            } elseif ($value["Status"] == 1) {

                $completed .= '<li><form method="POST" action="./todoCrud.php"><input type="hidden" name="taskIndex" value="' . $k . '">
                <input type="checkbox" name="uncheckedTask"  onChange="submit();"  ><label>' . $value["Task"] . '</label></form>
                <form method="POST" action="./todoCrud.php"><input type="hidden" name="taskIndex" value="' . $k . '">
                <button class="edit" type="submit" name="edit">Edit</button>
                <button class="delete" type="submit" name="delete">Delete</button></form></li>';
            }
            $k = $k + 1;
        }
        $incomplete .= '</ul>';
        $completed .= '</ul>';
        echo $incomplete; // To Display List of incomplete Tasks
        echo $completed; // To Display list of incompleted Tasks
        ?>
    </div>
    <!-- To reset the Session data  -->
    <form action="" method="POST">
        <p style="margin-left:2% ">Reset data:
            <button style="margin-left:2% " type=submit name="resetData">&#9850;</button>
        </p>
    </form>
</body>

</html>