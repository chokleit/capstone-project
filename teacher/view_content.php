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

// Handle grading submission
if (isset($_POST['grade_submission'])) {
    $submission_id = $_POST['submission_id'];
    $grade = $_POST['grade'];

    $update_grade = $conn->prepare("UPDATE student_progress SET submission_status = ? WHERE id = ?");
    $update_grade->execute([$grade, $submission_id]);

    $message[] = 'Grade updated successfully!';
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
        .submissions-table {
            width: 100%;
            border-collapse: collapse;
        }
        .submissions-table th, .submissions-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
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
                ?>
            </div>

            <!-- Student Submissions Section -->
            <div class="box">
                <br>
                <br>
                <h3 class="titlee">Submitted Activities</h3>
                <?php
                $select_submissions = $conn->prepare("SELECT sp.*, s.fname AS fname 
                                                      FROM student_progress sp 
                                                      JOIN users s ON sp.student_id = s.id 
                                                      WHERE sp.lesson_id = ?");
                $select_submissions->execute([$get_id]);

                if ($select_submissions->rowCount() > 0) {
                    ?>
                    <table class="submissions-table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Submitted File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($submission = $select_submissions->fetch(PDO::FETCH_ASSOC)) {
                                $submission_id = $submission['id'];
                                $student_name = $submission['student_name'];
                                $file = $submission['uploaded_file'];
                                $status = $submission['submission_status'];
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($student_name); ?></td>
                                    <td>
                                        <a href="../uploaded_files/student_uploads/<?= htmlspecialchars($file); ?>" download>
                                            <?= htmlspecialchars($file); ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars(ucfirst($status)); ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="submission_id" value="<?= $submission_id; ?>">
                                            <select name="grade" required>
                                                <option value="pending" <?= $status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="passed" <?= $status == 'passed' ? 'selected' : ''; ?>>Passed</option>
                                                <option value="failed" <?= $status == 'failed' ? 'selected' : ''; ?>>Failed</option>
                                            </select>
                                            <button type="submit" name="grade_submission" class="btn">Update</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo '<p class="empty">No submissions found!</p>';
                }
                ?>
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
