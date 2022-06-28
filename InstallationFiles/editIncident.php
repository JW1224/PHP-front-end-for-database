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

<title>Incident Edit</title>
<script src=javascriptFunctions.js type='text/javascript'></script>

<link rel="stylesheet" href="myStyle.css"/>

</head>

<body>

<h1>Edit incident</h1>
<p>Enter the new details to be stored in this record. You may copy and paste any records you wish to keep. All fields should be filled.</p>

<form name = 'IncidentEdit' method="post" onsubmit="return checkInputIncidentE()">
Vehicle ID: <input type='text' name = 'vehicleid' value = '' size = '10'> 
People ID: <input type='text' name='peopleid' value='' size = '10'>
Incident Date: <input type='date' name='date' value='' size = '10'>
Offence ID: <input type='text' name='offenceid' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>
</body>

<table>
    <tr>
        <th>Vehicle ID</th>
        <th>People ID</th>
        <th>Incident Date</th>
        <th>Report</th>
        <th>Offence ID</th>
    </tr>
<?php
$servername = "mysql.cs.nott.ac.uk";
$username = "psxjw13_C1B";
$password = "AUXYUG";
$dbname = "psxjw13_C1B";
$conn = mysqli_connect($servername, $username, $password,
$dbname);

$sql = "SELECT * FROM Incident WHERE Incident_ID = '$record';";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $row['Vehicle_ID'];?></td>
        <td><?php echo $row['People_ID'];?></td>
        <td><?php echo $row['Incident_Date'];?></td>
        <td><?php echo $row['Incident_Report'];?></td>
        <td><?php echo $row['Offence_ID'];?></td>
    </tr>
<?php
}
if (isset($_POST['type'])) {
    $veh = $_POST['vehicleid'];
    $people = $_POST['peopleid'];
    $date = $_POST['date'];
    $rep = $_POST['report'];
    $offid = $_POST['offenceid'];
    $sql = "UPDATE Incident SET Vehicle_ID='$veh',People_ID='$people',Incident_Date='$date',Incident_Report='$rep',Offence_ID='$offid' WHERE Incident_ID='$record'";
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
    function checkInputIncidentE(){
    var x = document.forms['IncidentEdit']['vehicleid'].value
    var y = document.forms['IncidentEdit']['peopleid'].value
    var z = document.forms['IncidentEdit']['date'].value
    var xx = document.forms['IncidentEdit']['offenceid'].value
    if (x == '') {
        alert('Please fill all fields')
        return false
    }
    if (y == '') {
        alert('Please fill all fields')
        return false
    }
    if (z=='') {
        alert('Please fill all fields')
        return false
    }
    if (xx=='') {
        alert('Please fill all fields')
        return false
    }
}
</script>
