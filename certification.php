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
        else{
            include 'menu.php';
        }
    ?>
    <div class="row-kpi">
        <ul>
            <li><a href="kpi.php"><i class="fa fa-book" aria-hidden="true"></i> KPI Indicator</a>
            <li><a href="activity.php"><i class="fa fa-futbol-o" aria-hidden="true"></i> Activity</a>
            <li><a href="competition.php"><i class="fa fa-fighter-jet" aria-hidden="true"></i> Competition</a>
            <li><a href="certification.php" class="active"><i class="fa fa-columns" aria-hidden="true"></i> Certification</a>
        </ul>
    </div>
    <div class="row">
        <h2 style="margin-left: 20px;">| Certification</h2>
        <table id="projectable" style="margin: 0px 20px 0px 20px;">
            <tr>
                <th width="10%">Sem & Year</th>
                <th width="45%">Certification Name</th>
                <th width="30%">Remark</th>
                <th width="15%">Option</th>
            </tr>
            <tr>
            <?php
                $sql = "SELECT * FROM certification WHERE userID=". $_SESSION["UID"];
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $numrow=1;
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["cert_name"] .
                        "</td><td>" . $row["remark"] . "</td>";
                        echo '<td> <a href="certification_edit.php?id=' . $row["cert_id"] . '">Edit</a>&nbsp;|&nbsp;';
                        echo '<a href="certification_delete.php?id=' . $row["cert_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="7">0 results</td></tr>';
                } 
        
                mysqli_close($conn);
            ?>
            </tr>
        </table>
        <?php
        if(isset($_SESSION["UID"])){
        ?>
            <div style="margin-left: 20px; padding-top:10px;">
                <input type="button" value="Add New" style="padding:10px 10px;" onclick="show_AddEntry()">
            </div>
        <?php
        }
        ?>
    </div>
    <div id="form">
        <h3 align="center">Add Certification</h3>
        <p align="center">Required field with mark*</p>

        <form method="POST" action="certification_action.php">
            <table border="1" id="myTable">
                <tr>
                    <td>Semester*</td>
                    <td width="1px">:</td>
                    <td>
                        <select size="1" id="sem" name="sem" required>                        
                            <option value="">&nbsp;</option>
                            <option value="1">1</option>;                           
                            <option value="2">2</option>;                        
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Year*</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="year" size="5" required>                                    
                    </td>
                </tr>
                <tr>
                    <td>Certification Name*</td>
                    <td>:</td>
                    <td>
                        <textarea rows="4" name="cert_name" cols="20" required></textarea>
                    </td>
                </tr>
                <tr>
                 <td>Remark</td>
                    <td>:</td>
                    <td>
                        <textarea rows="4" name="remark" cols="20"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right"> 
                    <input type="submit" value="Submit" name="B1">                
                    <input type="reset" value="Reset" name="B2">
                    <input type="reset" value="Cancel" name="B3" onclick="hide_AddEntry()">
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