<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
    exit;
}

// Get batch_id from URL
$batch_id = isset($_GET['batch_id']) ? $_GET['batch_id'] : '';
$batch_info = [];
$students = [];
$tutor = '';

// If batch_id is valid
if ($batch_id) {
    // Fetch batch details
    $select_batch = $conn->prepare("SELECT * FROM batch WHERE batch_number = ? AND tutor_id = ? LIMIT 1");
    $select_batch->execute([$batch_id, $tutor_id]);

    if ($select_batch->rowCount() > 0) {
        $batch_info = $select_batch->fetch(PDO::FETCH_ASSOC);

        // Fetch tutor details
        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE id = ?");
        $select_tutor->execute([$batch_info['tutor_id']]);
        if ($select_tutor->rowCount() > 0) {
            $tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
        }

        // Fetch students in this batch
        $select_students = $conn->prepare("SELECT * FROM users WHERE batch_number = ?");
        $select_students->execute([$batch_id]);

        if ($select_students->rowCount() > 0) {
            $students = $select_students->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $message[] = 'Batch not found or access denied!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Batch Info</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="playlists">

   <h1 class="heading">Batch Info</h1>

   <div class="box-container">
       <!-- Display batch info -->
       <?php if (!empty($batch_info)): ?>
       <div class="box">
           <h3 class="title"><?= htmlspecialchars($batch_info['title']); ?> - Course: <?= htmlspecialchars($batch_info['course']); ?></h3>
           <p><strong>Tutor:</strong> <?= htmlspecialchars($tutor['fname']); ?></p>
           
           <h4>Students in this Batch:</h4>
           <ul>
               <?php foreach ($students as $student): ?>
                   <li><?= htmlspecialchars($student['fname']); ?> - <?= htmlspecialchars($student['email']); ?></li>
               <?php endforeach; ?>
           </ul>
       </div>
       <?php else: ?>
           <p class="empty">No batch information available or batch does not exist.</p>
       <?php endif; ?>
   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
