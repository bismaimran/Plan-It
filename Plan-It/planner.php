<?php 
include 'partials/_dbconnect.php';

session_start();

$showReminder=false;
$email_id=$_SESSION['EmailId'];;
if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['planner_id'])) {
$planner_id=$_POST['planner_id'];

}
else{
    $planner_id=$_GET['planner_id'];
}
$sql1="SELECT * from task where planner_id='$planner_id' and email_id='$email_id';";
$result=mysqli_query($conn,$sql1);
    $count = mysqli_num_rows($result);
    while ($row_element = mysqli_fetch_array($result)){
           $tasks[]=$row_element;
    }  
   

$sql2="SELECT * from planner where planner_id='$planner_id' and email_id='$email_id';";
$result=mysqli_query($conn,$sql2);
$plan = mysqli_fetch_array($result);


//lists to set colours of task bars and task cards
$color=['#F299F2BF','#3ed6bf','#41C357CF','#FFBF66DE'];
$buttoncolor=['#690769','#19524b', '#047216', '#A4560E'];

?>


<!DOCTYPE html>
<html lang="en-US">


<head>
<?php require '<partials/_styling.php'?>
</head>

<body>

<?php require '<partials/_header2.php';?>
<?php 
// reminders for exceeded deadlines of tasks
for($x=1; $x<=$count; $x++){
    $today = date("Y-m-d");
    $endTaskDate=$tasks[$x-1]['endTask'];
    if ($endTaskDate<$today){
        $showReminder= "Your task '".$tasks[$x-1]['taskName']."' has exceeded the deadline";
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Reminder!</strong> '.$showReminder.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    }
}

?>


     <!-- add task -->
      <div class="modal fade" id="modaladdtask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                      
                    </div>
                    <div class="modal-body">
                        <!-- Modal Body -->
                        <form action="addtask.php" method="POST">
                             
                            Task Details
                            
                            <div>
                                <div class="col-lg-12">
                                    Task 
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" name="taskName[]" class="form-control m-input" placeholder="Enter Task Name" autocomplete="off" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" name="taskDescription[]" class="form-control m-input" placeholder="Enter Task Description" autocomplete="off" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="date" name="startTask[]" class="form-control m-input" placeholder="Enter Start Date" autocomplete="off" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="date" name="endTask[]" class="form-control m-input" placeholder="Enter End Date" autocomplete="off" required>
                                        </div>
                                    </div>
                                    </div>
                                   
                            </div>
    
                            <button type="submit" name="savechanges" value='<?php echo $planner_id; ?>' class="btn btn-primary">Save changes</button>
                           
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
         
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- START OF PLANNER PAGE -->
    <div class="text-center font-theme">
        <h2 style="text-align:center;font-size:40px; color:#331766; padding-top: 1rem
    ;">
          <?php echo $plan['plannerName'];  ?>
        </h2>
    </div>
    <?php
    // if planner does not have any tasks ask user whether they want to delete the planner or add a task
    if ($count==0){
        echo'
        <div class="card w-50 mx-auto mt-5" style="  border: 2px solid rgba(196, 182, 218, 0.87);">
                <div class="card-body" ; style="text-align:center" ;>
                    <h2 class="card-title" ">Planner has no remaining tasks!</h2>
                
                    <div class="my-4">Do you want to add more tasks to the planner or delete the planner?</div>
                
                    
                    <form action="deleteplanner.php" method="POST">
                        <button type="submit" class="btn btn-secondary" name="deleteplanner" value='.$planner_id.'  >Delete Planner</button>
                    
                    </form>
                    <br>
                    <button type="submit" name="submit" class="btn btn-secondary" data-toggle="modal" data-target="#modaladdtask">Add More Tasks</button>
                    
                    
                </div>
            </div>
        ';
    }
    //if tasks exist in the planner
    else{

        echo '
        <!--TASK BAR -->
        <div class="container2 p-2 d-flex flex-row justify-content" style="margin: auto;">';
        $c=0;
        for ($x=1; $x <= $count; $x++){
            
            $c=$c+1;
           
            echo ' <div class="p-2">
                        <div class="container-taskbar" style="background:'.$color[$c-1].';">'.$tasks[$x-1]['taskName'].'</div>
                        <div class="d-flex flex-row justify-content-between " style=" width: 200px; margin: auto;">
                                <div class="p-2">'.$tasks[$x-1]['startTask'].'</div>
                                <div class="p-2" >'.$tasks[$x-1]['endTask'].'</div>
                        </div>
                    </div>';
            if ($c==sizeof($color) && $x<=$count){
             $c=0;
               };
        }
           
       echo'</div>';
       echo '
        <!-- MAIN BODY WITH TASKS AND CHART -->
    <div class= "p-2 d-flex" style="padding-top: 4rem;">
        <!-- TASKS -->
        <div class="p-2">';
        $c=0;
        for ($x=1; $x <= $count; $x++){
        $c=$c+1;
        echo' <div class="card" style="width:500px;height: 180px;left: 4rem; border-radius: 20;background:'.$color[$c-1].';" >
                <div class="card-body">
                    <div class= "d-flex felx-row justify-content-between">
                        <h5 class="card-title p-2"> '.$tasks[$x-1]['taskName'].'</h5>
                        <h6 class="p-2" >'.$tasks[$x-1]['endTask'].'</h6>
                       
                    </div>
            
                    <h5 class="card-subtitle ml-3" style="color: rgb(255, 255, 255); font-size: 16px;">'.$tasks[$x-1]['taskDescription'].'</h5>
                    <hr>
                    <div class="btn-group"role="group" aria-label="Basic example" >
                    
                    <form action="deletetask.php" method="POST">
                         <button type="submit" class="btn btn-secondary" style="background:'.$buttoncolor[$c-1].'; border:'.$buttoncolor[$c-1].'; " name="donetask" value='.$tasks[$x-1]['taskID'].'/'.$planner_id.' style="background: #19524b; ">Done</button>
                        
                         <button type="submit" class="btn btn-secondary" style="background:'.$buttoncolor[$c-1].'; border:'.$buttoncolor[$c-1].'; " name="deletetask" value='.$tasks[$x-1]['taskID'].'/'.$planner_id.'  style="background: #19524b; ">Delete</button>
                    </form>';
                  
                   echo ' <form action="edittask.php"   method="POST">
                      
                        <button type="submit" class="btn btn-secondary" style="background:'.$buttoncolor[$c-1].'; border:'.$buttoncolor[$c-1].'; " id="#edittask" name="edittasks" value='.$tasks[$x-1]['taskID'].'/'.$planner_id.' style="background: #19524b; ">Edit</button>
                    </form>    
                    
                    </div>
                </div>
            </div>
            <br>';

            if ($c==sizeof($color) && $x<=$count){
                $c=0;
                  };
        }
      
        echo '</div>
    
  <!-- PIE CHART -->
        <div class="chart p-2">
            <h1>Pie chart View </h1>
    
            <div id="piechart"></div>
        </div>
    
    </div>
       ';
       echo'
       <br>
    <!-- ADD BUTTON -->
    <div class="card mx-auto text-center" style="bottom:0;width: 30rem;background:#F299F2BF; ">
        <div class="card-body font-theme">
            Add Task
        
            <button type="submit" name="submit" class="view" data-toggle="modal" data-target="#modaladdtask"></button>

           
        </div>
    </div>
    <br>
       ';
    }
     ?>

<?php
//pie chart functionality
// creating task days list by finding diff between the start and end dates
    $taskdays=[];
    for ($x=1; $x<=$count; $x++){
        $date1= date_create($tasks[$x-1]['endTask']);
        $date2= date_create($tasks[$x-1]['startTask']);
        
        $diff=date_diff($date2,$date1);
        $diff=$diff->format("%R%a");
        $days=intval($diff);
        $taskdays[]=$days;
    }
    // creating pie chart array to be used in the pie chart api
    $piearray=[['Task','Days']];
    for ($x=1; $x<=$count; $x++){
        $piearray[]=[$tasks[$x-1]['taskName'], $taskdays[$x-1]];
    }
    
    
 ?>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var piearray = <?php echo json_encode($piearray); ?>;
            var data = google.visualization.arrayToDataTable(piearray);        
            var options = { 'title': 'Planner', 'width': 550, 'height': 400 };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }


    </script>
 
</body>


</html>