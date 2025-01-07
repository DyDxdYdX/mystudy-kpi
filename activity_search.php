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
<body onload="show_AddEntry()">
    <div class="header"></div>

    <?php
        $search = "";
        if(isset($_SESSION["UID"])){
            include 'logged_menu.php';
        }
        else{
            include 'menu.php';
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"]; 
        }    
    ?>
    <div class="row">
        <h2 style="margin-left: 20px;">| Search Result:&nbsp;<?=$search?></h2>
        <div style="text-align: left; margin-left: 20px; width:100%">
        <form action="activity_search.php" method="post">
            <input type="text" placeholder=" Search" name="search" style="padding: 8px 10px;">
            <input type="submit" value="Search" style="padding: 8px 21px;">
        </form> 
        </div>
        <table id="projectable" style="margin: 20px 20px 0px 20px;">
            <tr>
                <th width="5%">Sem</th>
                <th width="10%">Year</th>
                <th width="45%">Activity Name</th>
                <th width="40%">Remark</th>
            </tr>
            <?php
            if ($search!="") {
                $search = $_POST["search"]; 
                
                // Split the search string into individual words
                $keywords = explode(" ", $search);

                // Prepare the SQL query with multiple LIKE conditions
                $sql = "SELECT * FROM activity WHERE (";

                // Build the conditions dynamically for single keyword
                $conditions = [];
                foreach ($keywords as $index => $keyword) {
                    $conditions[] = "act_name LIKE '%$keyword%'";
                }                
                
                // Combine
                $sql .= implode(" OR ", $conditions);

                // Select only with this userID
                $sql .= " OR act_name LIKE '%$search%') AND userID=" . $_SESSION["UID"]; 
                
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    $numrow=1;
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row["sem"] . "</td><td>" . $row["year"]. "</td><td>" . $row["act_name"] .
                        "</td><td>" . $row["remark"] . "</td>";
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="7">0 results</td></tr>';
                } 
                
                mysqli_close($conn);
            }
            else{
                $sql = "SELECT * FROM activity WHERE userID=". $_SESSION["UID"];
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $numrow=1;
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row["sem"] . "</td><td>" . $row["year"]. "</td><td>" . $row["act_name"] .
                        "</td><td>" . $row["remark"] . "</td>";
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                }
                mysqli_close($conn);
            }
        ?>
        </table>
    </div>
    <footer>
        <p>Copyright (c) 2023 - Dexter Dykes FKI</p>
    </footer>
</body>
</html>