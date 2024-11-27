<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}


if(isset($_POST['delete_video'])){
   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $verify_video = $conn->prepare("SELECT * FROM `sublesson` WHERE id = ? LIMIT 1");
   $verify_video->execute([$delete_id]);
   if($verify_video->rowCount() > 0){
      $delete_video_thumb = $conn->prepare("SELECT * FROM `sublesson` WHERE id = ? LIMIT 1");
      $delete_video_thumb->execute([$delete_id]);
      $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
      unlink('../uploaded_files/'.$fetch_thumb['thumb']);
      $delete_video = $conn->prepare("SELECT * FROM `sublesson` WHERE id = ? LIMIT 1");
      $delete_video->execute([$delete_id]);
      $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
      unlink('../uploaded_files/'.$fetch_video['pdf']);
   }else{
      $message[] = 'video already deleted!';
   }
// Debugging $_FILES
echo '<pre>';
print_r($_FILES['pdf']);
echo '</pre>';

// Check file extension
$pdf_ext = pathinfo($pdf, PATHINFO_EXTENSION);
echo 'PDF Extension: ' . $pdf_ext . '<br>';

// Check MIME type
echo 'MIME Type: ' . $_FILES['pdf']['type'] . '<br>';

// Check file size
echo 'PDF File Size: ' . $_FILES['pdf']['size'] . '<br>';

// Temporary file existence
if (!file_exists($pdf_tmp_name)) {
    echo 'Temporary file does not exist: ' . $pdf_tmp_name;
    exit;
}

// Check destination folder
if (!is_dir('../uploaded_files/')) {
    echo 'Upload folder does not exist.';
    exit;
}
if (!is_writable('../uploaded_files/')) {
    echo 'Upload folder is not writable.';
    exit;
}

// Attempt to move file
if (move_uploaded_file($pdf_tmp_name, $pdf_folder)) {
    echo 'PDF uploaded successfully to ' . $pdf_folder;
} else {
    echo 'Failed to move uploaded file. Error: ';
    var_dump(error_get_last());
    exit;
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
   
<section class="contents">

   <h1 class="heading">Lesson Overview</h1>
   <div class="box-container">

   <div class="box" style="text-align: center;">
      <a href="../teacher/contents.php" class="btn">Back to Lessons</a>
      <a href="add_sublesson.php" class="btn">add content</a>
   </div>

   <?php
   if (isset($_GET['get_id'])) {
       $lesson_id = $_GET['get_id'];
   } else {
       $lesson_id = '';
       header('location:dashboard.php');
   }

   $select_videos = $conn->prepare("SELECT * FROM `sublesson` WHERE tutor_id = ? AND lesson_id = ? ORDER BY content_number ASC");
   $select_videos->execute([$tutor_id, $lesson_id]);
   if ($select_videos->rowCount() > 0) {
      while ($fecth_videos = $select_videos->fetch(PDO::FETCH_ASSOC)) { 
         $video_id = $fecth_videos['id'];
?>
      <div class="box">
    <img src="../uploaded_files/<?= $fecth_videos['thumb']; ?>" class="thumb" alt="">
    <h3 class="title"><?= $fecth_videos['title']; ?></h3>

    <?php
    // Get the PDF file path and check if it exists
    $pdf_file_path = '../uploaded_files/' . $fecth_videos['pdf']; // Assuming 'pdf' is the column name for the PDF file
   
    ?>

    <form action="" method="post" class="flex-btn">
        <input type="hidden" name="video_id" value="<?= $video_id; ?>">
        <a href="update_sublesson.php?get_id=<?= $fecth_videos['id']; ?>" class="option-btn">update</a>
        <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_video">
    </form>
    <a href="view_content.php?get_id=<?= $video_id; ?>" class="btn">view lesson</a>
</div>

<?php
      }
   } else {
      echo '<p class="empty">no contents added yet!</p>';
   }
?>


   </div>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>