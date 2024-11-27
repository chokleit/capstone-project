<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student List</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>
   
<section class="contents">
   <h1 class="heading">Student Records</h1>


<div class="row">
      <div class="col-lg-12"> 
            <h1>List of Users</h1> 
       		 <br>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
			    <form action="controller.php?action=delete" Method="POST">  					
				<table id="example" class="table table-hover table-bordered" cellspacing="0" style="font-size:12px" >
				
				  <thead>
				  	<tr>
				  		<th>No.</th>
				  		<th>
				  		 <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
				  		 Name</th>
                  <th>Date of Birth</th>
                  <th>Address</th>
                  <th>Contact Number</th>
                  <th>Email</th>
				  		<th width="10%">Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
              <?php 
   $selectusers = $conn->prepare("SELECT * FROM  `users`");
   $selectusers->execute();
   $users = $selectusers->fetchAll(PDO::FETCH_ASSOC);

   $counter = 1; // Start the counter from 1
   foreach ($users as $result) {
      echo '<tr>';
      echo '<td width="5%" align="center">' . $counter++ . '</td>'; // Increment counter
      echo '<td>' . htmlspecialchars($result['fname']) . '</td>';
      echo '<td>' . htmlspecialchars($result['dob']) . '</td>';
      echo '<td>' . htmlspecialchars($result['address']) . '</td>';
      echo '<td>' . htmlspecialchars($result['contactnum']) . '</td>';
      echo '<td>' . htmlspecialchars($result['email']) . '</td>';
      echo '<td>
               <a href="edit_student.php?id=' . $result['id'] . '" class="btn btn-primary btn-sm">Edit</a>
               <a href="delete_student.php?id=' . $result['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this student?\');">Delete</a>
            </td>';
      echo '</tr>';
   } 
?>

				  </tbody>
					
				</table> 
				</form> 

</section>



<script src="../js/admin_script.js"></script>

</body>
</html>