<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

// Fetch all messages from the contact table
$select_messages = $conn->prepare("SELECT * FROM `contact` ORDER BY id DESC");
$select_messages->execute();
$messages = $select_messages->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Messages</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      .show-comments {
         margin-bottom: 20px;
      }

      .comments {
         margin-bottom: 50px;
      }

      .box {
         background-color: #fff;
         padding: 20px;
         margin-bottom: 20px;
         border: 1px solid #ddd;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .content {
         margin-bottom: 15px; /* Adds space between each content section */
      }

      .message-actions {
         text-align: right;
      }

      .inline-delete-btn {
         background-color: red;
         color: white;
         padding: 8px 15px;
         text-decoration: none;
         border-radius: 5px;
      }

      .inline-delete-btn:hover {
         background-color: darkred;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="comments">
   <h1 class="heading">User Messages</h1>

   <div class="show-comments">
      <?php if (count($messages) > 0): ?>
         <?php foreach ($messages as $message): ?>
            <div class="box">
               <div class="content">
                  <p><strong>Name:</strong> <?= htmlspecialchars($message['name']); ?></p>
                  <p><strong>Email:</strong> <?= htmlspecialchars($message['email']); ?></p>
                  <p><strong>Number:</strong> <?= htmlspecialchars($message['number']); ?></p>
               </div>
               <div class="content">
                  <p><strong>Message:</strong> <?= htmlspecialchars($message['message']); ?></p>
               </div>
               <div class="message-actions">
                  <a href="delete_message.php?id=<?= $message['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');" class="inline-delete-btn">Delete</a>
               </div>
            </div>
         <?php endforeach; ?>
      <?php else: ?>
         <p class="empty">No messages found!</p>
      <?php endif; ?>
   </div>

</section>

<!-- custom js file link -->
<script src="../js/script.js"></script>
   
</body>
</html>
