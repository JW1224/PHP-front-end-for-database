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

<title>Change Password Page</title>
<script src=javascriptFunctions.js type='text/javascript'></script>

<link rel="stylesheet" href="myStyle.css"/>
</head>

<body>
<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/ChangePassword.php
?>

<h1>Change Password</h1>
<p>Please Enter your new password.</p>

<form name = 'passChange' method="post" onsubmit="return validatePassword()">
Password: <input type='text' name = 'Password' value = '' size = '10'> 
Re-enter Password: <input type='text' name='PasswordConfirm' value='' size = '10'>
<input type='submit' value='Change Password'>
<br>
</form>
</body>
</html>

<?php
if (isset($_POST['Password'])) {
    if (isset($_POST['PasswordConfirm'])) {
        $pass = $_POST['Password'];
        $user = $_SESSION['user'];
        $servername = "mysql.cs.nott.ac.uk";
        $username = "psxjw13_C1B";
        $password = "AUXYUG";
        $dbname = "psxjw13_C1B";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if(mysqli_connect_errno()) {
            echo "Failed to connect to MySQL:".mysqli_connect_error();
            die();
        } else {
            $sql = "UPDATE Login_Details SET password='$pass' WHERE Username='$user'";
            if (mysqli_query($conn,$sql)) {
                echo "Record Updated";
            } else {
                echo "Error updating";
            }
        }
        mysqli_close($conn); 
    }
}
?>