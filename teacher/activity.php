<?php

include '../components/connect.php';


if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}
// Fetch unreviewed activities
$submitted_activities = $conn->prepare("
    SELECT sa.*, 
           CONCAT(u.fname, ' ', u.lname) AS student_name
    FROM `submitted_activities` sa
    JOIN `users` u ON sa.student_id = u.id
    WHERE sa.status IS NULL OR sa.status = ''
    ORDER BY sa.uploaded_at DESC
");
$submitted_activities->execute();

// Handle form submission for updating status
if (isset($_POST['update_status'])) {
    $submission_id = $_POST['submission_id'];
    $new_status = $_POST['status'];

    $update_status = $conn->prepare("UPDATE `submitted_activities` SET status = ? WHERE id = ?");
    $update_status->execute([$new_status, $submission_id]);

    $message = "Submission marked as " . ($new_status == 'Passed' ? 'Passed' : 'Failed') . "!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Activity Review</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/teacher_header.php'; ?>
<section>
    <h1 class="heading">Submitted Activities</h1>

    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Activity File</th>
                <th>Uploaded At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $submitted_activities->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['student_name']); ?></td>
                    <td><a href="uploaded_files/<?= htmlspecialchars($row['file']); ?>" target="_blank">View File</a></td>
                    <td><?= htmlspecialchars($row['uploaded_at']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="submission_id" value="<?= $row['id']; ?>">
                            <button type="submit" name="update_status" value="Passed" class="btn">Pass</button>
                            <button type="submit" name="update_status" value="Failed" class="btn">Fail</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </section>
</body>
</html>
