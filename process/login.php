<?php
//Include database connection
require("../config/db.php");

//Include class StudentLogin
require("../classes/StudentLogin.php");

if(isset($_POST['submit'])) {
    $code = $_POST['code'];

    $loginStud = new StudentLogin();
    $rtnLogin = $loginStud->StudLogin($code);
}

$db->close();
