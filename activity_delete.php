<?php
session_start();
include('config.php');
//this action is called when the Delete link is clicked
if(isset($_GET["id"]) && $_GET["id"] != ""){
    $act_id = $_GET["id"];
    
    $sql = "DELETE FROM activity WHERE act_id=" . $act_id . " AND userID=" . $_SESSION["UID"];
    //echo $sql . "<br>";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully<br>";
        echo '<a href="activity.php">Back</a>';
     } else {
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
        echo '<a href="activity.php">Back</a>';
    }
}
mysqli_close($conn);
?>