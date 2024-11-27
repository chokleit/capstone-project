<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
    exit;
}

// Get batch ID to update
if (isset($_GET['get_id'])) {
    $batch_id = $_GET['get_id'];
    $batch_id = filter_var($batch_id, FILTER_SANITIZE_STRING);
} else {
    header('location:batch.php');
    exit;
}

// Fetch batch details to pre-fill the form
$query = $conn->prepare("SELECT * FROM `batch` WHERE id = ? AND tutor_id = ?");
$query->execute([$batch_id, $tutor_id]);
if ($query->rowCount() > 0) {
    $batch = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header('location:batch.php');
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $course = $_POST['course'];
    $course = filter_var($course, FILTER_SANITIZE_STRING);

    $start = $_POST['start'];
    $start = filter_var($start, FILTER_SANITIZE_STRING);

    $end = $_POST['end'];
    $end = filter_var($end, FILTER_SANITIZE_STRING);

    try {
        // Update the specific batch
        $update_batch = $conn->prepare("
            UPDATE `batch` 
            SET title = ?, start = ?, end = ?, course = ? 
            WHERE id = ? AND tutor_id = ?
        ");
        $update_batch->execute([$title, $start, $end, $course, $batch_id, $tutor_id]);

        if ($update_batch->rowCount() > 0) {
            $message[] = 'Batch updated successfully!';
        } else {
            $message[] = 'No changes made or batch not found.';
        }
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
    <title>Update Batch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="playlist-form">

    <h1 class="heading">Update Batch</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <p>Batch Number</p>
        <input type="text" name="batch_number" value="<?= htmlspecialchars($batch['batch_number']); ?>" readonly class="box">

        <p>Batch Title <span>*</span></p>
        <input type="text" name="title" maxlength="100" required placeholder="Enter batch title" 
               value="<?= htmlspecialchars($batch['title']); ?>" class="box">

        <p>Course <span>*</span></p>
        <select name="course" class="box" required>
            <option value="" disabled>--Select Course--</option>
            <?php
            $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
            $select_courses->execute([$tutor_id]);

            if ($select_courses->rowCount() > 0) {
                while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?= $fetch_course['id']; ?>" 
                <?= $fetch_course['id'] == $batch['course'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($fetch_course['title']); ?>
            </option>
            <?php
                }
            } else {
                echo '<option value="" disabled>No courses available</option>';
            }
            ?>
        </select>

        <p>Start Date <span>*</span></p>
        <input type="date" name="start" required value="<?= $batch['start']; ?>" class="box">

        <p>End Date <span>*</span></p>
        <input type="date" name="end" required value="<?= $batch['end']; ?>" class="box">

        <input type="submit" value="Update Batch" name="submit" class="btn">
    </form>

</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
