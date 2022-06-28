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

$owner = $_GET['id'];
?>

<title>People Delete</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>

<h1>Delete people</h1>
<p>The following records will be deleted.</p>

</body>

<table>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>ID</th>
        <th>Licence</th>
    </tr>


<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/DeletePerson.php
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
    $sql = "SELECT * FROM People WHERE People_ID = '$owner';";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['People_First_Name'].' '.$row['People_Second_Name'];?></td>
                <td><?php echo $row['People_address'];?></td>
                <td><?php echo $row['People_ID'];?></td>
                <td><?php echo $row['People_licence'];?></td>
            </tr>
        <?php
    }
}
mysqli_close($conn); 
?>
</table>
<br>
<br>
<table>
    <tr>
        <th>Vehicle ID</th>
        <th>Type</th>
        <th>Colour</th>
        <th>Licence</th>
    </tr>

<?php
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
else {
    $sql = "SELECT * FROM Vehicle WHERE People_ID = '$owner';";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) 
    {
        ?>
            <tr>
                <td><?php echo $row['Vehicle_ID'];?></td>
                <td><?php echo $row['Vehicle_type'];?></td>
                <td><?php echo $row['Vehicle_colour'];?></td>
                <td><?php echo $row['Vehicle_licence'];?></td>
            </tr>
    <?php
    }
    ?>
    </table>
    <br>
    <br>
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
    $sql = "SELECT * FROM Incident WHERE People_ID = '$owner';";
    $result = mysqli_query($conn, $sql);
    $incidentArray = array();
    while($row = mysqli_fetch_assoc($result)) {
        array_push($incidentArray,$row['Incident_ID']);
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
    $incidentStr = implode(',',$incidentArray);
    ?>
    </table>
    <br>
    <br>
    <table>
        <tr>
            <th>Fine ID</th>
            <th>Amount</th>
            <th>Points</th>
            <th>Incident ID</th>
        </tr>
    <?php
    error_reporting(0);
    $sql = "SELECT * FROM Fines WHERE Incident_ID IN ($incidentStr);";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['Fine_ID'];?></td>
            <td><?php echo $row['Fine_Amount'];?></td>
            <td><?php echo $row['Fine_Points'];?></td>
            <td><?php echo $row['Incident_ID'];?></td>
        </tr>
        <?php
    }
}
mysqli_close($conn);
?>
</table>
<a href="http://mersey.cs.nott.ac.uk/~psxjw13/deletePage.php?id=<?php echo $owner; ?>">Confirm Delete</a>
</html>