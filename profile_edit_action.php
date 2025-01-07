<?PHP
session_start();
include('config.php');

//check if logged-in
if(!isset($_SESSION["UID"])){
    header("location:index.php"); 
}

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION["UID"];

    $username = $_POST["username"];
    $program = $_POST["program"];
    $mentor = $_POST["mentor"];
    $motto = $_POST["motto"];

    // Handle file upload
    $target_dir = "uploads/"; // Change this to your desired upload directory
    $target_file = $target_dir . basename($_FILES["img_path"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img_path"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            // Handle error if the uploaded file is not an image
        }
    }

    // Check file size
    if ($_FILES["img_path"]["size"] > 500000) {
        $uploadOk = 0;
        // Handle error if the uploaded file is too large
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
        // Handle error if the file format is not allowed
    }

    if ($uploadOk == 1) {
       if (move_uploaded_file($_FILES["img_path"]["tmp_name"], $target_file)) {
           echo "File has been uploaded successfully. ";
           // Update the database with the file path
           $sql = "UPDATE profile SET img_path = '$target_file' WHERE userID = $userID";
           if (mysqli_query($conn, $sql)) {
               echo "Database updated successfully. ";
           } else {
               echo "Error updating database: " . mysqli_error($conn);
           }
       } else {
           echo "Error moving the file. ";
       }
   } else {
       echo "File upload failed. ";
   }

   // SQL to update the profile table
   $sql = "UPDATE profile 
           SET username = '$username', 
               program = '$program', 
               mentor = '$mentor', 
               motto = '$motto' 
           WHERE userID = $userID";
   
   echo $sql . "<br>";

   if (mysqli_query($conn, $sql)) {
       echo "Form data updated successfully!<br>";
       echo '<a href="profile.php">Back</a>'; 
   } else {
       echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
       echo '<a href="javascript:history.back()">Back</a>';
   }
}
//close db connection
mysqli_close($conn);
?>