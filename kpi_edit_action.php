<?PHP
session_start();
include('config.php');

//variables
$cgpa_id="";
$sem = "";
$year = "";
$gpa =" ";
$result_gpa =" ";
$remark = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $cgpa_id=$_POST["cgpa_id"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $gpa = $_POST["gpa"];
    $result_gpa = $_POST["result_gpa"];
    $remark = trim($_POST["remark"]);

    $sql = "UPDATE cgpa SET sem= $sem, year ='$year', gpa = $gpa, 
            result = $result_gpa, remark = '$remark' WHERE cgpa_id =" . $cgpa_id . " AND userID = ". $_SESSION["UID"];
       
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data update successfully!<br>";
        echo '<a href="kpi.php">Back</a>';             
    } else {
        echo '<a href="kpi.php">Back</a>';
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
