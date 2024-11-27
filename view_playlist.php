<?php
include 'components/connect.php';

// Check if the user is logged in
if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

// Ensure student_number is available
if (isset($_COOKIE['student_number'])) {
   $student_number = $_COOKIE['student_number'];
} else {
   $student_number = ''; 
   header('location:login.php'); // Redirect if no student_number is set
}

// Get playlist ID from the URL
if (isset($_GET['get_id'])) {
   $playlist_id = $_GET['get_id'];
} else {
   $playlist_id = ''; // Handle the case where get_id is not set
   header('location:playlist.php'); // Redirect to playlists if get_id is missing
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Course Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="playlist-details">

   <h1 class="heading">Course Details</h1>

   <?php
      // Fetch playlist details
      $select_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE course_id = ?");
      $select_playlist->execute([$playlist_id]);

      if ($select_playlist->rowCount() > 0) {
         while ($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)) {
            $playlist_id = $fetch_playlist['id']; 
            $count_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
            $count_videos->execute([$playlist_id]);
            $total_videos = $count_videos->rowCount();
   ?>
   <div class="row">
      <div class="thumb">
         <span><?= $total_videos; ?></span>
         <img src="../uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
      </div>
      <div class="details">
         <h3 class="title"><?= $fetch_playlist['title']; ?></h3>
         <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
         <div class="description"><?= $fetch_playlist['description']; ?></div>
      </div>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">no course found!</p>';
      }
   ?>

</section>

<section class="contents">

   <h1 class="heading">Course Lessons</h1>

   <div class="box-container">
      <?php
         // Fetch the content (videos) for this playlist
         $select_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
         $select_videos->execute([$playlist_id]);

         if ($select_videos->rowCount() > 0) {
            while ($fetch_videos = $select_videos->fetch(PDO::FETCH_ASSOC)) { 
               $video_id = $fetch_videos['id'];
      ?>
      <div class="box">
         <img src="../uploaded_files/<?= $fetch_videos['thumb']; ?>" class="thumb" alt="">
         <h3 class="title"><?= $fetch_videos['title']; ?></h3>
         <a href="view_content.php?get_id=<?= $video_id; ?>" class="btn">View Content</a>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No videos added yet!</p>';
         }
      ?>
   </div>

</section>

</body>
</html>
