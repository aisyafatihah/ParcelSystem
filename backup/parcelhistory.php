<!DOCTYPE html>
<html>
<head>
	<title> Sidebar </title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="style/sidebar.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<div class="sidebar"> 
		<div class="logo_content">
			<div class="logo">
				<i class='bx bxs-package'></i>
				<div class="logo_name">UTeM Parcel System</div>
			</div>
			<i class='bx bx-menu' id="btn"></i>
		</div>
		<ul class="nav_list">
			<li>
				<a href="#">
					<i class='bx bx-package'></i>
					<span class="links_name">Unclaimed Parcel</span>
				</a>
				<span class="tooltip">Unclaimed Parcel </span>
			</li>

			<li>
				<a href="#"><i class="bx bx-history"></i>
					<span class="links_name">Parcel History</span>
				</a>
				<span class="tooltip">Parcel History</span>
			</li>

			<li>
				<a href="#">
					<i class='bx bxs-hourglass-bottom'></i>
					<span class="links_name">Overdue Parcel</span>
				</a>
				<span class="tooltip">Overdue Parcel</span>
			</li>

			<li>
				<a href="#">
					<i class='bx bx-money-withdraw'></i>
					<span class="links_name">Student Penalty Fee</span>
				</a>
				<span class="tooltip">Student Penalty Fee</span>
			</li>

			<li>
				<a href="#"><i class='bx bx-edit'></i>
					<span class="links_name">Add/Remove Parcel</span>
				</a>
				<span class="tooltip">Add Parcel</span>
			</li>
	</div>

	<script type="text/javascript">
		let btn=document.querySelector("#btn");
		let sidebar=document.querySelector(".sidebar");

		btn.onclick=function(){
			sidebar.classList.toggle("active");
		}

	</script>

</body>
<html>