<?php
	session_start();
	include 'config.php';
	error_reporting(0);

	if(isset($_POST['addButton'])){

		$matricNumber=$_POST['matricNumber'];
		$customerIC=$_POST['customerIC'];
		$customerName=$_POST['customerName'];
		$phoneNumber=$_POST['phoneNumber'];
		$trackingNo=$_POST['trackingNo'];


		if(!empty($matricNumber) && !empty($customerIC) && !empty($customerName) && !empty($phoneNumber) && !empty($trackingNo)){

		$query="SELECT * FROM customer WHERE trackingNo='$trackingNo'"; 

      	$result=mysqli_query($conn,$query);

		if ($result->num_rows>0){
			echo '<script>
			alert("Parcel already exists in system")
			</script>';
		}
		else{

      		$query="INSERT INTO customer(matricNumber,customerName,phoneNumber,trackingNo,customerIC)
      		VALUES('$matricNumber','$customerName', '$phoneNumber','$trackingNo','$customerIC',)";

      		$result=mysqli_query($conn,$query);

      		if(!$result){
      			echo '<script>alert("Add Parcel Unsuccessful")</script>';
      		}else{
      			echo '<script>alert("Add Parcel Succesful")</script>';
      		}
		}
	}
}
?>

<!DOCTYPE html>
<html>

	<head>
		
		<meta charset="utf-8">
		<meta name="description" content="This website manages parcel details">

		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="style/loginstyle.css">
		<!-- <link rel="stylesheet" href="style/extra.css"> -->

		<!-- Title of web app @ browser tab-->
		<title>University Parcel System</title>

		 <!--Logo besides title-->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

	<body>
		
			<section class="Form my-4 mx-5">
				<div class="container">
					<div class="row g-0">
							<h1 style="margin: 20px;" class="font-weight-bold text-center">Add New Parcel</h1>
							<h4 class="text-center">Please Fill in the details</h4>

							<form action="" method="POST">
                                <div class="form-row px-5">
									<div class="col-lg-7">
										<input type="text" placeholder="Matric Number" name="matricNo" value="<?php echo $matricNumber;?>" class="form-control my-3" >
									</div>
								</div>
								<div class="form-row px-5">
									<div class="col-lg-7">
										<input type="text" placeholder="Customer IC" name="customerIC" value="<?php echo $customerIC;?>" class="form-control my-3">
									</div>
								</div>
								<div class="form-row px-5">
									<div class="col-lg-7">
										<input type="text" placeholder="Customer Name" name="customerName" value="<?php echo $customerName;?>" class="form-control my-3">
									</div>
								</div>
								<div class="form-row px-5">
									<div class="col-lg-7">
										<input type="text" placeholder="Phone Number" name="phoneNumber" value="<?php echo $phoneNumber;?>" class="form-control my-3">
									</div>
								</div>
								<div class="form-row px-5">
									<div class="col-lg-7">
										<input type="text" placeholder="Tracking Number" name="trackingNo" value="<?php echo $trackingNo;?>" class="form-control my-3">
									</div>
								</div>
								<div class="form-row px-5">
									<div class="col-lg-3 my-1">
										<button type="submit" name="addButton">Add Parcel</button>
										<!-- <button type="reset" id="cancelAdd" class="button" value="CLEAR">Clear</button> -->
									</div>
					
							</form>
					</div>
				</div>
			</section>
		<script src="js/bootstrap.js"></script>
	</body>

</html>