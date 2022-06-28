<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: http://mersey.cs.nott.ac.uk/~psxjw13/Login.php");
}
?>
<html>
<head>

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
$record = $_GET['id'];
?>

<title>Vehicle Edit</title>
<script src=javascriptFunctions.js type='text/javascript'></script>

<link rel="stylesheet" href="myStyle.css"/>

</head>

<body>

<h1>Edit vehicle</h1>
<p>Enter the new details to be stored in this record. You may copy and paste any records you wish to keep. All fields should be filled.</p>

<form name = 'VehicleEdit' method="post" onsubmit="return checkInputVehicleE()">
Type: <input type='text' name = 'type' value = '' size = '10'> 
Colour: <input type='text' name='colour' value='' size = '10'>
Licence: <input type='text' name='licence' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>
</body>

<table>
    <tr>
        <th>Type</th>
        <th>Colour</th>
        <th>Licence</th>
        <th>Owner ID</th>
    </tr>
<?php
$servername = "mysql.cs.nott.ac.uk";
$username = "psxjw13_C1B";
$password = "AUXYUG";
$dbname = "psxjw13_C1B";
$conn = mysqli_connect($servername, $username, $password,
$dbname);

$sql = "SELECT * FROM Vehicle WHERE Vehicle_ID = '$record';";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $row['Vehicle_type'];?></td>
        <td><?php echo $row['Vehicle_colour'];?></td>
        <td><?php echo $row['Vehicle_licence'];?></td>
        <td><?php echo $row['People_ID'];?></td>
    </tr>
<?php
}
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $colour = $_POST['colour'];
    $licence = $_POST['licence'];
    $sql = "UPDATE Vehicle SET Vehicle_type='$type',Vehicle_colour='$colour',Vehicle_licence='$licence' WHERE Vehicle_ID='$record'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }
}
mysqli_close($conn); 
?>
</table>
</html>
<script>
    function checkInputVehicleE(){
    var x = document.forms['VehicleEdit']['type'].value
    var y = document.forms['VehicleEdit']['colour'].value
    var z = document.forms['VehicleEdit']['licence'].value
    var xx = document.forms['VehicleEdit']['ownerid'].value
    if (x == '') {
        alert('Please fill all fields');
        return false
    }
    if (y == '') {
        alert('Please fill all fields');
        return false
    }
    if (z=='') {
        alert('Please fill all fields');
        return false
    }
    if (xx=='') {
        alert('Please fill all fields');
        return false
    }
}
</script>
