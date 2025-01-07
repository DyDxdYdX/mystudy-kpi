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
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $cert_name = trim($_POST["cert_name"]);
    $remark = trim($_POST["remark"]);

    $sql = "INSERT INTO certification (userID, sem, year, cert_name, remark)
            VALUES (" . $_SESSION["UID"] . ", " . $sem . ", '". $year . "', '" . $cert_name . "', '" . $remark . "')";
       
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data saved successfully!<br>";
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
