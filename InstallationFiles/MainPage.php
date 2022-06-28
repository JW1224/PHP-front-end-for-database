<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: http://mersey.cs.nott.ac.uk/~psxjw13/Login.php");
}
?>
<html>
<head>

<?php
echo 'Current User: '.$_SESSION['user'].'</br>';
?>
<button id="Change User" class="float-left submit-button" >Change User</button>

<button id="logout" class="float-left submit-button" >Logout</button>
<script type="text/javascript">
    document.getElementById("logout").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/logout.php";
    };
</script>

<link rel="stylesheet" href="myStyle.css"/>

<title>Main Page</title>
</head>

<body>
<?php
//http://mersey.cs.nott.ac.uk/~psxjw13/MainPage.php
?>

<h1>Main Page</h1>
<p>This is the main page.</p>

<button id="changePass" class="float-left submit-button" >Change Password</button>
<button id="People Lookup" class="float-left submit-button" >Lookup People</button>
<button id="Vehicle Lookup" class="float-left submit-button" >Lookup Vehicle</button>
<button id="Person Entry" class="float-left submit-button" >Add New Person</button>
<button id="Table View" class="float-left submit-button" >Table Viewer</button>

<?php
if ($_SESSION['admin']=='Admin') {
    ?>
    <button id="New Account" class="float-left submit-button" >Add New Police Account</button>
    <button id="New Fine" class="float-left submit-button" >Add New Fine</button>
    <?php
}
?>
<!--<button id="Vehicle Entry" class="float-left submit-button" >New Vehicle Entry</button>-->

<script type="text/javascript">
    document.getElementById("changePass").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/ChangePassword.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("People Lookup").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/PeopleLookup.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("Vehicle Lookup").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/VehicleLookup.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("Vehicle Entry").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/VehicleEntry.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("Person Entry").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/PersonEntry.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("New Account").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/NewPoliceAccount.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("New Fine").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/NewFine.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("Change User").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/Login.php";
    };
</script>
<script type="text/javascript">
    document.getElementById("Table View").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/tableViewer.php";
    };
</script>


</body>
</html>