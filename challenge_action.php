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
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $challenge = trim($_POST["challenge"]);
    $plan = trim($_POST["plan"]);
    $remark = trim($_POST["remark"]);

    $sql = "INSERT INTO challenge (userID, sem, year, challenge, plan, remark)
            VALUES (" . $_SESSION["UID"] . ", " . $sem . ", '". $year . "', '" . $challenge . "','" . $plan . "', '" . $remark . "')";
       
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data saved successfully!<br>";
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
