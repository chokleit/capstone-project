<?php

include '../components/connect.php';

$selected_playlist = isset($_GET['playlist_id']) ? $_GET['playlist_id'] : '';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}

// Handle form submission
if (isset($_POST['submit'])) {

    $id = unique_id();
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $playlist = $_POST['playlist'];  // changed from $_POST['playlist_id'] to $_POST['playlist']
    $playlist = filter_var($playlist, FILTER_SANITIZE_STRING);

    // Handle thumbnail
    $thumb = $_FILES['thumb']['name'];
    $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
    $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
    $rename_thumb = unique_id() . '.' . $thumb_ext;
    $thumb_size = $_FILES['thumb']['size'];
    $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
    $thumb_folder = '../uploaded_files/' . $rename_thumb;

    // Handle PDF
    $pdf = $_FILES['pdf']['name'];
    $rename_pdf = '';
    if ($pdf) {
        $pdf = filter_var($pdf, FILTER_SANITIZE_STRING);
        $pdf_ext = pathinfo($pdf, PATHINFO_EXTENSION);
        $rename_pdf = unique_id() . '.' . $pdf_ext;
        $pdf_tmp_name = $_FILES['pdf']['tmp_name'];
        $pdf_folder = '../uploaded_files/' . $rename_pdf;

        if ($pdf_ext != 'pdf') {
            $message[] = 'Invalid file type for PDF!';
        } else {
            move_uploaded_file($pdf_tmp_name, $pdf_folder);
        }
    }

    // Handle Activity
    $activity = $_FILES['activity']['name'];
    $rename_act = '';
    if ($activity) {
        $activity = filter_var($activity, FILTER_SANITIZE_STRING);
        $activity_ext = pathinfo($activity, PATHINFO_EXTENSION);
        $rename_act = unique_id() . '.' . $activity_ext;
        $act_tmp_name = $_FILES['activity']['tmp_name'];
        $act_folder = '../uploaded_files/' . $rename_act;

        if ($activity_ext != 'pdf') {
            $message[] = 'Invalid file type for Activity!';
        } else {
            move_uploaded_file($act_tmp_name, $act_folder);
        }
    }

    // Validate thumbnail size
    if ($thumb_size > 2000000) {
        $message[] = 'Image size is too large!';
    } else {
        // Insert content into the database
        $add_content = $conn->prepare("INSERT INTO `content`(id, tutor_id, playlist_id, title, description, thumb, pdf, activity) VALUES(?,?,?,?,?,?,?,?)");
        $add_content->execute([$id, $tutor_id, $playlist, $title, $description, $rename_thumb, $rename_pdf, $rename_act]);

        // Move the thumbnail file
        move_uploaded_file($thumb_tmp_name, $thumb_folder);

        $message[] = 'New Lesson Uploaded!';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Content</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="video-form">

   <h1 class="heading">Upload Lesson</h1>

   <form action="" method="post" enctype="multipart/form-data">

      <!-- Hidden playlist_id -->
      <p>Lesson Course <span>*</span></p>
      <select name="playlist" class="box" required>
         <option value="" disabled selected>--select course</option>
         <?php
         $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
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

      <p>Lesson Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Enter lesson title" class="box">

      <p>Description <span>*</span></p>
      <textarea name="description" class="box" required placeholder="Write description" maxlength="1000" cols="30" rows="10"></textarea>

      <p>Thumbnail <span>*</span></p>
      <input type="file" name="thumb" accept="image/*" required class="box">

      <p>PDF Document</p>
      <input type="file" name="pdf" accept="application/pdf" class="box">

      <p>Lesson Activity</p>
      <input type="file" name="activity" accept="application/pdf" class="box">

      <input type="submit" value="Upload Lesson" name="submit" class="btn">
   </form>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
