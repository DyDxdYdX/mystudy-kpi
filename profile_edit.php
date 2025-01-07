<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <script src="script/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>My Study KPI</title>
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
</head>
<body>
    <div class="header">
    </div>
    
    <?php 
    if(isset($_SESSION["UID"])){
        include 'logged_menu.php';
    }
    else {
        include 'menu.php';
    }
    ?>

    <?php
    $userID = $_SESSION["UID"];
    $sql = "SELECT user.*, profile.* FROM user
    INNER JOIN profile ON user.userID = profile.userID
    WHERE user.userID = $userID";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $matricNo = $row["matricNo"];
        $userEmail = $row["userEmail"];
        $name = $row["username"];
        $program = $row["program"];
        $mentor = $row["mentor"];
        $motto = $row["motto"];
    }
    ?>

    <div class="row">
        <div class="col-left">
        <h2 style="text-align: left; margin-left:20px; font-size:30px;">| Profile Edit</h2>
            <?php
                if (!empty($row['img_path'])) {
                    echo '<img class="avatar" src="' . $row['img_path'] . '" alt="Profile Picture">';
                } else {
                    echo '<img class="avatar" src="img/avatar.png" alt="Profile Picture">';
                }
            ?>
        </div>
        <div class="col-right">             
            <form id="registerDiv" action="profile_edit_action.php" method="post" enctype="multipart/form-data">
                <table id="profile_table" width="100%">
                    <tr>
                        <td width="164">Matric No.</td>
                        <td><?=$matricNo?></td>
                    </tr>
                    <tr>
                        <td width="164">Email</td>
                        <td><?=$userEmail?></td>
                    </tr>
                    <tr>
                        <td width="164">Name</td>
                        <td><input type="text" name="username" size="20" value="<?=$name?>"></td>
                    </tr>                    
                    <tr>
                        <td width="164">Program</td>
                        <td><select size="1" name="program">
                        <option value="" <?php echo ($program == '') ? 'selected' : ''; ?> disabled >Select Program</option>   
                        <option <?php echo ($program == 'Software Engineering') ? 'selected' : ''; ?>>Software Engineering</option>
                        <option <?php echo ($program == 'Network Engineering') ? 'selected' : ''; ?>>Network Engineering</option>
                        <option <?php echo ($program == 'Data Science') ? 'selected' : ''; ?>>Data Science</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td width="164">Mentor Name</td>
                        <td><input type="text" name="mentor" size="20" value="<?=$mentor?>"></td>
                    </tr>
                    <tr>
                    <td width="164">Upload Profile Photo</td>
                    <td><input type="file" name="img_path"></td>
                    </tr>
                    <tr>
                        <td colspan="2"> 
                            My Study Motto:                           
                            <textarea rows="2" name="motto" style="width:100%"><?=$motto?></textarea>
                        </td>
                    </tr>
                </table>
                <div id=registerDiv style="text-align: right; padding-bottom:5px;">
                <button type="submit" value="Update">Update</button>
                <button type="reset" value="Reset">Reset</button>
                <button type="reset" value="Reset" onclick="location.href = 'profile.php'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <p>Copyright (c) 2023 - Dexter Dykes FKI</p>
    </footer>
</body>
</html>
