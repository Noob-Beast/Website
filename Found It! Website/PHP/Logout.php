<?php
session_start();
session_destroy();
echo "<script>alert('You have been successfully logged out.');</script>";
echo "<script>window.location.href = '../HTML/Homepage.html';</script>";
exit;
?>
