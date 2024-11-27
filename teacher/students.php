<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student List</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>
   

<section class="teachers">

   <h1 class="heading">Students</h1>
   <a href="register-student.php" class="add">Add Student</a>


   <form action="search_tutor.php" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container">


      <?php
         $select_tutors = $conn->prepare("SELECT * FROM `users`");
         $select_tutors->execute();
         if($select_tutors->rowCount() > 0){
            while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){

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
      ?>
      <div class="box">
         <div class="tutor">
            <img src="../teacher/uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
            <h3><?= htmlspecialchars($fetch_tutor['fname'] . ' ' . $fetch_tutor['mname'] . ' ' . $fetch_tutor['lname']); ?></h3>

               <span>student</span>
            </div>
         </div>
         
         <form  method="post">
            <input type="hidden" name="tutor_email" value="<?= $fetch_tutor['email']; ?>">
            <a href="student_profile.php?user_id=<?= $fetch_tutor['id']; ?>" class="inline-btn">View Profile</a>
            <input type="submit" value="archive" name="tutor_fetch" class="inline-btn">

         </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no tutors found!</p>';
         }
      ?>

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>