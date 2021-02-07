<?php
$timeout = 30; // Set timeout minutes
if(isset($_SESSION['isAdmin'])){
    $logout_redirect_url = "../login.html"; // Set logout URL
}else{
    $logout_redirect_url = "../login-anggota.php";
}

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>