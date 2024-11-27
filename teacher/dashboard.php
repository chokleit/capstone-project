<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

$select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

$select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
$select_playlists->execute([$tutor_id]);
$total_playlists = $select_playlists->rowCount();

$select_user = $conn->prepare("SELECT * FROM `users`");
$select_user->execute();
$total_users = $select_user->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- Font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom css file link -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
       /* Custom styles for centering and description */
       .welcome-section {
           text-align: center;
           margin: 50px 0;
       }

       .welcome-section h1 {
           font-size: 2rem;
           margin-bottom: 10px;
       }

       .welcome-section p {
           font-size: 1.1rem;
           color: #555;
           max-width: 800px;
           margin: 0 auto;
       }
   </style>
</head>
<body>

<?php include '../components/teacher_header.php'; ?>
   
<section class="dashboard">

   <h1 class="heading">Dashboard</h1>

   <!-- Welcome Section Starts -->
   <section class="welcome-section">
       <h1>Welcome, <p><?= $fetch_profile['fname']; ?></p></h1>
       <p>Welcome to your dashboard where you can manage activities, courses, student progress, and more. Here, you can easily navigate through your tasks and monitor the progress of your students. Explore the options below to get started!</p>
   </section>
   <!-- Welcome Section Ends -->

   <div class="box-container">

      <div class="box">
         <h3><?= $total_contents; ?></h3>
         <p>Total Activities</p>
         <a href="add_content.php" class="btn">View Content</a>
      </div>

      <div class="box">
         <h3><?= $total_playlists; ?></h3>
         <p>Total Courses</p>
         <a href="playlists.php" class="btn">View Course</a>
      </div>

      <div class="box">
         <h3><?= $total_users; ?></h3>
         <p>Total of Students</p>
         <a href="students.php" class="btn">View Students</a>
      </div>

      <div class="box">
         <h3><?= $total_comments; ?></h3>
         <p>To Review</p>
         <a href="comments.php" class="btn">View Activities</a>
      </div>

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
