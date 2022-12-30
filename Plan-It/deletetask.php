<?php 
include 'partials/_dbconnect.php';

session_start();
$email_id=$_SESSION['EmailId'];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //if user presses delete task button
    if(isset($_POST['deletetask'])){
        //getting task and planner details in get method from planner page
        $task_details=$_POST['deletetask'];
        $task_details= explode('/',$task_details);
        list($task, $planner)=$task_details;
        $taskID=$task;
        $planner_id= $planner;
        //selecting all tasks of the planner and using it as a counter
        $sql1="SELECT * from `planit`.`task` where email_id = '$email_id' and planner_id='$planner_id';";
        $result=mysqli_query($conn,$sql1);
        $task_count = mysqli_num_rows($result);
        //deleting the selected task
        $sqldel="DELETE FROM task where taskID='$taskID' AND planner_id='$planner_id' AND email_id='$email_id';";
        mysqli_query($conn,$sqldel);
        //decrementing the task id of the tasks where task id of that task is greater than the deleted task
        $y=$taskID+1;
        for ($y; $y<=$task_count; $y++ ){
            $taskID=$y-1;
            $sql2= "UPDATE `task` SET taskID = '$taskID' WHERE taskID = '$y' AND planner_id = '$planner_id' AND email_id = '$email_id';";
            mysqli_query($conn,$sql2);
        }
    }
    //if user presses done task
    else if(isset($_POST['donetask'])){
        $task_details=$_POST['donetask'];
        
        $task_details= explode('/',$task_details);
        list($task, $planner)=$task_details;
        $taskID=$task;
        $planner_id= $planner;
        $sql1="SELECT * from `planit`.`task` where email_id = '$email_id' and planner_id='$planner_id';";
        $result=mysqli_query($conn,$sql1);
        
        $task_count = mysqli_num_rows($result);
        $sqldel="DELETE FROM task where taskID='$taskID' AND planner_id='$planner_id' AND email_id='$email_id';";
        mysqli_query($conn,$sqldel);
       
        $y=$taskID+1;
        for ($y; $y<=$task_count; $y++ ){
            $taskID=$y-1;
            $sql2= "UPDATE `task` SET taskID = '$taskID' WHERE taskID = '$y' AND planner_id = '$planner_id' AND email_id = '$email_id';";
            mysqli_query($conn,$sql2);
        }

    }
    header('Location: planner.php?planner_id='.$planner_id);
}
?>