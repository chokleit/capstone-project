<?php
include '../components/connect.php';

if (isset($_GET['batch_id'])) {
    $batch_id = $_GET['batch_id'];
    $batch_id = filter_var($batch_id, FILTER_SANITIZE_STRING);

    // Fetch batch details
    $select_batch = $conn->prepare("SELECT * FROM batch WHERE id = ? LIMIT 1");
    $select_batch->execute([$batch_id]);

    if ($select_batch->rowCount() > 0) {
        $batch_details = $select_batch->fetch(PDO::FETCH_ASSOC);

        // Fetch tutor details
        $select_tutor = $conn->prepare("SELECT fname, lname FROM tutors WHERE id = ?");
        $select_tutor->execute([$batch_details['tutor_id']]);
        $tutor_details = $select_tutor->fetch(PDO::FETCH_ASSOC);

        // Fetch enrolled students
        $select_students = $conn->prepare("
        SELECT u.student_number AS student_number, u.fname, u.lname 
        FROM enrollments e 
        JOIN users u ON e.student_number = u.student_number
        WHERE e.batch_number = ?
    ");
        $select_students->execute([$batch_details['batch_number']]);
        $students = $select_students->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error = "Batch not found.";
    }
} else {
    header('location:batch.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Batch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="playlist-form">
    <h1 class="heading">Batch Details</h1>

    <?php if (isset($error)) { ?>
        <p class="error"><?= $error; ?></p>
    <?php } else { ?>
        <div class="details">
            <h3>Batch Title: <?= htmlspecialchars($batch_details['title']); ?></h3>
            <p><strong>Batch Number:</strong> <?= htmlspecialchars($batch_details['batch_number']); ?></p>
            
            <p><strong>Start Date:</strong> <?= htmlspecialchars($batch_details['start']); ?></p>
            <p><strong>End Date:</strong> <?= htmlspecialchars($batch_details['end']); ?></p>
            <p><strong>Tutor:</strong> <?= htmlspecialchars($tutor_details['fname'] . ' ' . $tutor_details['lname']); ?></p>
        </div>

        <h2 class="heading">Enrolled Students</h2>
        <?php if (count($students) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Student Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) { ?>
                        <tr>
                            <td><?= htmlspecialchars($student['student_number']); ?></td>
                            <td><?= htmlspecialchars($student['fname']); ?></td>
                            <td><?= htmlspecialchars($student['lname']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No students enrolled in this batch.</p>
        <?php } ?>
    <?php } ?>
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
