<?php
     include 'partials/_dbconnect.php';
     session_start();
     $email_id=$_SESSION['EmailId'];
     $_SESSION['Login']=0;
     $showAlert= false;
     $taskerror =array();
  
     
     if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['savechanges'])){
         
         
        $taskcount=sizeof($_POST['taskName']);
        // checking if first task is completely filled
        if($taskcount!=1 || ($_POST['taskName'][0]!='' && $_POST['taskDescription'][0]!='' && $_POST['startTask'][0]!= '' && $_POST['endTask'][0]!= '')){
            
        
            $plannerName= $_POST['plannerName'];
            $sql4= "SELECT * from `planit`.`planner` where plannerName = '$plannerName' and email_id = '$email_id';";
            $result2= mysqli_query($conn, $sql4);
            $count_planner= mysqli_num_rows($result2);
            if ($count_planner==0){

                $sql1= "SELECT * from `planit`.`planner` where email_id = '$email_id';";
                $result=mysqli_query($conn,$sql1);
                $count = mysqli_num_rows($result);
                $planner_id= $count+1;
                $sql2= "INSERT INTO `planit`.`planner` (`planner_id`,`plannerName`,`email_id`) VALUES ('$planner_id', '$plannerName','$email_id');";
                mysqli_query($conn,$sql2);

                //adding tasks for the planner

                $y = 1;
                for ($x = 1; $x <=$taskcount; $x++) {
             
             
                    $taskDescription= $_POST['taskDescription'][$x-1];
                    //formatting dates
                    $startdate=$_POST['startTask'][$x-1];
                    $startdate= explode("-", $startdate);
                    list($year, $month, $day)= $startdate;
                    $startTask= $year.'-'.$month."-".$day;
                    
                    $enddate= $_POST['endTask'][$x-1];
                    $enddate= explode("-", $enddate);
                    list($year, $month, $day)= $enddate;
                    $endTask= $year.'-'.$month."-".$day;
                    
                    $taskName= $_POST['taskName'][$x-1];

                    //checking if all fields are filled of a particular task
                    if ($taskName!='' && $taskDescription!='' && $startTask!='' && $endTask!=''){
                        $taskID= $y ;
                        $sql3 = "INSERT INTO `planit`.`task` (`taskID`,`planner_id`, `email_id`, `taskName`, `taskDescription`, `startTask`, `endTask`) VALUES ('$taskID', '$planner_id', '$email_id', '$taskName', '$taskDescription', '$startTask', '$endTask' );";
                        mysqli_query($conn,$sql3);
                        $y++;
                        
                    }
                    else{
                        array_push($taskerror, $x);
                        
                        
                    }
             
                 }
            header('Location: profile.php?taskError='.join(",",$taskerror));
            }
            else{
                $showAlert= "Planner with a similar name already exists. Try changing the name of your planner!";
            }
              
        }
        else{
            
            $showAlert='Planner not created. Please enter complete details for the task!';
        }
     }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
<?php require '<partials/_styling.php';?>

</head>


<body>


<?php require '<partials/_header2.php';?>
<?php
if($showAlert){
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '.$showAlert.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}
?>

<!-- MODAL -->
<div class="font-theme">
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Planner Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                      
                    </div>
                    <div class="modal-body">
                        <!-- Modal Body -->
                        <form action="template.php" method="POST">
                            <input type="text" id="templateType" name="templateType" value="" style="display: none;" >
                             <div class="form-group" >
                                <label for="fnameEdit">Planner Name</label>
                                <input type="text" class="form-control" name="plannerName" id="plannerName" required >
                            
                            </div>
                            
                            Task Details
                            
                            <div>
                                <div class="col-lg-12">
                                    Task 
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" name="taskName[]" class="form-control m-input" placeholder="Enter Task Name" autocomplete="off">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" name="taskDescription[]" class="form-control m-input" placeholder="Enter Task Description" autocomplete="off">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="date" name="startTask[]" class="form-control m-input" placeholder="Enter Start Date" autocomplete="off">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="date" name="endTask[]" class="form-control m-input" placeholder="Enter End Date" autocomplete="off">
                                        </div>
                                    </div>
                                    <div id="newTask"></div>
                                    <button id="addTask" type="button" class="btn btn-info">Add Task</button>
                                </div>
                            </div>
    
                            <button type="submit" name="savechanges" value='pressed' class="btn btn-primary">Save changes</button>
                           
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
         
                    </div>
                </div>

            </div>
        </div>

<!-- Heading -->
    <div class="text-center font-theme">
        <h2 style="text-align:center;font-size:40px; color:#331766; padding-top: 1rem
    ;">
            Templates
        </h2>
    </div>

<!-- Template Options -->
    <div class="container2">
        <form action="template.php" method="POST">
            <div class="card" style="width: 1000px;
height: 100px;background:#F299F2BF; border-radius: 0; ">
                <div class="card-body font-theme" style="font-size: 30px; ">
                    Business Planner
                    
                    <button type="button"  name="template" value="business" class="view" data-toggle="modal" data-target="#modal"></button>
                    
                </div>
            </div>
            <br>
            <div class="card" style="width: 1000px;
            height: 100px;background:#45D0BB; border-radius: 0; ">
                <div class="card-body font-theme" style="font-size: 30px;  ">
                    Study Planner
                    <button type="button" name="submit" class="view" data-toggle="modal" data-target="#modal"></button>
                </div>
            </div>
            <br>
            <div class="card" style="width: 1000px;
                        height: 100px;background:#41C357CF; border-radius: 0; ">
                <div class="card-body font-theme" style="font-size: 30px;  ">
                    Employee Planner
                    <button type="button" name="submit" class="view" data-toggle="modal" data-target="#modal"></button>
                </div>
            </div>
            <br>
            <div class="card" style="width: 1000px;
                                    height: 100px;background: #FFBF66DE; border-radius: 0; ">
                <div class="card-body font-theme" style="font-size: 30px;  ">
                    Event Planner
                    <button type="button" name="submit" class="view" data-toggle="modal" data-target="#modal"></button>
                </div>
            </div>
            <br>
        </form>
    </div>
</body>


<script type="text/javascript">
    // Adding new task input fields as user clicks Add Task button
    $(document).ready(function() {
        $("#addTask").click(function () {
            
            var html = '';
            html+= 'Task';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="taskName[]" class="form-control m-input" placeholder="Enter Task Name" autocomplete="off"></div>';
            html += '<div class="input-group mb-3">';
            html+= '<input type="text" name="taskDescription[]" class="form-control m-input"  placeholder="Enter Task Description" autocomplete="off"></div>';
            html += '<div class="input-group mb-3">';
            html+='<input type="date" name="startTask[]" class="form-control m-input" placeholder="Enter Start Date" autocomplete="off"></div>';
            html += '<div class="input-group mb-3">';
            html+='<input type="date" name="endTask[]" class="form-control m-input" placeholder="Enter End Date" autocomplete="off"></div>';
            
            $('#newTask').append(html);

            
        });   

        });

        
    </script>
</html>