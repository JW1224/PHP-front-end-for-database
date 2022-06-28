<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: http://mersey.cs.nott.ac.uk/~psxjw13/Login.php");
}
?>
<html>
<head>
<link rel="stylesheet" href="myStyle.css">
<button id="myButton" class="float-left submit-button" >Return to Main Page</button>
<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/MainPage.php";
    };
</script>

<button id="logout" class="float-left submit-button" >Logout</button>
<script type="text/javascript">
    document.getElementById("logout").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/logout.php";
    };
</script>


<?php
echo 'Current User: '.$_SESSION['user'];
?>

<title>Database Viewer</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>

<h1>Table Viewer</h1>

<label for="table">Choose a table:</label>
<form name = 'selectTable' method="post">
<select name="table" id="table">
  <option value="People">People</option>
  <option value="Vehicle">Vehicle</option>
  <option value="Incident">Incident</option>
  <option value="Offence">Offence</option>
  <option value="Fines">Fines</option>
</select>
<br><br>
<input type="submit" value="Submit">
</form>
</body>
<br>
<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/tableViewer.php
// MySQL database information
$servername = "mysql.cs.nott.ac.uk";
$username = "psxjw13_C1B";
$password = "AUXYUG";
$dbname = "psxjw13_C1B";
$conn = mysqli_connect($servername, $username, $password,
$dbname);
if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL:".mysqli_connect_error();
    die();
}
else
{   
    if (isset($_POST['table'])){
        if ($_POST['table']=='Incident'){
            ?>
            <h2>Incident</h2>
            <table>
                <tr>
                    <th>Incident ID</th>
                    <th>Vehicle ID</th>
                    <th>People ID</th>
                    <th>Incident Date</th>
                    <th>Incident Report</th>
                    <th>Offence ID</th>
                </tr>
            <?php
            $sql = "SELECT * FROM Incident;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['Incident_ID'];?></td>
                    <td><?php echo $row['Vehicle_ID'];?></td>
                    <td><?php echo $row['People_ID'];?></td>
                    <td><?php echo $row['Incident_Date'];?></td>
                    <td><?php echo $row['Incident_Report'];?></td>
                    <td><?php echo $row['Offence_ID'];?></td>
                    <?php
                    if ($_SESSION['admin']=='Admin') {
                        ?>
                        <td><a href="http://mersey.cs.nott.ac.uk/~psxjw13/editIncident.php?id=<?php echo $row['Incident_ID']; ?>">Edit</a></td>
                        <?php
                    }
                    ?>
                </tr>
            <?php
            }
        } 

        if ($_POST['table']=='People'){
            ?>
            <h2>People</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Licence</th>
                </tr>
            <?php
            $sql = "SELECT * FROM People;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['People_ID'];?></td>
                    <td><?php echo $row['People_First_Name'];?></td>
                    <td><?php echo $row['People_Second_Name'];?></td>
                    <td><?php echo $row['People_address'];?></td>
                    <td><?php echo $row['People_licence'];?></td>
                    <?php
                    if ($_SESSION['admin']=='Admin') {
                        ?>
                        <td><a href="http://mersey.cs.nott.ac.uk/~psxjw13/editPeople.php?id=<?php echo $row['People_ID']; ?>">Edit</a></td>
                        <?php
                    }
                    ?>
                </tr>
            <?php
            }
        } 

        if ($_POST['table']=='Vehicle'){
            ?>
            <h2>Vehicle</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Colour</th>
                    <th>Licence</th>
                    <th>Owner</th>
                </tr>
            <?php
            $sql = "SELECT * FROM Vehicle;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['Vehicle_ID'];?></td>
                    <td><?php echo $row['Vehicle_type'];?></td>
                    <td><?php echo $row['Vehicle_colour'];?></td>
                    <td><?php echo $row['Vehicle_licence'];?></td>
                    <td><?php echo $row['People_ID'];?></td>
                    <?php
                    if ($_SESSION['admin']=='Admin') {
                        ?>
                        <td><a href="http://mersey.cs.nott.ac.uk/~psxjw13/editVehicle.php?id=<?php echo $row['Vehicle_ID']; ?>">Edit</a></td>
                        <?php
                    }
                    ?>
                </tr>
            <?php
            }
        } 

        if ($_POST['table']=='Offence'){
            ?>
            <h2>Offence</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Max Fine</th>
                    <th>Max Points</th>
                </tr>
            <?php
            $sql = "SELECT * FROM Offence;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['Offence_ID'];?></td>
                    <td><?php echo $row['Offence_description'];?></td>
                    <td><?php echo $row['Offence_maxFine'];?></td>
                    <td><?php echo $row['Offence_maxPoints'];?></td>
                </tr>
            <?php
            }
        }

        if ($_POST['table']=='Fines'){
            ?>
            <h2>Fines</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Points</th>
                    <th>Incident ID</th>
                </tr>
            <?php
            $sql = "SELECT * FROM Fines;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['Fine_ID'];?></td>
                    <td><?php echo $row['Fine_Amount'];?></td>
                    <td><?php echo $row['Fine_Points'];?></td>
                    <td><?php echo $row['Incident_ID'];?></td>
                    <?php
                    if ($_SESSION['admin']=='Admin') {
                        ?>
                        <td><a href="http://mersey.cs.nott.ac.uk/~psxjw13/editFines.php?id=<?php echo $row['Fine_ID']; ?>">Edit</a></td>
                        <?php
                    }
                    ?>
                </tr>
            <?php
            }
        } 
    }
}
mysqli_close($conn); 
?>
</table>
</html>

