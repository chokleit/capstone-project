<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}

$year = date("Y"); // Current year

// Fetch the last batch number for the current year
$query = $conn->prepare("SELECT batch_number FROM `batch` WHERE batch_number LIKE ? ORDER BY id DESC LIMIT 1");
$query->execute(["$year-%"]);
$last_batch_number = $query->fetchColumn();

if ($last_batch_number) {
    // Extract the numeric part after the hyphen
    $last_increment = (int)substr($last_batch_number, strrpos($last_batch_number, '-') + 1);
    // Increment and format with leading zeros
    $new_increment = str_pad($last_increment + 1, 2, '0', STR_PAD_LEFT);
} else {
    // Start with 01 if no entries exist for the current year
    $new_increment = "01";
}

// Combine parts to create the batch number
$batch_number = "$year-$new_increment";

if (isset($_POST['submit'])) {
    $id = unique_id();
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $course = $_POST['course'];
    $course = filter_var($course, FILTER_SANITIZE_STRING);

    $start = $_POST['start'];
    $start = filter_var($start, FILTER_SANITIZE_STRING);

    $end = $_POST['end'];
    $end = filter_var($end, FILTER_SANITIZE_STRING);

    try {
        // Insert data into the `batch` table
        $add_batch = $conn->prepare("INSERT INTO `batch` (id, batch_number, title, start, end, tutor_id, course) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $add_batch->execute([$id, $batch_number, $title, $start, $end, $tutor_id, $course]);
        $message[] = 'Batch successfully created!';
    } catch (PDOException $e) {
        $message[] = 'Error: ' . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Course</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">create batch</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Batch Number</p>
      <input type="text" name="batch_number" value="<?= $batch_number; ?>" readonly class="box">

      <p>Batch Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter batch title" class="box">
     
      <p>Course <span>*</span></p>
      <select name="course" class="box" required>
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
      <p>Start <span>*</span></p>
      <input type="date" name="start" maxlength="100" required placeholder="enter start date" class="box">
      <p>End <span>*</span></p>
      <input type="date" name="end" maxlength="100" required placeholder="enter start date" class="box">
      <p>course thumbnail <span>*</span></p>
      <input type="submit" value="create batch" name="submit" class="btn">
   </form>

</section>








<script src="../js/admin_script.js"></script>

</body>
</html>