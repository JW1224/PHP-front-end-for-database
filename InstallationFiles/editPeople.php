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

<title>People Edit</title>
<script src=javascriptFunctions.js type='text/javascript'></script>

<link rel="stylesheet" href="myStyle.css"/>

</head>

<body>

<h1>Edit people</h1>
<p>Enter the new details to be stored in this record. You may copy and paste any records you wish to keep. All fields should be filled.</p>

<form name = 'PeopleEdit' method="post" onsubmit="return checkInputPeopleE()">
First Name: <input type='text' name = 'first' value = '' size = '10'> 
Last Name: <input type='text' name='last' value='' size = '10'>
Address: <input type='text' name='address' value='' size = '10'>
Liscence No.: <input type='text' name='licence' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>
</body>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>Licence</th>
    </tr>
<?php
$servername = "mysql.cs.nott.ac.uk";
$username = "psxjw13_C1B";
$password = "AUXYUG";
$dbname = "psxjw13_C1B";
$conn = mysqli_connect($servername, $username, $password,
$dbname);

$sql = "SELECT * FROM People WHERE People_ID = '$record';";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $row['People_First_Name'];?></td>
        <td><?php echo $row['People_Second_Name'];?></td>
        <td><?php echo $row['People_address'];?></td>
        <td><?php echo $row['People_licence'];?></td>
    </tr>
<?php
}
if (isset($_POST['first'])) {
    $first = $_POST['first'];
    $last = $_POST['last'];
    $address = $_POST['address'];
    $licence = $_POST['licence'];
    $sql = "UPDATE People SET People_First_Name='$first',People_Second_Name='$last',People_address='$address',People_licence='$licence' WHERE People_ID='$record'";
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
    function checkInputPeopleE(){ 
    var x = document.forms['PeopleEdit']['first'].value
    var y = document.forms['PeopleEdit']['last'].value
    var z = document.forms['PeopleEdit']['licence'].value
    var xx = document.forms['PeopleEdit']['address'].value
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

