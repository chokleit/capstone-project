<?php
include '../components/connect.php';

if(isset($_GET['id'])) {
   $student_id = $_GET['id'];

   if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $fname = $_POST['fname'];
      $dob = $_POST['dob'];
      $address = $_POST['address'];
      $contactnum = $_POST['contactnum'];
      $email = $_POST['email'];

      $update_query = $conn->prepare("UPDATE users SET fname = ?, dob = ?, address = ?, contactnum = ?, email = ? WHERE id = ?");
      $update_query->execute([$fname, $dob, $address, $contactnum, $email, $student_id]);
      header('location:student_list.php');
   }

   $select_query = $conn->prepare("SELECT * FROM users WHERE id = ?");
   $select_query->execute([$student_id]);
   $student = $select_query->fetch(PDO::FETCH_ASSOC);
} else {
   header('location:student_list.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Edit Student</title>
   <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <form method="POST">
      <input type="text" name="fname" value="<?= htmlspecialchars($student['fname']) ?>" required>
      <input type="date" name="dob" value="<?= htmlspecialchars($student['dob']) ?>" required>
      <input type="text" name="address" value="<?= htmlspecialchars($student['address']) ?>" required>
      <input type="text" name="contactnum" value="<?= htmlspecialchars($student['contactnum']) ?>" required>
      <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
      <button type="submit">Update</button>
   </form>
</body>
</html>
