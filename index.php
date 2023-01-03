<?php  

	session_start();
	include 'config.php';
	error_reporting(0);

	

	if(isset($_POST['loginBtn'])){

        $user_ID=$_POST['userID'];
		$pwd=$_POST['password'];

            $userType = substr($user_ID, 0, 1);

            if($userType == "B"){

                //check existing user from table student
                $sql = "SELECT * FROM customer_student WHERE customer_stud_ID = '$user_ID' AND password = '$pwd'";
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {

                    //set up variable that will be saved as session variables
                    $_SESSION['id'] = $user_ID;
                    $_SESSION['passwd'] = $pwd;
					
					$sql2 = "SELECT customerName FROM customer_student WHERE customer_stud_ID='$user_ID'";
					$result = mysqli_query($conn,$sql2);
					$row = mysqli_fetch_array($result);
					$user_name=$row[0];
					$_SESSION['name']=$user_name;


					$user="Customer (Student)";
					$_SESSION['type']=$user;

					$query = "SELECT gender FROM customer_student WHERE customer_stud_ID = '$user_ID' AND password = '$pwd'";
					$result = mysqli_query($conn,$query);
					$row = mysqli_fetch_array($result);
					$sex=$row[0];

					if ($sex=="Female")
					{
						$salutation = "Ms";
						$_SESSION['sex']=$salutation;
					}else{
						$salutation = "Mr";
						$_SESSION['sex']=$salutation;
					}

                    header("Location: dashboard_cust.php");

                }
                else {
                	 echo "<script>alert('User does not exists. Please register first'); window.location.href='register.php';</script>";
                    // header("Location: index.php?error=nouser");
                    exit();
                }
                $conn->close();
            }
            else if($userType == "0"){
                //check existing user
                $sql = "SELECT * FROM customer_staff WHERE customer_staff_ID = '$user_ID' AND password = '$pwd'";
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {

                    //set up variable that will be saved as session variables
                    $_SESSION['id'] = $user_ID;
                    $_SESSION['passwd'] = $pwd;

					$sql2 = "SELECT customerName FROM customer_staff WHERE customer_staff_ID='$user_ID'";
					$result = mysqli_query($conn,$sql2);
					$row = mysqli_fetch_array($result);
					$user_name=$row[0];
					$_SESSION['name']=$user_name;

					$user="Customer (Staff)";
					$_SESSION['type']=$user;

					$query = "SELECT gender FROM customer_staff WHERE customer_staff_ID= '$user_ID' AND password = '$pwd'";
					$result = mysqli_query($conn,$query);
					$row = mysqli_fetch_array($result);
					$sex=$row[0];

					if ($sex=="Female")
					{
						$salutation = "Ms";
						$_SESSION['sex']=$salutation;
					}else{
						$salutation == "Mr";
						$_SESSION['sex']=$salutation;
					}
                
                    header("Location: dashboard_cust.php");
                }
                else{
                	echo "<script>alert('User does not exists. Please register first'); window.location.href='register.php';</script>";
                    // header("Location: index.php?error=nouser");
                    exit();

                }
                $conn->close();
            }
			else{
                //check existing user
                $sql = "SELECT * FROM admin WHERE staffID = '$user_ID' AND staffPassword = '$pwd'";
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {

                    //set up variable that will be saved as session variables
                    $_SESSION['id'] = $user_ID;
                    $_SESSION['passwd'] = $pwd;
                
					$sql2 = "SELECT staffName FROM admin WHERE staffID='$user_ID'";
					$result = mysqli_query($conn,$sql2);
					$row = mysqli_fetch_array($result);
					$user_name=$row[0];
					$_SESSION['name']=$user_name;

					$user="Admin";
					$_SESSION['type']=$user;

					$query = "SELECT gender FROM admin WHERE staffID= '$user_ID' AND staffPassword = '$pwd'";
					$result = mysqli_query($conn,$query);
					$row = mysqli_fetch_array($result);
					$sex=$row[0];

					if ($sex=="Female")
					{
						$salutation = "Ms";
						$_SESSION['sex']=$salutation;
					}else{
						$salutation = "Mr";
						$_SESSION['sex']=$salutation;
					}

                    header("Location: dashboards.php");
                }
                else{
                	echo "<script>alert('User does not exists. Please register first'); window.location.href='register.php';</script>";
                    // header("Location: index.php?error=nouser");
                    exit();

                }
                $conn->close();
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
		<script defer src="validate_login.js"></script>

		<!-- Title of web app @ browser tab-->
		<title>University Parcel System</title>

		 <!--Logo besides title-->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

		<!--Center the header-->
		<style>
			h1 {text-align: center;}
			/* Dashed red border */
			hr {
  				border-top: 5px dashed darkolivegreen;
  			}
		</style>


	<body style= "">
		
			<center><section class="Form my-4 mx-5">
				<div class="container-sm" style= "">
					<div class="row justify-content-center g-0" >
						<!-- <div class="col-lg-5">
							<img src="image/parcel.jpg" class="img-fluid" alt="login">
						</div> -->
						<div class="col-lg-7 px-5 py-5">
							<center><img src="image/logoutem.png" class="img-fluid" alt="logo" width="250" height="100"></center>
							<h1 class="font-weight-bold py-5">Parcel Management System</h1>
							<h4 class="px-5 py-1">Please login</h4>

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
												
												<input type="text" name="userID" placeholder="User ID" id="userID" style="outline-color: #24428F;">
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
												<tr>

													<input type="password" name="password" id="password" placeholder= "Password">
												</tr>
												
											<div class="error"></div>
										</div>
									</div>
									
								</div>
									
								</div>
								<div class="form-row px-5">
									<!-- <div class="col-lg-7 my-1"> -->
										<button type="submit" name="loginBtn" class="btn1">Login</button>
									<!-- </div> -->
								</div>
								<a class="px-5" href="register.php">Register New User</a>
							</form>
						</div>
					</div>
				</div>
			</section></center>
		
		<script src="js/bootstrap.js"></script>
	</body>

</html>