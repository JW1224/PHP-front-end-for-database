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

<title>New Fine Entry</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>

<h1>Enter details for new fine</h1>


<form name = 'NewFine' method="post" onsubmit="return checkInputFine()">
Amount: <input type='text' name='amount' value='' size = '10'>
Points: <input type='text' name='points' value='' size = '10'>
Incident ID: <input type='text' name='incident' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>

</body>
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
//http://mersey.cs.nott.ac.uk/~psxjw13/NewFine.php
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
        </tr>
    <?php
    }
    if (isset($_POST['amount'])) {
        $amount = $_POST['amount'];
        $points = $_POST['points'];
        $incident = $_POST['incident'];
        $sql = "INSERT INTO Fines (Fine_Amount,Fine_Points,Incident_ID) VALUES ('$amount','$points','$incident')";
        if (mysqli_query($conn,$sql)) {
            echo 'New fine added succesfully';
        } else {
            echo 'Error please try again';
        }
    }
    
}
mysqli_close($conn); 
?>
</table>
</html>

