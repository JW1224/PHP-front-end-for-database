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

<title>Person Entry</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>

<h1>Enter Person</h1>
<p>Enter details of the person.</p>


<form name = 'PersonInput' method="post" onsubmit="return checkInputNewPerson()">
First Name: <input type='text' name='firstname' value='' size = '10'>
Last Name: <input type='text' name='lastname' value='' size = '10'>
Address: <input type='text' name='Address' value='' size = '10'>
Licence: <input type='text' name='LicenceP' size = '10' id = 'ownerid'>
<input type='submit' value='Enter Details'>
<br>
</form>

</body>

<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/PersonEntry.php
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
    if (isset($_POST['firstname'])) {
        $first = $_POST['firstname'];
        $last = $_POST['lastname'];
        $Address = $_POST['Address'];
        $Licence = $_POST['LicenceP'];
        $sql = "INSERT INTO People (People_First_Name,People_Second_Name,People_Address,People_licence) VALUES ('$first','$last','$Address','$Licence')";
        if (mysqli_query($conn,$sql)) {
            echo 'New person added succesfully';
        } else {
            echo 'Error please try again';
        }
    }
    
}
mysqli_close($conn); 
?>
</html>

