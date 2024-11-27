<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
    exit;
}

$year = date("Y"); // Current year

// Fetch the last batch number for the current year
$query = $conn->prepare("SELECT batch_number FROM `batch` WHERE batch_number LIKE ? ORDER BY id DESC LIMIT 1");
$query->execute(["$year-%"]);
$last_batch_number = $query->fetchColumn();

if ($last_batch_number) {
    $last_increment = (int)substr($last_batch_number, strrpos($last_batch_number, '-') + 1);
    $new_increment = str_pad($last_increment + 1, 2, '0', STR_PAD_LEFT);
} else {
    $new_increment = "01";
}

$batch_number = "$year-$new_increment";

if (isset($_POST['submit'])) {
    $id = unique_id(); // Generate a unique ID for the batch
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $course_id = filter_var($_POST['course'], FILTER_SANITIZE_STRING); // Use the directly submitted course ID
    $teacher_id = filter_var($_POST['teacher'], FILTER_SANITIZE_STRING);
    $start = filter_var($_POST['start'], FILTER_SANITIZE_STRING);
    $end = filter_var($_POST['end'], FILTER_SANITIZE_STRING);

    try {
        // Insert data into the `batch` table
        $add_batch = $conn->prepare("INSERT INTO `batch` (id, batch_number, title, start, end, tutor_id, course_id) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $add_batch->execute([$id, $batch_number, $title, $start, $end, $teacher_id, $course_id]);
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
   <title>Add Batch</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="playlist-form">

   <h1 class="heading">Create Batch</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Batch Number</p>
      <input type="text" name="batch_number" value="<?= $batch_number; ?>" readonly class="box">

      <p>Batch Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Enter batch title" class="box">

      <p>Course <span>*</span></p>
      <select name="course" class="box" required>
         <option value="" disabled selected>--Select Course--</option>
         <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
         $select_courses->execute([$tutor_id]);
         if ($select_courses->rowCount() > 0) {
            while ($course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $course['course_id'] . '">' . $course['title'] . '</option>';
            }
         } else {
            echo '<option value="" disabled>No courses available!</option>';
         }
         ?>
      </select>

      <p>Start Date <span>*</span></p>
      <input type="date" name="start" required class="box">

      <p>End Date <span>*</span></p>
      <input type="date" name="end" required class="box">

      <p>Teacher <span>*</span></p>
      <select name="teacher" class="box" required>
         <option value="" disabled selected>--Select Teacher--</option>
         <?php
         $select_teachers = $conn->prepare("SELECT * FROM `tutors`");
         $select_teachers->execute();
         if ($select_teachers->rowCount() > 0) {
            while ($teacher = $select_teachers->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $teacher['id'] . '">' . $teacher['fname'] . ' ' . $teacher['lname'] . '</option>';
            }
         } else {
            echo '<option value="" disabled>No teachers found!</option>';
         }
         ?>
      </select>

      <input type="submit" value="Create Batch" name="submit" class="btn">
   </form>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
