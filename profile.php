<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

$address = $fetch_profile['address'] ?? 'N/A';
$student_number = $fetch_profile['student_number'] ?? 'N/A';
$batch_number = $fetch_profile['batch_number'] ?? 'N/A';
$dob = $fetch_profile['dob'] ?? 'N/A';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="profile">

   <h1 class="heading">profile details</h1>

   <div class="details">

      <div class="user">
         <img src="teacher/uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= htmlspecialchars($fetch_profile['fname'] . ' ' . $fetch_profile['mname'] . ' ' . $fetch_profile['lname']); ?></h3>

         <p>student</p>
         <h3>Student No.: <span><?= $student_number; ?></span></h3>
         <h3>Batch No.: <span><?= $batch_number; ?></span></h3>
         <h3>Adress: <span><?= $address; ?></span></h3>
         <h3>Date of Birth: <span><?= $dob; ?></span></h3>

        <a href="update.php" class="inline-btn">Update Information</a>
      </div>

      <div class="box-container">

         <div class="box">
            <div class="flex">
               <i class="fas fa-bookmark"></i>
               <div>
                  <h3><?= $total_bookmarked; ?></h3>
                  <span>saved playlists</span>
               </div>
            </div>
            <a href="#" class="inline-btn">view playlists</a>
         </div>

         <div class="box">
            <div class="flex">
               <i class="fas fa-heart"></i>
               <div>
                  <h3><?= $total_likes; ?></h3>
                  <span>liked tutorials</span>
               </div>
            </div>
            <a href="#" class="inline-btn">view liked</a>
         </div>

         <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <h3><?= $total_comments; ?></h3>
                  <span>video comments</span>
               </div>
            </div>
            <a href="#" class="inline-btn">view comments</a>
         </div>

      </div>

   </div>

</section>

<!-- profile section ends -->












<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>