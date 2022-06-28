<?php
session_start();
?>
<html>
<head>
<title>Login Page</title>
<script src=javascriptFunctions.js type='text/javascript'></script>

<link rel="stylesheet" href="myStyle.css"/>

</head>

<body>

<h1>Login</h1>
<p>Please enter your login details.</p>

<form name = 'Login' method="post" onsubmit = 'return checkPass()'>
Username: <input type='text' name = 'Username' value = '' size = '10'> 
Password: <input type='text' name='Password' value='' size = '10'>
<input type='submit' value='Enter Details'>
<br>
</form>
</body>
</html>

<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/Login.php
// MySQL database information
if (isset($_POST['Username']) && isset($_POST['Password'])) {
    $servername = "mysql.cs.nott.ac.uk";
    $username = "psxjw13_C1B";
    $password = "AUXYUG";
    $dbname = "psxjw13_C1B";
    $conn = mysqli_connect($servername, $username, $password,
    $dbname);
    if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL:".mysqli_connect_error();
    die();
    }
    else
    {
    $sql = "SELECT * FROM Login_Details;";
    $result = mysqli_query($conn, $sql);
    }
    while($row = mysqli_fetch_assoc($result)) {
        if($row["Username"]==$_POST['Username'] && $row['password']==$_POST['Password']){
            $_SESSION['user'] = $_POST['Username'];
            if ($row['Admin']==1){
                $_SESSION['admin'] = 'Admin';
            } else {
                $_SESSION['admin'] = '';
            }
            header("Location: http://mersey.cs.nott.ac.uk/~psxjw13/MainPage.php");
            exit;    
        } else {
            ?>
            <script type="text/javascript">
                wrongPass();
            </script>
            <?php
        }
    }
    mysqli_close($conn);
}
?>


<script type="text/javascript">
var a = <?php echo json_encode($result); ?>;
</script>


