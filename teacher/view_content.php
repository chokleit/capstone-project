<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:view_playlist.php');
}

// Handle activity file download
if (isset($_GET['download_activity'])) {
    $file_path = '../uploaded_files/' . $_GET['download_activity'];
    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        $message[] = 'File not found!';
    }
}

// Handle student activity upload
if (isset($_POST['submit_activity'])) {
    $content_id = $_POST['content_id'];
    $student_id = $_COOKIE['student_id']; // Assuming student ID is stored in a cookie
    $uploaded_file = $_FILES['student_activity']['name'];
    $uploaded_file = filter_var($uploaded_file, FILTER_SANITIZE_STRING);
    $file_ext = pathinfo($uploaded_file, PATHINFO_EXTENSION);
    $rename_file = unique_id() . '.' . $file_ext;
    $file_tmp_name = $_FILES['student_activity']['tmp_name'];
    $file_folder = '../uploaded_files/student_uploads/' . $rename_file;

    if ($file_ext != 'pdf') {
        $message[] = 'Invalid file type! Only PDFs are allowed.';
    } else {
        move_uploaded_file($file_tmp_name, $file_folder);

        // Insert activity submission record into the database
        $check_progress = $conn->prepare("SELECT * FROM student_progress WHERE student_id = ? AND lesson_id = ?");
        $check_progress->execute([$student_id, $content_id]);

        if ($check_progress->rowCount() > 0) {
            $update_progress = $conn->prepare("UPDATE student_progress SET activity_completed = 1 WHERE student_id = ? AND lesson_id = ?");
            $update_progress->execute([$student_id, $content_id]);
        } else {
            $insert_progress = $conn->prepare("INSERT INTO student_progress (student_id, lesson_id, activity_completed) VALUES (?, ?, 1)");
            $insert_progress->execute([$student_id, $content_id]);
        }

        $message[] = 'Activity submitted successfully!';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Content</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .pdf-viewer {
            width: 100%;
            height: 500px;
            border: none;
        }
    </style>
</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="view-content">
    <?php
    $select_content = $conn->prepare("SELECT * FROM `content` WHERE id = ? AND tutor_id = ?");
    $select_content->execute([$get_id, $tutor_id]);

    if ($select_content->rowCount() > 0) {
        $fetch_content = $select_content->fetch(PDO::FETCH_ASSOC);

        $title = $fetch_content['title'];
        $description = $fetch_content['description'];
        $pdf = $fetch_content['pdf'];
        $activity = $fetch_content['activity'];
        ?>

        <div class="container">
            <div class="box">
               
                <h3 class="titlee"><?= htmlspecialchars($title); ?></h3>
                <p class="title"><?= htmlspecialchars($description); ?></p>

                <?php
                // Display PDF if it exists
                $pdf_file_path = "../uploaded_files/" . $pdf;
                if (!empty($pdf) && file_exists($pdf_file_path)) {
                    ?>
                    <iframe src="<?= htmlspecialchars($pdf_file_path); ?>" class="pdf-viewer" frameborder="0" allowfullscreen></iframe>
                    <?php
                } else {
                    echo '<p class="error">PDF file not found.</p>';
                }

                // Activity Download
                if (!empty($activity)) {
                    ?>
                    <p class="titleact">Download Activity:</p>
                    <a href="view_content.php?download_activity=<?= htmlspecialchars($activity); ?>" class="btn">Download Activity</a>
                    <?php
                }
                ?>
            </div>

            <div class="box">
                <p class="titleact">Submit Your Activity</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="content_id" value="<?= $get_id; ?>">
                    <p class="title">Upload Your Completed Activity (PDF Only)</p>
                    <input type="file" name="student_activity" accept="application/pdf" required class="box" class="pdfup">
            </div>
            <div class="box">
                    <input type="submit" name="submit_activity" value="Submit Activity" class="inline-btn">
                </form>
                <form action="" method="post">
                <input type="hidden" name="lesson_id" value="<?= $get_id; ?>" class="inline-btn">
                <input type="submit" name="complete_lesson" value="Mark Lesson as Completed" class="inline-btn">
                </form>
            </div> 
            </div>


        <?php
    } else {
        echo '<p class="empty">No content found!</p>';
    }
    ?>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
