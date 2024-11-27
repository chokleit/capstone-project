<?php
include '../components/connect.php';

if(isset($_GET['id'])) {
   $student_id = $_GET['id'];
   $delete_query = $conn->prepare("DELETE FROM users WHERE id = ?");
   $delete_query->execute([$student_id]);
}

header('location:studentrecords.php');
?>
