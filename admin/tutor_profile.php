<?php

include '../components/connect.php';

if(isset($_GET['tutor_id'])){
   $tutor_id = $_GET['tutor_id'];
}else{
   $tutor_id = '';
}

if(isset($_POST['tutor_fetch']) && $tutor_id){


   $select_tutor = $conn->prepare('SELECT * FROM `tutors` WHERE id = ?');
   $select_tutor->execute([$tutor_id]);

   $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
   $tutor_id = $fetch_tutor['id'];

   $count_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
   $count_playlists->execute([$tutor_id]);
   $total_playlists = $count_playlists->rowCount();

   $count_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
   $count_contents->execute([$tutor_id]);
   $total_contents = $count_contents->rowCount();

   $count_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
   $count_likes->execute([$tutor_id]);
   $total_likes = $count_likes->rowCount();

   $count_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
   $count_comments->execute([$tutor_id]);
   $total_comments = $count_comments->rowCount();

}else{
   header('location:teachers.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tutor's profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- teachers profile section starts  -->

<section class="tutor-profile">

   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
         <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
         <h3><?= $fetch_tutor['fname'] . " " . $fetch_tutor['mname'] . " " . $fetch_tutor['lname']; ?></h3>
         <span><?= $fetch_tutor['profession']; ?></span>
      </div>
      <div class="flex">
         <p>total playlists : <span><?= $total_playlists; ?></span></p>
         <p>total videos : <span><?= $total_contents; ?></span></p>
         <p>total likes : <span><?= $total_likes; ?></span></p>
         <p>total comments : <span><?= $total_comments; ?></span></p>
      </div>
   </div>

</section>

<!-- teachers profile section ends -->

<section class="courses">
   <h1 class="heading">Latest Courses</h1>
   <div class="box-container">
      <?php
      $select_courses = $conn->prepare("SELECT course_id, title, thumb, date FROM `playlist` WHERE tutor_id = ? AND status = ?");
      $select_courses->execute([$fetch_tutor['id'], 'active']);
      if ($select_courses->rowCount() > 0):
         while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)):
      ?>
      <div class="box">

         <img src="uploaded_files/<?= htmlspecialchars($fetch_course['thumb']); ?>" class="thumb" alt="Course Thumbnail">
         <h3 class="title"><?= htmlspecialchars($fetch_course['title']); ?></h3>
         <a href="playlist.php?get_id=<?= htmlspecialchars($fetch_course['course_id']); ?>" class="inline-btn">View Playlist</a>
      </div>
      <?php
         endwhile;
      else:
         echo '<p class="empty">No courses added yet!</p>';
      endif;
      ?>
   </div>
</section>

<!-- courses section ends -->




<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>