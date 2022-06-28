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

<title>Fines Edit</title>
<script src=javascriptFunctions.js type='text/javascript'></script>

<link rel="stylesheet" href="myStyle.css"/>

</head>

<body>

<h1>Edit fines</h1>
<p>Enter the new details to be stored in this record. You may copy and paste any records you wish to keep. All fields should be filled.</p>

<form name = 'FinesEdit' method="post" onsubmit="return checkInputFinesE()">
Amount: <input type='text' name = 'amount' value = '' size = '10'> 
Points: <input type='text' name='points' value='' size = '10'>
Incident ID: <input type='text' name='incidentid' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>
</body>

<table>
    <tr>
        <th>Amount</th>
        <th>Points</th>
        <th>Incident ID</th>
    </tr>
<?php
$servername = "mysql.cs.nott.ac.uk";
$username = "psxjw13_C1B";
$password = "AUXYUG";
$dbname = "psxjw13_C1B";
$conn = mysqli_connect($servername, $username, $password,
$dbname);

$sql = "SELECT * FROM Fines WHERE Fine_ID = '$record';";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $row['Fine_Amount'];?></td>
        <td><?php echo $row['Fine_Points'];?></td>
        <td><?php echo $row['Incident_ID'];?></td>
    </tr>
<?php
}
if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    $points = $_POST['points'];
    $incidentid = $_POST['incidentid'];
    $sql = "UPDATE Fines SET Fine_Amount='$amount', Fine_Points='$points', Incident_ID='$incidentid' WHERE Fine_ID='$record'";
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
    function checkInputFinesE(){
    var x = document.forms['FinesEdit']['amount'].value
    var y = document.forms['FinesEdit']['points'].value
    var z = document.forms['FinesEdit']['incidentid'].value
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
}
</script>
