<?PHP
session_start();
include('config.php');

//variables
$act_id="";
$sem = "";
$year = "";
$act_name =" ";
$remark = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $act_id = $_POST["act_id"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $act_name = trim($_POST["act_name"]);
    $remark = trim($_POST["remark"]);

    $sql = "UPDATE activity SET sem= $sem, year ='$year', act_name = '$act_name', 
            remark = '$remark' WHERE act_id =" . $act_id . " AND userID = ". $_SESSION["UID"];
       
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data update successfully!<br>";
        echo '<a href="activity.php">Back</a>';             
    } else {
        echo '<a href="activity.php">Back</a>';
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
