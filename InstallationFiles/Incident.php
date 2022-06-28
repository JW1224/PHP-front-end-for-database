<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: http://mersey.cs.nott.ac.uk/~psxjw13/Login.php");
}
?>
<html>
<head>
<link rel="stylesheet" href="myStyle.css"/>

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

<title>Incident Report</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<style>
table, th, td {
    border-collapse: collapse;
    border-style: solid;
  }
table {
    width:100%;
}
th{
  background-color: rgb(98, 205, 255);
}
tr{
  background-color: white;
}

body {
  background-color: lightblue;
}

h1 {
  color: navy;
  margin-left: 20px;
}
tr:nth-child(even) {background-color: #AED6F1;}
tr:hover {background-color: #2E86C1;}
* {
 font-family: Arial;
}
</style>
</head>

<body>

<h1>Add Incident Report</h1>
<p>Enter the details of the incident.</p>

<form name = 'Incident Entry' method="post" onsubmit="return checkInputIncident()">
Vehicle ID: <input type='text' name = 'vehicleid' value = '' size = '10'> 
Offense ID: <input type='text' name='offenceid' value='' size = '10'>
Incident Report: <input type='text' name='report' value='' size = ''>
Incident Date: <input type='date' name='date' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>
</body>
<h2>Vehicles owned by selected person</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Colour</th>
        <th>Licence</th>
    </tr>


<?php

$owner = $_GET['id'];
echo 'Current Person ID Selected: '.$owner.'</br>';

//http://mersey.cs.nott.ac.uk/~psxjw13/Incident.php
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
    $sql = "SELECT * FROM Vehicle WHERE People_ID = '$owner';";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['Vehicle_ID'];?></td>
            <td><?php echo $row['Vehicle_type'];?></td>
            <td><?php echo $row['Vehicle_colour'];?></td>
            <td><?php echo $row['Vehicle_licence'];?></td>
        </tr>
        <?php
    }
}
mysqli_close($conn); 
?>

</table>

<h2>List of offenses</h2>
<table>
    <tr>
        <th>Offence ID</th>
        <th>Offence Description</th>
        <th>Offence Max Fine</th>
        <th>Offence Max Points</th>
    </tr>
<?php
$servername = "mysql.cs.nott.ac.uk";
$username = "psxjw13_C1B";
$password = "AUXYUG";
$dbname = "psxjw13_C1B";
$conn = mysqli_connect($servername, $username, $password,
$dbname);
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL:".mysqli_connect_error();
    die();
}
else {
    $sql3 = "SELECT * FROM Offence;";
    $result3 = mysqli_query($conn,$sql3);
    while($row3 = mysqli_fetch_assoc($result3)) {
?>
        <tr>
            <td><?php echo $row3['Offence_ID'];?></td>
            <td><?php echo $row3['Offence_description'];?></td>
            <td><?php echo $row3['Offence_maxFine'];?></td>
            <td><?php echo $row3['Offence_maxPoints'];?></td>
        </tr>
        <?php
    }
}
mysqli_close($conn);
?>

<?php
if (isset($_POST['date'])) {
    $vehID = $_POST['vehicleid'];
    $date = $_POST['date'];
    $offID = $_POST['offenceid'];
    $report = $_POST['report'];

    $servername = "mysql.cs.nott.ac.uk";
    $username = "psxjw13_C1B";
    $password = "AUXYUG";
    $dbname = "psxjw13_C1B";
    $conn = mysqli_connect($servername, $username, $password,
    $dbname);
    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL:".mysqli_connect_error();
        die();
    }
else {
    $sql4 = "INSERT INTO Incident (Vehicle_ID,People_ID,Incident_Date,Incident_Report,Offence_ID) VALUES ('$vehID','$owner','$date','$report','$offID');";
    if (mysqli_query($conn,$sql4)) {
        echo 'New incident added succesfully';
    } else {
        echo 'Error please try again';
    }
    }
mysqli_close($conn);
}
?>


</table>
</html>