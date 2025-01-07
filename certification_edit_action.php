<?PHP
session_start();
include('config.php');

//variables
$cert_id="";
$sem = "";
$year = "";
$cert_name =" ";
$remark = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $cert_id = $_POST["cert_id"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $cert_name = trim($_POST["cert_name"]);
    $remark = trim($_POST["remark"]);

    $sql = "UPDATE certification SET sem= $sem, year ='$year', cert_name = '$cert_name', 
            remark = '$remark' WHERE cert_id =" . $cert_id . " AND userID = ". $_SESSION["UID"];
       
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data update successfully!<br>";
        echo '<a href="certification.php">Back</a>';             
    } else {
        echo '<a href="certification.php">Back</a>';
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
