<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>teachers</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/teacher_header.php'; ?>

<!-- teachers section starts  -->

<section class="teachers">

   <h1 class="heading">Teachers</h1>

   <form action="search_tutor.php" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container">


   <h1 class="heading">Student Records</h1>

      <div class="col-lg-12"> 
            <h1 class="page-header">List of Users <small>|  <label class="label label-xs" style="font-size: 12px"><a href="studentrecords.php">  <i class="fa fa-plus-circle fw-fa"></i> New</a></label> |</small></h1> 
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
				  		 Account Name</th>
				  		<th>Username</th>
				  		<th width="10%">Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
   
				  		$selectusers = $conn->prepare("SELECT * FROM  `users`");
                  $selectusers->execute();
                  $users = $selectusers->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($users as $result) {
                     echo '<tr>';
                     echo '<td width="5%" align="center"></td>';
                     echo '<td>' . htmlspecialchars($result['name']) . '</td>';
                     echo '<td>' . htmlspecialchars($result['email']) . '</td>';
                     echo '<td>
                              <a title="Edit" href="index.php?view=edit&id=' . $result['id'] . '" class="btn btn-primary btn-xs">
                                 <i class="fa fa-pencil fa-fw"></i>
                              </a>
                              <a title="Delete" href="controller.php?action=delete&id=' . $result['id'] . '" class="btn btn-danger btn-xs">
                                 <i class="fa fa-bitbucket fa-fw"></i>
                              </a>
                           </td>';
                     echo '</tr>';
                  } 
				  	?>
				  </tbody>
					
				</table> 
				</form> 

</section>

<!-- teachers section ends -->




<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>