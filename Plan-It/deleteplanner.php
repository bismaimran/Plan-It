<?php
include 'partials/_dbconnect.php';

session_start();
$email_id=$_SESSION['EmailId'];
$_SESSION['Login']=1;
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $planner_id= $_POST['deleteplanner'];
    //getting all planners of the particular user
    $sql2= "SELECT * from `planit`.`planner` where email_id = '$email_id';";
    $result=mysqli_query($conn,$sql2);
    $planner_count = mysqli_num_rows($result);
    //deleting the particular planner
    $sql1= "DELETE FROM planner WHERE planner_id= '$planner_id' and email_id='$email_id';";
    mysqli_query($conn,$sql1);

    $y=$planner_id+1;
    for ($y; $y<=$planner_count; $y++ ){
        //decrementing those planner's planner_id where their planner_id is greater than the deleted planner's id
            $planner_id=$y-1;

            $sql2= "UPDATE `planner` SET planner_id = '$planner_id' WHERE planner_id = '$y' AND email_id = '$email_id';";
            mysqli_query($conn,$sql2);
        }
    header('Location: profile.php');
}

?>