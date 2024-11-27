<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}

// Generate a unique course_id before displaying the form
$course_id = 'CRS-' . strtoupper(substr($tutor_id, 0, 3)) . '-' . uniqid(); // Create a unique course ID

if (isset($_POST['submit'])) {
    $id = unique_id(); // Generate a unique ID for the primary key

    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    // Save course information including the course_id
    $add_playlist = $conn->prepare("INSERT INTO `playlist`(id, course_id, tutor_id, title, description, thumb, status) VALUES(?,?,?,?,?,?,?)");
    $add_playlist->execute([$id, $course_id, $tutor_id, $title, $description, $rename, $status]);

    // Move the uploaded file to the specified folder
    move_uploaded_file($image_tmp_name, $image_folder);

    $message[] = 'New course created! Course ID: ' . $course_id; // Notify with the new course ID
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

    <h1 class="heading">Create Course</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <p>Course ID <span>*</span></p>
        <input type="text" name="course_id" value="<?= $course_id; ?>" readonly class="box">
        <p>Course Status <span>*</span></p>
        <select name="status" class="box" required>
            <option value="" selected disabled>-- Select Status --</option>
            <option value="active">Active</option>
            <option value="deactive">Deactive</option>
        </select>
        <p>Course Title <span>*</span></p>
        <input type="text" name="title" maxlength="100" required placeholder="Enter playlist title" class="box">
        <p>Course Description <span>*</span></p>
        <textarea name="description" class="box" required placeholder="Write description" maxlength="1000" cols="30" rows="10"></textarea>
        <p>Course Thumbnail <span>*</span></p>
        <input type="file" name="image" accept="image/*" required class="box">
        <input type="submit" value="Create Playlist" name="submit" class="btn">
    </form>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
