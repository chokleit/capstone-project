<?php

include 'components/connect.php';

if (!isset($_COOKIE['user_id']) || !isset($_COOKIE['student_number'])) {
   header('location:login.php');
   
}

$student_number = $_COOKIE['student_number']; // Student identifier

// Fetch courses the student is enrolled in
$query = $conn->prepare("
    SELECT p.* 
    FROM enrollments e
    INNER JOIN playlist p ON e.course_id = p.course_id
    WHERE e.student_number = ?
");
$query->execute([$student_number]);

$courses = $query->fetchAll(PDO::FETCH_ASSOC); // Get the enrolled courses

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="playlists">

    <h1 class="heading">Enrolled Courses</h1>

    <div class="box-container">

        <?php
        // Query to fetch courses the user is enrolled in
        $select_playlist = $conn->prepare("
            SELECT DISTINCT p.*
            FROM enrollments e
            INNER JOIN playlist p ON e.course_id = p.course_id
            WHERE e.student_number = ?
            ORDER BY p.date DESC
        ");
        $select_playlist->execute([$user_id]);

        if ($select_playlist->rowCount() > 0) {
            while ($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)) {
                $playlist_id = $fetch_playlist['course_id'];
                ?>
                <div class="box">
                    <div class="flex">
                        <div>
                            <i class="fas fa-circle-dot" style="<?= $fetch_playlist['status'] === 'active' ? 'color:limegreen' : 'color:red'; ?>"></i>
                            <span style="<?= $fetch_playlist['status'] === 'active' ? 'color:limegreen' : 'color:red'; ?>"><?= $fetch_playlist['status']; ?></span>
                        </div>
                        <div><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
                    </div>
                    <div class="thumb">
                        <img src="../uploaded_files/<?= htmlspecialchars($fetch_playlist['thumb']); ?>" alt="">
                    </div>
                    <h3 class="title"><?= htmlspecialchars($fetch_playlist['title']); ?></h3>
                    <p class="description"><?= htmlspecialchars($fetch_playlist['description']); ?></p>
                    <a href="view_playlist.php?get_id=<?= $playlist_id; ?>" class="btn">View Course</a>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">You are not enrolled in any courses!</p>';
        }
        ?>

    </div>

</section>

<script src="../js/admin_script.js"></script>

<script>
    document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
        if (content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
    });
</script>

</body>
</html>
