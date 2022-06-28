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

<title>New Police Account Entry</title>
<script src=javascriptFunctions.js type='text/javascript'></script>
<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>

<h1>Enter details for new police account</h1>


<form name = 'NewAccount' method="post" onsubmit="return checkInputAccount()">
Username: <input type='text' name='username' value='' size = '10'>
Password: <input type='text' name='password' value='' size = '10'>
Re-enter password: <input type='text' name='repassword' value='' size = '10'>
Admin: <input type='text' name='admin' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>

</body>

<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/NewPoliceAccount.php
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
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $admin = $_POST['admin'];
        $sql = "INSERT INTO Login_Details (Username,password,Admin) VALUES ('$username','$password','$admin')";
        if (mysqli_query($conn,$sql)) {
            echo 'New account added succesfully';
        } else {
            echo 'Error please try again';
        }
    }
    
}
mysqli_close($conn); 
?>
</html>

