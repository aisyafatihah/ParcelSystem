<!DOCTYPE html>
<html>
<head>
	<title> Sidebar </title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="style/sidebar.css">
	<link rel="stylesheet" href="style/displaytable.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

	<div class="sidebar"> 
		<div class="logo_content">
			<div class="logo">
				<i class='bx bxs-package'></i>
				<div class="logo_name"><b>UTeM Parcel System </b></div>
			</div>
			<!-- <i class='bx bx-menu' id="btn"></i> -->
		</div>
		<ul class="nav_list">
			<li>
				<a href="#">
					<i class='bx bx-package'></i>
					<span class="links_name">Unclaimed Parcel</span>
				</a>
				<!-- <span class="tooltip">Unclaimed Parcel </span> -->
			</li>

			<li>
				<a href="parcelhistory.php"><i class='bx bx-history'></i>
					<span class="links_name">Parcel History</span>
				</a>
				<!-- <span class="tooltip">Parcel History</span> -->
			</li>

			<li>
				<a href="#">
					<i class='bx bxs-hourglass-bottom'></i>
					<span class="links_name">Overdue Parcel</span>
				</a>
				<!-- <span class="tooltip">Overdue Parcel</span> -->
			</li>

			<li>
				<a href="#">
					<i class='bx bx-money-withdraw'></i>
					<span class="links_name">Student Penalty Fee</span>
				</a>
				<!-- <span class="tooltip">Student Penalty Fee</span> -->
			</li>

			<li>
				<a href="#"><i class='bx bx-edit'></i>
					<span class="links_name">Add Parcel</span>
				</a>
				<!-- <span class="tooltip">Add/Remove Parcel</span> -->
			</li>
	</div>

	<script type="text/javascript">
		let btn=document.querySelector("#btn");
		let sidebar=document.querySelector(".sidebar");

		btn.onclick=function(){
			sidebar.classList.toggle("active");
		}

	</script>

	<section>
		<h1 class="center">UNCLAIMED PARCEL</h1>
		<br>

		<!-- search bar -->
		<form method="post">
			<input type="text" placeholder="Search" name="search">
			<input type="submit" name="submit">
		</form>

		<table class="displayTable">
			<thead>
				<tr>
					<th>Student/Staff ID</th>
					<th>Customer Name</th>
					<th>Phone Number</th>
					<th>Tracking Number</th>
					<th>IC Number </th>
					<th class="center">Option </th>
				</tr>
			</thead>

			<tbody>
				<?php
					session_start();
					include 'config.php';
					error_reporting(0);


					// $query="SELECT * FROM customer";
					// $result=mysqli_query($conn,$query);

					// $str=$_POST["search"];
					// // $sth=$con->prepare("SELECT * FROM 'customer' WHERE customerIC='$str'");

					// $query="SELECT * FROM 'customer' WHERE customerIC='$str'";
					// $result=mysqli_query($conn,$query);

					if(isset($_POST["submit"])){
					$str=$_POST["search"];
					// $sth=$con->prepare("SELECT * FROM 'customer' WHERE customerIC='$str'");

					$query="SELECT * FROM customer WHERE customerIC='$str'";
					$result=mysqli_query($conn,$query);

					//read data each row
					// while($row = $result->fetch_assoc()){

						if(!$result){
						// die("Error Occured: " . $conn->error);
							die("No customer with that IC");
					}

						if(mysqli_num_rows($result)>0){
							$row = $result->fetch_assoc($result);
						echo "<tr>
							<td>" .$row["matricNumber"] . "</td>
							<td>" .$row["customerName"] . "</td>
							<td>" .$row["phoneNumber"] . "</td>
							<td>" .$row["trackingNo"] . "</td>
							<td>" .$row["customerIC"] . "</td>
							<td>
								<a href='index.php?'> <button class='btn'>Claim </button></a>
								<a href='index.php?'> <button class='btn'>Notify </button></a>
							</td>
							</tr>";
					}
					 }

				

				?>

			</tbody>
		</table>
	</section>


</body>
<html>

