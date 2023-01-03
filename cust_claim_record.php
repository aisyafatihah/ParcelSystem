<?php
session_start();
if(empty($_SESSION['id'])){
  header("Location: index.php");
}
else{
  
  $user_ID = $_SESSION['id'];
  $pwd = $_SESSION['passwd'];
  $user_name = $_SESSION['name'];
  $user = $_SESSION['type'];
  $salut = $_SESSION['sex'];


					include 'config.php';
					//error_reporting(0);

          $query = "UPDATE parcel SET duration=TIMESTAMPDIFF(DAY,dateAdd,CURRENT_DATE)";
          $result = mysqli_query($conn,$query);

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Claim History </title>

<!-- Datatable CSS -->
<link href='jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<!-- jQuery Library -->
<script src="jquery-3.6.0.min.js"></script>
<!-- Datatable JS -->
<script src="jquery.dataTables.min.js"></script>

<!-- normal table -->
<!-- <script src="table.js"></script> -->
<link rel="stylesheet" type="text/css" href="table.css" media="all">

<link rel="stylesheet" type="text/css" href="new_style.css" media="all">
<link rel="stylesheet" href="dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  		 <!--Logo besides title-->
       <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

  <input type="checkbox" id="nav-toggle">
  <div class="sidebar">
        <div class="sidebar-brand">
        <h3><img class="logo-sidebar" src="image/logo.png" alt="parcel logo" width="70" height="60">
        <span>UTeM Parcel System</span></h3>
        </div>

    <div class="sidebar-menu">
 
      <ul>
        <li>
          <a href="dashboard_cust.php"><span class='bx bxs-dashboard'></span><span>Dashboard</span></a>
        </li>
        <!-- <li>
          <a href="profile_admin.php"><span class='bx bx-user-circle'></span><span>User Profile</span></a>
        </li> -->
        <li>
          <a href="cust_unclaim.php"><span class='bx bxs-package'></span><span>Unclaimed Parcel</span></a>
        </li>
        <li>
          <a class="active"  href="cust_claim_record.php"><span class='bx bxs-hourglass-bottom'></span><span>Claim History</span></a>
        </li>
        <li>
          <a href="cust_penalty_list.php"><span class='bx bx-money-withdraw'></span><span>Penalty List</span></a>
        </li>
        <li>
          <a href="logout.php"><span class='bx bx-log-out'></span><span>Logout</span></a>
        </li>
      </ul>
</div>
</div>

<div class="main-content">
  <header>
    <h2>
      <label for="nav-toggle">
        <span class="las la-bars"></span>
</label>
        Claim History
</h2>
<div class="user-wrapper">
  <img src="image/bg.jpg" width="40px" height="40px" alt="">
  <div>
  <?php echo '<h4>'.$salut. " " .$user_name.'</h4>'; ?>
  <?php echo '<small>'.$user.'</small>'; ?>
</div>
</div>
</header>
<main>
  <div class="recent-grid">
  <div class="tbl">
  <div class="card">

  <div class="card-header">
  <table width=100%>
  <thead>
				<tr>
					<th>User ID</th>
					<th colspan="2">Customer Name</th>
          <th colspan="2">Tracking Number</th>
					<th>Claim Date</th>
					<th>Phone Number</th>
				</tr>
			</thead>
</div>
  <div class="card-body">
  
      <tbody>
         <?php

          if(empty($_SESSION['id'])){
            header("Location: index.php");
          }
          else{

            $user_ID = $_SESSION['id'];
            $pwd = $_SESSION['passwd'];

          $query = "UPDATE parcel SET duration=TIMESTAMPDIFF(DAY,dateAdd,CURRENT_DATE)";
          $result = mysqli_query($conn,$query);

          $userType = substr($user_ID, 0, 1);

          if($userType == "B"){


               //$sql = "SELECT * FROM parcel WHERE studentID LIKE'%$user_ID%' AND DATEDIFF(CURRENT_DATE,dateAdd) > 7 ";
               
               $sql = "SELECT * FROM transaction JOIN customer_student ON ID = customer_stud_ID WHERE customer_stud_ID LIKE  '%$user_ID%'";
               $result = mysqli_query($conn, $sql);

               if(mysqli_num_rows($result) > 0)
               {
               foreach($result as $items)
               {   
                
                ?>      
               <tr>
               
                 <td><?= $items['customer_stud_ID']; ?></td>
                 <td colspan="2"><?= $items['customerName']; ?></td>
                 <td colspan="2"><?= $items['tracking']; ?></td>
                 <td><?= $items['date']; ?></td>
                 <td><?=  $items['phoneNo']; ?></td>

             </tr>
             <?php 
               }
               }
               else
               {
               ?>
               <tr>
               <td colspan="10">No Record Found</td>
               </tr>
               <?php
                 }
                  
                  }
                  if($userType == "0"){


                    $sql = "SELECT * FROM transaction JOIN customer_staff ON ID = customer_staff_ID WHERE customer_staff_ID LIKE '%$user_ID%'";
                    $result = mysqli_query($conn, $sql);
     
                    if(mysqli_num_rows($result) > 0)
                    {
                    foreach($result as $items)
                    {   
                     
                     ?>      
                    <tr>
                    
                      <td><?= $items['customer_staff_ID']; ?></td>
                      <td colspan="2"><?= $items['customerName']; ?></td>
                      <td colspan="2"><?= $items['tracking']; ?></td>
                      <td><?= $items['date']; ?></td>
                      <td><?= $items['phoneNo']; ?></td>
     
                  </tr>
                  <?php 
                    }
                    }
                    else
                    {
                    ?>
                    <tr>
                    <td colspan="10">No Record Found</td>
                    </tr>
                    <?php
                      }
                       
                       }
                }
                $conn->close();
         ?> 
</tbody>

</table>

</div>
</div>
</div>
</div>    
</main>

</div>
</body>
<html>