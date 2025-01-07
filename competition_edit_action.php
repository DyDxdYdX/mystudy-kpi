<?PHP
session_start();
include('config.php');

//variables
$comp_id="";
$sem = "";
$year = "";
$comp_name =" ";
$level = " ";
$achievement = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $comp_id = $_POST["comp_id"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $comp_name = trim($_POST["comp_name"]);
    $level = trim($_POST["level"]);
    $achievement = trim($_POST["achievement"]);

    $sql = "UPDATE competition SET sem= $sem, year ='$year', comp_name = '$comp_name', 
            level = '$level', achievement = '$achievement' WHERE comp_id =" . $comp_id . " AND userID = ". $_SESSION["UID"];
       
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data update successfully!<br>";
        echo '<a href="competition.php">Back</a>';             
    } else {
        echo '<a href="competition.php">Back</a>';
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
