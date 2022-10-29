<?php
session_start();
//To Add a new task into the $_SESSION['data'] task Array
if (isset($_POST['addTask'])) {
  if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = [];
  }
  $task = $_POST['new_task'];
  $task_array = array("Task" => $task, "Status" => 0);
  array_push($_SESSION['data'], $task_array);
  header("Location:index.php");
}
//To display the task Name in the input field from the $_SESSION['data'] task array
if (isset($_POST['edit'])) {
  $_SESSION['addEdit'] = '<input type="hidden" name="taskIndex" 
                          value="' . $k . '"><button type="submit" name="updateTask">Update</button>'; // To change the add button from Add => Update button 
  $_SESSION['taskToBeEdited'] = $_SESSION['data'][$_POST['taskIndex']]["Task"];
  $_SESSION['editTaskStatus']=$_SESSION['data'][$_POST['taskIndex']]["Status"];
  $_SESSION['insert_index']=$_POST['taskIndex'];
  header("Location:index.php");
}
// To update the edited task and update it in the $_SESSION['data']task array
if (isset($_POST['updateTask'])) {
  $updatedTask = $_POST['new_task'];
  $_SESSION['data'][$_SESSION['insert_index']]["Task"] = $updatedTask;
  $_SESSION['data'][$_SESSION['insert_index']]["Status"] = $_SESSION['editTaskStatus'];
  $_SESSION['addEdit'] = '<button type="submit" name="addTask">Add</button>'; // To Change the Update Button back to => Add button
  $_SESSION['taskToBeEdited'] = "";
 header("Location:index.php");
}
// To Delete a specifi task from the $_SESSION['data'] task Array
if (isset($_POST['delete'])) {
  $delTask = $_POST['taskIndex'];
  array_splice($_SESSION['data'], $delTask, 1);
  header("Location:index.php");
}
// To Mark a task as completed from the displayed list from $_SESSION['data'] tasks and update its status and completed
if (isset($_POST['checkTask'])) {
  $checkedTask = $_POST['taskIndex'];
  $_SESSION['data'][$checkedTask]["Status"]= 1;
  header("Location:index.php");
}
// To Change the status of the task from done/ completed to back to Incomplete
if (isset($_POST['uncheckedTask'])) {
  $checked="unchecked";
  $uncheckedTask = $_POST['taskIndex'];
  $_SESSION['data'][$uncheckedTask]["Status"]= 0;
  header("Location:index.php");
}
