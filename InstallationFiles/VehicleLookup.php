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

<title>Vehicle Lookup</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>

<h1>Lookup vehicle</h1>
<p>Enter a licence number.</p>

<form name = 'VehicleLookup' method="post" onsubmit="return checkInputVehicle()">
Liscence No.: <input type='text' name='licence' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>
</body>

<table>
    <tr>
        <th>Type</th>
        <th>Colour</th>
        <th>ID</th>
        <th>Licence</th>
        <th>Owner Name</th>
        <th>Owner Licence No.</th>
    </tr>

<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/VehicleLookup.php
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
    if (isset($_POST['licence'])) {
        $input = $_POST['licence'];
        $sql = "SELECT * FROM Vehicle WHERE Vehicle_licence='$input';";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {

            $PID = $row['People_ID'];
            $sql3 = "SELECT * FROM People WHERE People_ID = '$PID';";
            $result3 = mysqli_query($conn,$sql3);
            $row3  = mysqli_fetch_assoc($result3);

            echo '<tr><td>'.$row['Vehicle_type'].'</td><td>'.$row['Vehicle_colour'].'</td><td>'.$row['Vehicle_ID'].'</td><td>'.$row['Vehicle_licence'];
            $ownerDetails = '</td><td>'.$row3['People_First_Name'].' '.$row3['People_Second_Name'].'</td><td>'.$row3['People_licence'].'</td></tr>';
            if ($row['People_ID']=='') {
                $ownerDetails = '</td><td>'.'Owner not known'.'</td><td>'.'Null'.'</td></tr>';
                echo $ownerDetails;
            } else {
                echo $ownerDetails;
            }
        }
    }

}
mysqli_close($conn); 
?>

</table>
</html>

