<?php
session_start();
include('config.php');
//this action is called when the Delete link is clicked
if(isset($_GET["id"]) && $_GET["id"] != ""){
    $cert_id = $_GET["id"];
    
    $sql = "DELETE FROM certification WHERE cert_id=" . $cert_id . " AND userID=" . $_SESSION["UID"];
    //echo $sql . "<br>";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully<br>";
        echo '<a href="certification.php">Back</a>';
     } else {
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
        echo '<a href="certification.php">Back</a>';
    }
}
mysqli_close($conn);
?>