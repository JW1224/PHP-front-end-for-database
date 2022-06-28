<?php
session_start();
session_unset();
session_destroy();
echo 'Logged Out';
?>
<link rel="stylesheet" href="myStyle.css"/>
<br>
<button id="login" class="float-left submit-button" >Login</button>
<script type="text/javascript">
    document.getElementById("login").onclick = function () {
        location.href = "http://mersey.cs.nott.ac.uk/~psxjw13/Login.php";
    };
</script>
