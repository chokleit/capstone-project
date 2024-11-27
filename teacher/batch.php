<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
    exit;
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['batch_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_batch = $conn->prepare("SELECT * FROM batch WHERE id = ? AND tutor_id = ? LIMIT 1");
    $verify_batch->execute([$delete_id, $tutor_id]);

    if ($verify_batch->rowCount() > 0) {
        $delete_batch = $conn->prepare("DELETE FROM batch WHERE id = ?");
        $delete_batch->execute([$delete_id]);
        $message[] = 'Batch deleted!';
    } else {
        $message[] = 'Batch already deleted or not found!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="playlists">

    <h1 class="heading">Batch List</h1>

    <div class="box-container">

        <?php
        $select_batch = $conn->prepare("SELECT * FROM batch WHERE tutor_id = ? ORDER BY id DESC");
        $select_batch->execute([$tutor_id]);
        if ($select_batch->rowCount() > 0) {
            while ($fetch_batch = $select_batch->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="box">
            <h3 class="title"><?= htmlspecialchars($fetch_batch['title']); ?></h3>

            <a href="batchinfo.php?batch_id=<?= $fetch_batch['batch_number']; ?>" class="btn">View Batch</a>

        </div>
        <?php
            }
        } else {
            echo '<p class="empty">No batches added yet!</p>';
        }
        ?>
    </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
