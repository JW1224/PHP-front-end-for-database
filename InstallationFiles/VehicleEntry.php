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
<title>Vehicle Entry</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>

<h1>Enter vehicle</h1>
<p>Enter details of the vehicle and either select from stored people or add the owner.</p>


<form name = 'VehicleEntry' method="post" onsubmit="return checkInputNewVehicle()">
Type: <input type='text' name='type' value='' size = '10'>
Colour: <input type='text' name='colour' value='' size = '10'>
Licence: <input type='text' name='licence' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>

</body>

<table>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>ID</th>
        <th>Licence</th>
    </tr>

<?php

$owner = $_GET['id'];
echo 'Current Person ID Selected: '.$owner.'</br>';

//http://mersey.cs.nott.ac.uk/~psxjw13/VehicleEntry.php
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
    $sql = "SELECT * FROM People;";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo '<tr><td>'.$row['People_First_Name'].' '.$row['People_Second_Name'].'</td><td>'.$row['People_address'].'</td><td>'.$row['People_ID'].'</td><td>'.$row['People_licence'].'</td></tr>';     
    }
}
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $colour = $_POST['colour'];
    $licence = $_POST['licence'];
    $sql2 = "INSERT INTO Vehicle (Vehicle_type,Vehicle_colour,Vehicle_licence,People_ID) VALUES ('$type','$colour','$licence','$owner')";
    if (mysqli_query($conn,$sql2)) {
        echo 'New vehicle added succesfully </br>';
    } else {
        echo 'Error please try again';
    }
    mysqli_close($conn); 
}
?>

</table>
<br>
<br>
</html>

