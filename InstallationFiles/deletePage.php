<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: http://mersey.cs.nott.ac.uk/~psxjw13/Login.php");
}
?>
<html>
<head>
<link rel="stylesheet" href="myStyle.css"/>

<button id="logout" class="float-left submit-button" >Logout</button>
<script type="text/javascript">
    document.getElementById("logout").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/logout.php";
    };
</script>
</head>
<?php
$owner = $_GET['id'];
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
    $sql = "SELECT * FROM Incident WHERE People_ID = '$owner';";
    $result = mysqli_query($conn, $sql);
    $incidentArray = array();
    while($row = mysqli_fetch_assoc($result)) {
        array_push($incidentArray,$row['Incident_ID']);
    }
    $incidentStr = implode(',',$incidentArray);

    $sql = "DELETE FROM Fines WHERE Incident_ID = ('$incidentStr');";
    if (mysqli_query($conn,$sql)) {
        echo 'Fine deleted succesfully </br>';
    } else {
        echo 'Error please try again';
    }

    $sql = "DELETE FROM Incident WHERE People_ID = '$owner';";
    if (mysqli_query($conn,$sql)) {
        echo 'Incident deleted succesfully </br>';
    } else {
        echo 'Error please try again';
    }

    $sql = "DELETE FROM Vehicle WHERE People_ID = '$owner';";
    if (mysqli_query($conn,$sql)) {
        echo 'Vehicle deleted succesfully </br>';
    } else {
        echo 'Error please try again'.mysqli_error($conn);
    }

    $sql = "DELETE FROM People WHERE People_ID = '$owner';";
    if (mysqli_query($conn,$sql)) {
        echo 'Person deleted succesfully </br>';
    } else {
        echo 'Error please try again'.mysqli_error($conn);
    }
}
mysqli_close($conn);
echo 'Deleting Completed';
?>
<a href="http://mersey.cs.nott.ac.uk/~psxjw13/MainPage.php">Return to main page</a>
</html>