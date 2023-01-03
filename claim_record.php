<?php
session_start();
if(empty($_SESSION['id'])){
  header("Location: index.php");
}
else{

  $user_ID = $_SESSION['id'];
  $pwd = $_SESSION['passwd'];
  $user_name = $_SESSION['name'];
  $salut = $_SESSION['sex'];

					include 'config.php';
					//error_reporting(0);

}
?>


<!DOCTYPE html>
<html>
<head>
	<title> Claim History </title>
	<!-- Datatable CSS -->
  <link href='jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="jquery-3.6.0.min.js"></script>

<!-- Datatable JS -->
<script src="jquery.dataTables.min.js"></script>

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
          <a href="dashboards.php"><span class='bx bxs-dashboard'></span><span>Dashboard</span></a>
        </li>
        <!-- <li>
          <a href="profile_admin.php"><span class='bx bx-user-circle'></span><span>User Profile</span></a>
        </li> -->
        <li>
          <a href="parcel_list.php"><span class='bx bxs-package'></span><span>Unclaimed Parcel</span></a>
        </li>
        <li>
          <a  class="active" href="claim_record.php"><span class='bx bxs-hourglass-bottom'></span><span>Claim History</span></a>
        </li>
        <li>
          <a href="penalty_list.php"><span class='bx bx-money-withdraw'></span><span>Penalty Fee</span></a>
        </li>
        <li>
          <a href="add_parcel.php"><span class='bx bx-edit'></span><span>Add Parcel</span></a>
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
    <small>Admin</small>
</div>
</div>
</header>
<main>
<div class="container">
<div class="row">
<table id="myTable" class="table table-striped" style="width:100%">
			<thead>
				<tr>
					<th >User ID</th>
          <th >Claim Date</th>
					<th>Location</th>
          <th >Phone Number</th>
					<th >Tracking Number</th>
				</tr>
			</thead>
		</table>
    <script src="table_claim_record.js"></script>

</main>

</div>
</body>
<html>