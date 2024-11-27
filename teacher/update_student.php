<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_GET['user_id'])){
   $user_id = $_GET['user_id'];
}else{
   $user_id = '';
   header('location:contents.php');
}

$select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_user->execute([$user_id]);
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){

   $prev_pass = $fetch_user['password'];
   $prev_image = $fetch_user['image'];

   $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
   $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
   $mname = filter_var($_POST['mname'], FILTER_SANITIZE_STRING);
   $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
   $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
   $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);

   // Update first name
   if(!empty($fname)){
      $update_fname = $conn->prepare("UPDATE `users` SET fname = ? WHERE id = ?");
      $update_fname->execute([$fname, $user_id]);
      $message[] = 'First name updated successfully!';
   }

   // Update last name
   if(!empty($lname)){
      $update_lname = $conn->prepare("UPDATE `users` SET lname = ? WHERE id = ?");
      $update_lname->execute([$lname, $user_id]);
      $message[] = 'Last name updated successfully!';
   }

   // Update middle name
   if(!empty($mname)){
      $update_mname = $conn->prepare("UPDATE `users` SET mname = ? WHERE id = ?");
      $update_mname->execute([$mname, $user_id]);
      $message[] = 'Middle name updated successfully!';
   }

   // Update address
   if(!empty($address)){
      $update_address = $conn->prepare("UPDATE `users` SET address = ? WHERE id = ?");
      $update_address->execute([$address, $user_id]);
      $message[] = 'Address updated successfully!';
   }

   // Update date of birth
   if(!empty($dob)){
      $update_dob = $conn->prepare("UPDATE `users` SET dob = ? WHERE id = ?");
      $update_dob->execute([$dob, $user_id]);
      $message[] = 'Date of birth updated successfully!';
   }

   if(!empty($gender)){
      $update_dob = $conn->prepare("UPDATE `users` SET gender = ? WHERE id = ?");
      $update_dob->execute([$gender, $user_id]);
      $message[] = 'Date of gender updated successfully!';
   }

   // Existing image update logic
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Image size too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET `image` = ? WHERE id = ?");
         $update_image->execute([$rename, $user_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if($prev_image != '' && $prev_image != $rename){
            unlink('uploaded_files/'.$prev_image);
         }
         $message[] = 'Image updated successfully!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Update Information</h3>
      <div class="flex">
         <div class="col">
            <p>First Name</p>
            <input type="text" name="fname" placeholder="<?= $fetch_user['fname']; ?>" maxlength="100" class="box">
            <p>Last Name</p>
            <input type="text" name="lname" placeholder="<?= $fetch_user['lname']; ?>" maxlength="100" class="box">
            <p>Address</p>
            <input type="text" name="address" placeholder="<?= $fetch_user['address']; ?>" maxlength="100" class="box">
            <p>Update Picture</p>
            <input type="file" name="image" accept="image/*" class="box">
         </div>
         <div class="col">
            <p>Middle Name</p>
            <input type="text" name="mname" placeholder="<?= $fetch_user['mname']; ?>" maxlength="100" class="box">
            <p>Gender </p>
            <select name="gender" class="box">
               <option value="" selected><?= $fetch_user['gender']; ?></option>
               <option value="male">male</option>
               <option value="female">female</option>
               <option value="others">others</option>
            </select>

            <p>Birthday</p>
            <input type="date" name="dob" value="<?= htmlspecialchars($fetch_user['dob']); ?>" class="box">
   
         </div>
      </div>
      <input type="submit" name="submit" value="update profile" class="inline-btn">
      <a href="student_profile.php?user_id=<?= $user_id?>" class="inline-btn">Cancel</a>
   </form>

</section>


<!-- update profile section ends -->










<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>