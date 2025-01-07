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
<body onLoad="show_AddEntry()">
    <div class="header"></div>
    <?php
        if(isset($_SESSION["UID"])){
            include 'logged_menu.php';
        }
        else{
            include 'menu.php';
        }
    ?>

    <?php
        $cgpa_id = "";
        $sem = "";
        $year = "";
        $gpa ="";
        $result_gpa ="";
        $remark = "";

        if(isset($_GET["id"]) && $_GET["id"] != ""){
            $cgpa_id = $_GET["id"];
            $userID = $_SESSION["UID"];

            $sql = "SELECT * FROM cgpa WHERE cgpa_id = $cgpa_id AND userID = $userID";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $cgpa_id = $row["cgpa_id"];
                $sem = $row["sem"];
                $year = $row["year"];
                $gpa = $row["gpa"];
                $result_gpa = $row["result"];
                $remark = $row["remark"];
            }
        }

        mysqli_close($conn);
    ?>

    <div id="form">
        <h2 style="margin-left: 20px;">| Activities</h2>
        <h3 align="center">Edit GPA</h3>
        <p align="center">Required field with mark*</p>

        <form method="POST" action="kpi_edit_action.php">
            <input type="hidden" id="cgpa_id" name="cgpa_id" value="<?=$_GET['id']?>">
            <table border="1" id="myTable">
                <tr>
                    <td>Semester*</td>
                    <td width="1px">:</td>
                    <td>
                        <select size="1" id="sem" name="sem" required>                        
                        <?php
                        if($sem=="1")
                            echo '<option value="1" selected>1</option>';
                        else
                            echo '<option value="1">1</option>';
                           
                        if($sem=="2")
                            echo '<option value="2" selected>2</option>';
                        else
                            echo '<option value="2">2</option>';
                        ?>                       
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Year*</td>
                    <td>:</td>
                    <td>
                    <?php
                    if($year!=""){
                        echo '<input type="text" name="year" size="5" value="' . $year . '" required>';
                    }
                    else {
                    ?>
                        <input type="text" name="year" size="5" required>
                    <?php
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Target GPA*</td>
                    <td>:</td>
                    <td>
                    <?php
                    if($year!=""){
                        echo '<input type="text" name="gpa" size="5" value="' . $gpa . '" required>';
                    }
                    else {
                    ?>
                        <input type="text" name="gpa" size="5" required>
                    <?php
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Result*</td>
                    <td>:</td>
                    <td>
                    <?php
                    if($year!=""){
                        echo '<input type="text" name="result_gpa" size="5" value="' . $result_gpa . '" required>';
                    }
                    else {
                    ?>
                        <input type="text" name="result_gpa" size="5" required>
                    <?php
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                 <td>Remark</td>
                    <td>:</td>
                    <td>
                        <textarea rows="4" name="remark" cols="20"><?php echo $remark;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right"> 
                    <input type="submit" value="Submit" name="B1">                
                    <input type="reset" value="Reset" name="B2">
                    <input type="reset" value="Cancel" name="B3" onclick="location.href = 'kpi.php'">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <footer>
        <p>Copyright (c) 2023 - Dexter Dykes FKI</p>
    </footer>
</body>
</html>