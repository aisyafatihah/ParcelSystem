<?php
	session_start();
	include 'config.php';
	error_reporting(0);

if(isset($_POST['registerBtn'])){

    $fname = $_POST['name'];
    $user_ID = $_POST['userID'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
	$sex=$_POST['sex']; 


        $userType = substr($email,10);
		$userType2 = substr($email,-3);

        if($userType == "@student.utem.edu.my"){

            //check existing user
            $sql = "SELECT * FROM customer_student WHERE customerEmail = '$email'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                
                echo "<script>alert('User already existed'); window.location.href='register.php';</script>";
                // header(string, replace, http_response_code);
            }
            else{
            	
                $sql = "INSERT INTO customer_student(customer_stud_ID, customerName, customerEmail, phoneNumber, password, gender) VALUES ('$user_ID','$fname','$email','$phone','$pwd','$sex')";
                $result=mysqli_query($conn,$sql);

      		if($resultCheck > 0){
      			echo "<script>alert('Registration Unsuccessful'); window.location.href='register.php'</script>";
      		}else{
      			echo "<script>alert('Registration Succesful'); window.location.href='index.php'</script>";
      		}
            	// header("Location: index.php");
                // $stmt->close();
                $conn->close();
            }
        }elseif($userType2 == "com") {

            //check existing user
            $sql = "SELECT * FROM admin WHERE staffEmail = '$email'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
            
                // header("Location: register.php");
                echo "<script>alert('User already existed.'); window.location.href='register.php'</script>";
       
            }
            else{

            	 $sql = "INSERT INTO admin(staffID, staffName, staffEmail, phoneNo, staffPassword, gender) VALUES ('$user_ID','$fname','$email','$phone','$pwd', '$sex')";
                $result=mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

      		if($resultCheck > 0){
				echo "<script>alert('Registration Unsuccessful.'); window.location.href='register.php'</script>";	
      		}else{
				echo "<script>alert('Registration Successful.'); window.location.href='index.php'</script>";
      		      			
      		}
                // header("Location: index.php");
                // $stmt->close();
                $conn->close();

            }
                    
        }
		else{
			
			//check existing user
            $sql = "SELECT * FROM customer_staff WHERE customerEmail = '$email'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
            
                // header("Location: register.php");
                echo "<script>alert('User already existed.'); window.location.href='register.php'</script>";
       
            }
            else{

            	 $sql = "INSERT INTO customer_staff(customer_staff_ID, customerName, customerEmail, phoneNumber, password,gender) VALUES ('$user_ID','$fname','$email','$phone','$pwd','$sex')";
                $result=mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

      		if($resultCheck > 0){
				echo "<script>alert('Registration Unsuccessful.'); window.location.href='register.php'</script>";	
      		}else{
				echo "<script>alert('Registration Successful.'); window.location.href='index.php'</script>";
      		      			
      		}
                // header("Location: index.php");
                // $stmt->close();
                $conn->close();

            }
			}

      }



?>

<!DOCTYPE html>
<html>

	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This website manages parcel details">

		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="style/loginstyle.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script defer src="validate_form.js"></script>
		

		<!-- Title of web app @ browser tab-->
		<title>University Parcel System</title>

		 <!--Logo besides title-->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

		<!--Center the header-->
		/*<style>
			h1 {text-align: center;}
			/* Dashed red border */
			hr {
  				border-top: 5px dashed darkolivegreen;
  			}
		</style>


	<body>
		
			<center><section class="Form my-4 mx-5">
				<div class="container">
					<div class="row justify-content-center g-0">
						<!-- <div class="col-lg-5">
							<img src="image/parcel.jpg" class="img-fluid" alt="login">
						</div> -->
						<div class="col-lg-7 px-5 py-5">
						<center><img src="image/logoutem.png" class="img-fluid" alt="logo" width="250" height="100"></center>
							<h1 class="font-weight-bold py-5">UTeM Parcel Management System</h1>
							<h4 class="px-5 py-1">Please Fill in the details</h4>

							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="form" class="login-ID">
                                <div class="form-row px-5 text-center">
								<div class="row align-items-center">
								<div class="col-1 m-0 justify-content-center align-items-center">
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
												<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
												<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
											</svg>
										</div>
										<div class="col">
									<div class="input-control">
										<input type="text" name="name" placeholder="User Name"  id="name" >
										<div class="error"></div>
									</div>
								</div>
								</div>
								</div>


								<div class="form-row px-5 mt-2 text-center">
									<div class="row align-items-center">
										<div class="col-1 m-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  											<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
										</svg>
										</div>
										<div class="col">
									<div class="input-control">
										<tr>
										<input type="text" name="userID" placeholder="User ID" id="userID">
									</tr>
										<div class="error"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-row px-5 mt-2 text-center">
									<div class="row align-items-center">
										<div class="col-1 m-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  											<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
												</svg>
										</div>
										<div class="col">
									<div class="input-control">
										<input type="text" name="phone" placeholder="User Phone Number" id="phone">
										<div class="error"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-row px-5 mt-2 text-center">
									<div class="row align-items-center">
										<div class="col-1 m-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  											<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
										</svg>
										</div>
										<div class="col">
									<div class="input-control">
										<input type="text" name="email" placeholder="User Email" id="email">
										<div class="error"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-row px-5 mt-2 text-center">
									<div class="row align-items-center">
										<div class="col-1 m-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
												<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
											</svg>
										</div>
										<div class="col">
									<div class="input-control">
										<input type="password" name="password" placeholder="User Password" id="password"/>
										<div class="error"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-row px-5 mt-2 text-center">
									<div class="row align-items-center">
										<div class="col-1 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
 										 <path fill-rule="evenodd" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1H11.5zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z"/>
											</svg>
											</div>
										<div class="col">
										<td><input type="radio" name="sex" value="Male"/>&nbsp &nbsp Male &nbsp &nbsp &nbsp &nbsp </td>  
											<tr> 
											<td><input type="radio" name="sex" value="Female"/>&nbsp &nbsp Female </td></tr>  
											</tr> 
								</div>
									<!-- <div class="col-lg-7 my-1"> -->
										<button type="submit" name="registerBtn" class="btn1">Register</button>
									<!-- </div> -->
								</div>
								<a class="px-5" href="index.php">Login?</a>
							</form>

						</div>
					</div>
				</div>
			</section><center>
		<script src="js/bootstrap.js"></script>
	</body>

</html>