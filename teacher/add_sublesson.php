<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content_number = $_POST['content_number'];
   $content_number = filter_var($content_number, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $lesson = $_POST['lesson'];
   $lesson = filter_var($lesson, FILTER_SANITIZE_STRING);

   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;

   $pdf = $_FILES['pdf']['name'];
   if($pdf) {
      $pdf_ext = pathinfo($pdf, PATHINFO_EXTENSION);
      $rename_pdf = unique_id().'.'.$pdf_ext;
      $pdf_tmp_name = $_FILES['pdf']['tmp_name'];
      $pdf_folder = '../uploaded_files/'.$rename_pdf;

      // Check if it's a PDF
      if($pdf_ext != 'pdf'){
         $message[] = 'Invalid file type for PDF!';
      } else {
         move_uploaded_file($pdf_tmp_name, $pdf_folder);
      }
   }  
   
   if($thumb_size > 2000000){
      $message[] = 'Image size is too large!';
   } else {
         $add_playlist = $conn->prepare("INSERT INTO `sublesson`(id, lesson_id, tutor_id, content_number, thumb, title, description, pdf) VALUES(?,?,?,?,?,?,?,?)");
         $add_playlist->execute([$id, $lesson, $tutor_id, $content_number, $rename_thumb, $title, $description, $rename_pdf]);
         
         // Move files
         move_uploaded_file($thumb_tmp_name, $thumb_folder);
         move_uploaded_file($pdf_tmp_name, $pdf_folder);

         $message[] = 'New content uploaded with PDF!';
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>
   
<section class="video-form">

   <h1 class="heading">upload lesson content</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Content Number: <span>*</span></p>
      <input type="text" name="content_number" maxlength="100" required placeholder="enter content number" class="box">
      <p>Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter video title" class="box">
      <p>Description <span>*</span></p>
      <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
      <p>Choose Lesson <span>*</span></p>
      <select name="lesson" class="box" required>
         <option value="" disabled selected>--select lesson</option>
         <?php
         $select_playlists = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
         $select_playlists->execute([$tutor_id]);
         if($select_playlists->rowCount() > 0){
            while($fetch_playlist = $select_playlists->fetch(PDO::FETCH_ASSOC)){
         ?>
         <option value="<?= $fetch_playlist['id']; ?>"><?= $fetch_playlist['title']; ?></option>
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled>no playlist created yet!</option>';
         }
         ?>
      </select>
      <p>select thumbnail <span>*</span></p>
      <input type="file" name="thumb" accept="image/*" required class="box">
      <p>Select PDF Document</p>
      <input type="file" name="pdf" accept="application/pdf" class="box" required>

      <input type="submit" value="upload video" name="submit" class="btn">
   </form>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>