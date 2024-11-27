<?php

include 'components/connect.php';

// Check if the user is logged in
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="courses">
    <div class="content">
    <h1>My Enrolled Courses hi</h1>

    <?php if (count($courses) > 0): ?>
        <div class="courses-list">
            <?php foreach ($courses as $course): ?>
                <div class="course-box">
                    <img src="uploaded_filess/<?= htmlspecialchars($course['thumb']); ?>" alt="Course Thumbnail">
                    <h3><?= htmlspecialchars($course['title']); ?></h3>
                    <p><?= htmlspecialchars($course['description']); ?></p>
                    <a href="view_playlist.php?get_id=<?= $course['course_id']; ?>" class="btn">View Course</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>You are not enrolled in any courses.</p>
    <?php endif; ?>
    </div>
</section>

</body>
</html>
