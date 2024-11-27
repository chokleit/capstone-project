<?php

include '../components/connect.php';

// Check if the tutor is logged in
if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
   exit;
}

// Check if the message ID is provided
if(isset($_GET['id'])) {
   $message_id = $_GET['id'];

   // Prepare the DELETE query
   $delete_message = $conn->prepare("DELETE FROM `contact` WHERE id = ?");
   $delete_message->execute([$message_id]);

   // Redirect back to the messages page after deletion
   header('location:messages.php');
   exit;
} else {
   // If no ID is passed, redirect back to the messages page
   header('location:messages.php');
   exit;
}

?>
