<?php
session_start();
include("config.php");

function cumulativeGPA($arr) {
    global $conn;
    $userID = $_SESSION["UID"];
    $query = "SELECT AVG($arr) AS cumulative_gpa FROM cgpa WHERE userID = $userID";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return number_format($row['cumulative_gpa'], 2);
}

function compCount($level){
    global $conn;
    $userID = $_SESSION["UID"];
    $query = "SELECT COUNT(*) AS count FROM competition WHERE userID = $userID AND level = '$level'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

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
            <li><a href="kpi.php" class="active"><i class="fa fa-book" aria-hidden="true"></i> KPI Indicator</a>
            <li><a href="activity.php"><i class="fa fa-futbol-o" aria-hidden="true"></i> Activity</a>
            <li><a href="competition.php"><i class="fa fa-fighter-jet" aria-hidden="true"></i> Competition</a>
            <li><a href="certification.php"><i class="fa fa-columns" aria-hidden="true"></i> Certification</a>
        </ul>
    </div>
    <div class="row">
    <h2 style="margin-left: 20px;">| CGPA</h2>
    <table id="projectable" style="margin: 0px 20px 0px 20px;">
            <tr>
                <th width="10%">Sem & Year</th>
                <th width="20%">Target GPA</th>
                <th width="20%">Result</th>
                <th width="35%">Remark</th>
                <th width="15%">Option</th>
            </tr>
            <tr>
            <?php
                $sql = "SELECT * FROM cgpa WHERE userID=". $_SESSION["UID"];
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $numrow=1;
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["gpa"] .
                        "</td><td>" . $row["result"] . "</td><td>" . $row["remark"] . "</td>";
                        echo '<td> <a href="kpi_edit.php?id=' . $row["cgpa_id"] . '">Edit</a>&nbsp;|&nbsp;';
                        echo '<a href="kpi_delete.php?id=' . $row["cgpa_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="7">0 results</td></tr>';
                } 
        
            ?>
            </tr>
        </table>
        <?php
        if(isset($_SESSION["UID"])){
        ?>
            <div style="margin-left: 20px; padding-top:10px; width:100%;">
                <input type="button" value="Add New" style="padding:10px 10px;" onclick="show_AddEntry()">
            </div>
        <?php
        }
        ?>
    </div>
    <div id = "kpi">
            <h2 style="margin-left: 20px;">| Indicator</h2>
            <table id="projectable" style="margin: 0px 20px 0px 20px;">
                <tr>
                    <th width=30%>Indicator</th>
                    <th width=20%>Faculty KPI</th>
                    <th width=20%>My KPI</th>
                    <th width=20%>Result CGPA</th>
                </tr>
                <tr>
                    <td>CGPA</td>
                    <td>>=3.0</td>
                    <td>
                        <?php
                        $cgpa = cumulativeGPA('gpa');
                        echo $cgpa;
                        ?>
                    </td>
                    <td>
                        <?php
                        $cgpa = cumulativeGPA('result');
                        echo $cgpa;
                        ?>
                    </td>
                </tr>
            </table>
            <br>
            <table table id="projectable" style="margin: 0px 20px 0px 20px;">
                <tr>
                    <th>Student Activity</th>
                    <th>Faculty Target</th>
                    <th>Participation</th>
                </tr>
                <tr>
			        <td>Faculty</td>
			        <td>4</td>
			        <td>
                        <?php
                        $count = compCount("Faculty");
                        echo $count;
                        ?>
                    </td>
		        </tr>
		        <tr>
			        <td>University</td>
			        <td>4</td>
			        <td>
                        <?php
                        $count = compCount("University");
                        echo $count;
                        ?>
                    </td>
		        </tr>
		        <tr>
			        <td>National</td>
			        <td>1</td>
			        <td>
                        <?php
                        $count = compCount("National");
                        echo $count;
                        ?>
                    </td>
		        </tr>
		        <tr>
			        <td>International</td>
			        <td>1</td>
			        <td>
                        <?php
                        $count = compCount("International");
                        echo $count;
                        ?>
                    </td>
		        </tr>
            </table>
        </div>
    <div id="form">
        <h3 align="center">Add Result</h3>
        <p align="center">Required field with mark*</p>

        <form method="POST" action="kpi_action.php">
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
                    <td>Target GPA*</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="gpa" size="5" required>
                    </td>
                </tr>
                <tr>
                    <td>Result*</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="result_gpa" size="5" required>
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