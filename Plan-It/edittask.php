<?php 
include 'partials/_dbconnect.php';

session_start();
$email_id=$_SESSION['EmailId'];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if(isset($_POST['edittask'])){
        $task_details=$_POST['edittask'];
        $task_details= explode('/',$task_details);
        list($task, $planner)=$task_details;
        $taskID=$task;
        $planner_id= $planner;
        $taskName=$_POST['edittaskName'];
        $taskDescription=$_POST['edittaskDescription'];
        $startTask=$_POST['editstartTask'];
        $endTask=$_POST['editendTask'];
      
       // updating task information entered by user in the fields
        $sql="UPDATE task SET `taskName` = '$taskName',`taskDescription`='$taskDescription',`startTask`='$startTask',`endTask`='$endTask' WHERE `email_id`= '$email_id' AND `planner_id`='$planner_id' AND `taskID`='$taskID';";
        mysqli_query($conn,$sql);
        echo mysqli_error($conn);

        header('Location: planner.php?planner_id='.$planner_id);}
    

        else{
            $edit=$_POST['edittasks'];
        }
    }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
<?php require '<partials/_styling.php';?>

</head>

<body>

<?php require '<partials/_header.php';?>
<div class="card my-5 mx-auto" style="width: 500px; border: 2px solid rgba(196, 182, 218, 0.87);">
    <div class="card-body" ; style="text-align:center" ;>
        <h2 class="card-title">Edit Task</h2>
        <form action="edittask.php" method="POST">
        
            Task Details
        
            <div>
                <div class="col-lg-12">
        
                    <div id="inputFormRow">
                        <div class="input-group mb-3 " >
                            <input type="text" name="edittaskName" class="form-control m-input" placeholder="Enter Task Name"
                                autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="edittaskDescription" class="form-control m-input"
                                placeholder="Enter Task Description" autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input type="date" name="editstartTask" class="form-control m-input" placeholder="Enter Start Date"
                                autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input type="date" name="editendTask" class="form-control m-input" placeholder="Enter End Date"
                                autocomplete="off">
                        </div>
        
                    </div>
                </div>
            </div>
        
           <button type="submit" name="edittask" value=<?php echo $edit ?> class="btn btn-primary">Save Changes</button>
        </form>
        
        
    </div>
    </div>

    
        </body>

</html>