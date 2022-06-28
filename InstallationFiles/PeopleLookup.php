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
?>

<title>People Lookup</title>
<script src=javascriptFunctions.js type='text/javascript'></script>

<link rel="stylesheet" href="myStyle.css"/>

</head>

<body>

<h1>Lookup people</h1>
<p>Enter either partial name or licence number.</p>

<form name = 'PeopleLookup' method="post" onsubmit="return checkInputPeople()">
First Name: <input type='text' name = 'first' value = '' size = '10'> 
Last Name: <input type='text' name='last' value='' size = '10'>
Liscence No.: <input type='text' name='licence' value='' size = '10'>
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
        <th>Add Vehicle</th>
        <th>Add Incident</th>
        <?php
        if ($_SESSION['admin']=='Admin') {?>
        <th>Delete</th>
        <?php
        }
        ?>
    </tr>

<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/PeopleLookup.php
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
    if (isset($_POST['first']) || isset($_POST['last']) || isset($_POST['licence'])) {
        $sql = "SELECT * FROM People;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            if (strtolower($row['People_Second_Name']) == strtolower($_POST['last']) || $_POST['last']=='') {
                if (strtolower($row['People_licence']) == strtolower($_POST['licence']) || $_POST['licence']=='') {
                    if (strtolower($row['People_First_Name']) == strtolower($_POST['first']) || $_POST['first']=='') {
                        ?>
                        <tr>
                            <td><?php echo $row['People_First_Name'].' '.$row['People_Second_Name'];?></td>
                            <td><?php echo $row['People_address'];?></td>
                            <td><?php echo $row['People_ID'];?></td>
                            <td><?php echo $row['People_licence'];?></td>
                            <td><a href="http://mersey.cs.nott.ac.uk/~psxjw13/VehicleEntry.php?id=<?php echo $row['People_ID']; ?>">Add Vehicle</a></td>
                            <td><a href="http://mersey.cs.nott.ac.uk/~psxjw13/Incident.php?id=<?php echo $row['People_ID']; ?>">Add Incident</a></td>
                            <?php
                            if ($_SESSION['admin']=='Admin') {?>
                            <td><a href="http://mersey.cs.nott.ac.uk/~psxjw13/DeletePerson.php?id=<?php echo $row['People_ID']; ?>">Delete</a></td>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
            }
        }
    }
}
mysqli_close($conn); 
?>

</table>
</html>

