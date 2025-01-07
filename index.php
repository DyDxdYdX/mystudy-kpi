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

            $userID = $_SESSION["UID"];
            $sql = "SELECT user.*, profile.* FROM user INNER JOIN profile ON user.userID = profile.userID WHERE user.userID = $userID";
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
        }
        else{
            include 'menu.php';
        }
    ?>

    <div class="row">
        <div class="col-left">
            <?php
            if(isset($_SESSION["UID"])){
            ?>
            <div class="imgcontainer">
            <?php
                if (!empty($row['img_path'])) {
                    echo '<img class="avatar" src="' . $row['img_path'] . '" alt="Avatar">';
                } else {
                    echo '<img class="avatar" src="img/avatar.png" alt="Avatar">';
                }
                ?>
            </div>
            <?php
                echo '<p align="center"> Welcome: ' . $_SESSION['userName'] . "</p>";
            }
            else{
                echo '<img class="avatar" src="img/avatar.png" alt="Avatar">';
            ?>
                <form action="login_action.php" method="post" id="login">
                    <div>

                    </div>
                    <div class="container">
                        <label for="uname"><b>Username</b></label><br>
                        <input type="text" placeholder="Username" name="userName" required><br>

                        <label for="psw"><b>Password</b></label><br>
                        <input type="password" placeholder="Enter Password" name="userPwd" required><br>

                        <button type="submit">Login</button>
                    </div>
                    <br>
                    <div class="container" style=" background-color:#f1f1f1; padding-top: 20px; padding-bottom: 20px;">
                        <span class="psw">
                            <a onClick="showRegister()" style="cursor: pointer;"> Register</a> | 
                            <a style="cursor: pointer;">Forgot password?</a>
                        </span>
                    </div>
                </form>
            <?php    
            }
            ?>
        </div>

        <div class="col-right">
            <div id="newsDiv">
                <h2>| News </h2>
                <b>Announcement</b></p>         
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <p><b>News</b></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>

            <div id="registerDiv" style="display: none;">
            <h2>| User Registration </h2>
            <form action="register_action.php" method="post">
                <label for="matricNo">Matric No</label><br>
                <input type="text" name="matricNo" id="matricNo" required><br><br>

                <label for="userEmail">User Email:</label><br>
                <input type="email" id="userEmail" name="userEmail" required><br><br>

                <label for="userPwd">Password:</label><br>
                <input type="password" id="userPwd" name="userPwd" required maxlength="8"><br><br>

                <label for="userPwd">Confirm Password:</label><br>
                <input type="password" id="confirmPwd" name="confirmPwd" required><br><br>

                <button type="submit" value="Register" style="cursor: pointer;">Submit</button>
                <button type="reset" value="Reset" style="cursor: pointer;">Reset</button>
                <button type="reset" value="Cancel" onClick="cancelRegister()" style="cursor: pointer;">Cancel</button>
            </form>
            </div>
        </div>
    </div>
    <footer>
        <p>Copyright (c) 2023 - Dexter Dykes FKI</p>
    </footer>
</body>
</html>