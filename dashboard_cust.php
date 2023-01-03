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
	<title> Dashboard </title>
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<!-- <link rel="stylesheet" href="style/sidebarstyle.css">  -->
  <!-- <link rel="stylesheet" href="style/extra.css">
  <link rel="stylesheet" href="style/displaytable.css"> -->
  <link rel="stylesheet" href="new_style.css">
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
          <a class="active" href="dashboards.php"><span class='bx bxs-dashboard'></span><span>Dashboard</span></a>
        </li>
        <!-- <li>
          <a href="profile_admin.php"><span class='bx bx-user-circle'></span><span>User Profile</span></a>
        </li> -->
        <li>
          <a href="cust_unclaim.php"><span class='bx bxs-package'></span><span>Unclaimed Parcel</span></a>
        </li>
        <li>
          <a href="cust_claim_record.php"><span class='bx bxs-hourglass-bottom'></span><span>Claim History</span></a>
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
        Dashboard
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
    <div class="cards">
      <div class="card-single">
      <div>
      <?php

      $userType = substr($user_ID, 0, 1);

      if($userType == "B"){
        $qry="SELECT * FROM parcel WHERE studentID LIKE '%$user_ID%'";
        $result=mysqli_query($conn,$qry);

        if($parcelTotal = mysqli_num_rows($result)){
          echo'<h3 class="mb-0 mt-3">'.$parcelTotal.' </h3>';
        }else{
          echo'<h3 class="mb-0 mt-3">No Data</h3>';
        }
      ?>
      <span>Total Unclaimed Parcels</span>
</div>
      <div>
        <span class="las la-users"></span>
</div>
</div>

<div class="card-single">
      <div>
      <?php
        $qry="SELECT * FROM parcel WHERE studentID LIKE '%$user_ID%' AND duration > 7";
        $result=mysqli_query($conn,$qry);

        if($parcelTotal = mysqli_num_rows($result)){
          echo'<h3 class="mb-0 mt-3">'.$parcelTotal.' </h3>';
        }else{
          echo'<h3 class="mb-0 mt-3">No Data</h3>';
        }
      }
      else{
        $qry="SELECT * FROM parcel WHERE staffID LIKE '%$user_ID%'";
        $result=mysqli_query($conn,$qry);

        if($parcelTotal = mysqli_num_rows($result)){
          echo'<h3 class="mb-0 mt-3">'.$parcelTotal.' </h3>';
        }else{
          echo'<h3 class="mb-0 mt-3">No Data</h3>';
        }
      ?>
      <span>Total Unclaimed Parcels</span>
      </div>
      <div>
        <span class="las la-users"></span>
      </div>
      </div>

      <div class="card-single">
      <div>
      <?php
        $qry="SELECT * FROM parcel WHERE staffID LIKE '%$user_ID%' AND duration > 7";
        $result=mysqli_query($conn,$qry);

        if($parcelTotal = mysqli_num_rows($result)){
          echo'<h3 class="mb-0 mt-3">'.$parcelTotal.' </h3>';
        }else{
          echo'<h3 class="mb-0 mt-3">No Data</h3>';
        }
      }
      ?>
      <span>Total Overdue Parcel</span>
</div>
      <div>
        <span class="las la-hourglass-end"></span>
</div>
</div>

</div>

</main>

</div>
</body>
<html>