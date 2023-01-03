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
	<title> Penalty Fee </title>
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<!-- <link rel="stylesheet" href="style/sidebarstyle.css">  -->
  <!-- <link rel="stylesheet" href="style/extra.css"> -->
  <!-- <link rel="stylesheet" href="style/displaytable.css"> -->
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> -->
  <link rel="stylesheet" type="text/css" href="new_style.css" media="all">
  <link rel="stylesheet" href="jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- normal table -->
<!-- <script src="table.js"></script> -->
<link rel="stylesheet" type="text/css" href="table.css" media="all">

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
          <a href="claim_record.php"><span class='bx bxs-hourglass-bottom'></span><span>Claim History</span></a>
        </li>
        <li>
          <a class="active" href="penalty_list.php"><span class='bx bx-money-withdraw'></span><span>Penalty Fee</span></a>
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
        Penalty Fee
</h2>

<form action="" method="GET">
        <div class="search-wrapper">
        <button type="submit" class="searchBtn"><i class="las la-search"></i></button>
        <input type="text" name="search"  required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search User/Student ID"/>
        <!-- <button type="submit" class="searchBtn">Search</button> -->

</form>
</div>
<div class="user-wrapper">
  <img src="image/bg.jpg" width="40px" height="40px" alt="">
  <div>
  <?php echo '<h4>'.$salut. " " .$user_name.'</h4>'; ?>
    <small>Admin</small>
</div>
</div>
</header>
<main>
<h4 style="color: red;font-size: 15px;">Parcel that is not collected more than 7 days is considered as an overdue parcel and will be charged | Penalty Fee = Overdue Days x RM 2 </h4>
<div class="recent-grid">
  <div class="tbl">
  <div class="card">

  <div class="card-header">
  <table width=100%>
  <thead>
        <tr>
					<th>User ID</th>
					<th colspan="2">Customer Name</th>
          <th colspan="2">Tracking No</th>
					<th>Overdue day(s)</th>
					<th>Penalty Fee (RM)</th>
				</tr>
			    </thead>
          <div class="card-body">
                <tbody>
                <?php

//check session
if(empty($_SESSION['id'])){
  header("Location: index.php");
}
else{

  if(isset($_GET['search']))
  {
$filtervalues = $_GET['search'];
$userType = substr($filtervalues, 0, 1);

//search user from student table
    if($userType == "B"){
    $sql = "SELECT * FROM parcel, customer_student WHERE CONCAT(studentID) LIKE '$filtervalues' AND CONCAT(customer_stud_ID) LIKE '%$filtervalues%' AND DATEDIFF(CURRENT_DATE,dateAdd) > 7 ";
    $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0)
      {
        foreach($result as $items)
        {
  ?>
          <tr>
            <td><?= $items['studentID']; ?></td>
            <td colspan="2"><?= $items['customerName']; ?></td>
            <td colspan="2"><?= $items['trackingNo']; ?></td>
            <td><?= $items['duration']-7; ?></td>
            <td><?= ($items['duration']-7)*2 ; ?></td>
          </tr>
<?php
        }
      }else{ //if no user in student table
        ?>
        <tr>
        <td colspan="10">No Record Found</td>
        </tr>
        <?php
          }
    }elseif($userType == "0" || $userType == "-"){ //search user from staff table
      
      $sql = "SELECT * FROM parcel, customer_staff WHERE CONCAT(staffID) LIKE '$filtervalues' AND CONCAT(customer_staff_ID) LIKE '%$filtervalues%' AND DATEDIFF(CURRENT_DATE,dateAdd) > 7 ";
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0)
      {
        foreach($result as $items)
        {
      ?>
        <tr>
          <td><?= $items['staffID']; ?></td>
          <td colspan="2"><?= $items['customerName']; ?></td>
          <td colspan="2"><?= $items['trackingNo']; ?></td>
          <td><?= $items['duration']-7; ?></td>
          <td><?= ($items['duration']-7)*2 ; ?></td>
        </tr>
    <?php
        }
      }else{ //if user does not exist in table
        ?>
        <tr>
        <td  colspan="10">No Record Found</td>
        </tr>
        <?php
          }
    }else{ //if other input inserted
        ?>
        <tr>
        <td  colspan="10">No Record Found</td></tr>
        <?php
          }
  }
}
      ?>

  </tbody>
    </table>
    </div>
</div>

<!-- <script src="jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
    $('#myTable').DataTable();
});
</script> -->


    <!-- new -->


</main>

</div>
</body>
<html>