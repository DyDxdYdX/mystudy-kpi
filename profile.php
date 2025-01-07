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
</head>
<body>
    <div class="header"></div>
    
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
    $sql = "SELECT * FROM user INNER JOIN profile ON user.userID = profile.userID WHERE user.userID =$userID";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $matricNo = $row["matricNo"];
        $userEmail = $row["userEmail"];
        $username = $row["username"];
        $program = $row["program"];
        $mentor = $row["mentor"];
        $motto = $row["motto"];
    }
    ?>

    <div class="row">
        <div class="col-left">
            <h2 style="text-align: left; margin-left:20px; font-size:30px;">| Profile </h2>
            <?php
                if (!empty($row['img_path'])) {
                    echo '<img class="image" src="' . $row['img_path'] . '" alt="Profile Picture">';
                } else {
                    echo '<img class="image" src="img/avatar.png" alt="Profile Picture">';
                }
            ?>
        </div>
        <div class="col-right"> 
            <div style="text-align: right; padding-bottom:10px; font-size:25px;">
                <a href="profile_edit.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
            </div>
            <table width="100%" style="border-collapse: collapse;" id="projectable">
                <tr>
                    <td width="164">Name</td>
                    <td><?=$username?></td>
                </tr>
                <tr>
                    <td width="164">Matric No.</td>
                    <td><?=$matricNo?></td>
                </tr>
                <tr>
                    <td width="164">Email</td>
                    <td><?=$userEmail?></td>
                </tr>
                <tr>
                    <td width="164">Program</td>
                    <td><?=$program?></td>
                </tr>
                <tr>
                    <td width="164">Mentor Name</td>
                    <td><?=$mentor?></td>
                </tr>
            </table>
            <p>My Study Motto</p>
            <table width="100%" style="border-collapse: collapse;" id="projectable">
                <tr>
                    <td>
                        <?php
                        if($motto==""){
                            echo "&nbsp;";
                        }
                        else{
                            echo $motto;
                        }

                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <footer>
        <p>Copyright (c) 2023 - Dexter Dykes FKI</p>
    </footer>
</body>
</html>