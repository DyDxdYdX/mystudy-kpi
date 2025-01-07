<?PHP
session_start();
include('config.php');

//variables
$ch_id="";
$sem = "";
$year = "";
$challenge =" ";
$plan = " ";
$remark = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $ch_id = $_POST["ch_id"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $challenge = trim($_POST["challenge"]);
    $plan = trim($_POST["plan"]);
    $remark = trim($_POST["remark"]);

    $sql = "UPDATE challenge SET sem= $sem, year ='$year', challenge = '$challenge', 
            plan = '$plan', remark = '$remark' WHERE ch_id =" . $ch_id . " AND userID = ". $_SESSION["UID"];
       
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data update successfully!<br>";
        echo '<a href="challenge.php">Back</a>';             
    } else {
        echo '<a href="challenge.php">Back</a>';
    }
}

//close db connection
mysqli_close($conn);

//Function to insert data to database table
function insertTo_DBTable($conn, $sql){
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
