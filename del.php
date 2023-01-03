<!DOCTYPE html>
<html>
<head>
	<title> Manage Parcel </title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="style/sidebarstyle.css">
  <link rel="stylesheet" href="style/extra.css">  
  <link rel="stylesheet" href="style/deleteparcelform.css"> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		 <!--Logo besides title-->
       <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
       <link rel="stylesheet" href="new_style.css">

	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php 
include 'config.php';

    $id = $_GET['delete'];
    $sql = "SELECT studentID FROM parcel WHERE trackingNo = '$id'"; 
    $result=mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $id_student=$row[0];   
        
    $query = "SELECT staffID FROM parcel WHERE trackingNo = '$id'" ; 
    $result=mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $id_staff=$row[0];
?>

<section>

          <div class="container">

          <form id="delparcel" method="POST">

          <div class="header">
              
              <p>Fill enter correct details to verify deletion</p>
              
          </div>

          <div class="sep"></div>

          <div class="inputs">

              <input type="text" name="custID" id="custID" placeholder="User ID" autofocus required />
              <input type="text" name="custPhone" id="custPhone" placeholder="Phone Number" required autofocus />
              <input type="text" name="location" id="location" placeholder="Location" required autofocus />
              
              <button type="submit" name="delBtn" id="submit">Remove Parcel</a>

          </div>

          </form>


</section>

</div>
</body>
</html>

<?php

    session_start();
    include 'config.php';
    //error_reporting(0);

        if(isset($_POST['delBtn'])){
    
            $cust_ID = $_POST['custID'];
            $cust_phone = $_POST['custPhone'];
            $cust_loc = $_POST['location'];
        
            
                if($cust_ID == $id_student ){
        
                    $sql = "DELETE FROM parcel WHERE trackingNo = '$id' "; 
                    $result=mysqli_query($conn, $sql);
                
                    if ($result > 0) {
                      $sql2 = "INSERT INTO transaction(ID, phoneNo, tracking, location) VALUES ('$cust_ID','$cust_phone','$id','$cust_loc')";
                      $result=mysqli_query($conn, $sql2);
                      echo "<script>alert('Process Succesful'); window.location.href=' parcel_list.php';</script>";
                    }
                    else{
                        echo "<script>alert('Process Unsuccessful'); window.location.href='parcel_list.php';</script>";
                        // header("Location: index.php?error=nouser");
                        exit();
                
                    }
                    //header("Location: unclaim_parcel.php");
                    }
                    elseif($cust_ID == $id_staff ){
        
                      $sql = "DELETE FROM parcel WHERE trackingNo = '$id' "; 
                      $result=mysqli_query($conn, $sql);
                  
                      if ($result > 0) {
                        $sql2 = "INSERT INTO transaction(ID, phoneNo, tracking,location) VALUES ('$cust_ID','$cust_phone','$id','$cust_loc')";
                        $result=mysqli_query($conn, $sql2);
                          echo "<script>alert('Process Succesful'); window.location.href='parcel_list.php';</script>";
                      }
                      else{
                          echo "<script>alert('Process Unsuccessful'); window.location.href=' parcel_list.php';</script>";
                          // header("Location: index.php?error=nouser");
                          exit();
                  
                      }
                      //header("Location: unclaim_parcel.php");
                      }
                      else {
                          echo "<script>alert('Process Unsuccessful, ID Number does not match'); window.location.href='parcel_list.php';</script>";
        
                  }
        }



?>