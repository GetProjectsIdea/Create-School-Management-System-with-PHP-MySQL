<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="update_teacher")){

	$id=$_POST['id'];
	$full_name=$_POST['full_name']; 
	$i_name=$_POST['i_name']; 
	$address=$_POST['address']; 
	$gender=$_POST['gender']; 
	$phone=$_POST['phone']; 
	$email=$_POST['email'];
	
	$c_page=$_POST['c_page'];//current table page
	
	$sql1="SELECT * FROM teacher where email='$email'";	
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	
	$id1=$row1['id'];
	$full_name1=$row1['full_name']; 
	$i_name1=$row1['i_name']; 
	$address1=$row1['address']; 
	$gender1=$row1['gender']; 
	$phone1=$row1['phone']; 
	$email1=$row1['email'];
	
	$target_dir = "uploads/";
	$name = basename($_FILES["fileToUpload"]["name"]);
	$size = $_FILES["fileToUpload"]["size"];
	$type = $_FILES["fileToUpload"]["type"];
	$tmpname = $_FILES["fileToUpload"]["tmp_name"];

	$max = 31457280;
	$extention = strtolower(substr($name, strpos($name, ".")+ 1));
	$filename = date("Ymjhis");
	
	$msg=0;//for alerts
	$image_path = $target_dir.$filename.".".$extention;
 
	if($email == $email1 && $id == $id1){//MSK-000143-U-1
		
		if($full_name != $full_name1 || $i_name != $i_name1 || $address != $address1 || $gender != $gender1 ||$phone != $phone1 || $name){//MSK-000143-U-2		
			
			if(!$name){//MSK-000143-U-3
				$sql = "update teacher set full_name='".$full_name."',i_name='".$i_name."',address='".$address."',gender='".$gender."',phone='".$phone."' ,email='".$email."' where id='$id'";
	
				if(mysqli_query($conn,$sql)){
								
					$msg+=1; 
					//MSK-000143-U-4 The record has been successfully updated in the database
				}else{
					$msg+=2; 
					//MSK-000143-U-5 Connection problem
				}
	
			}else{ //MSK-000143-U-6
				if(move_uploaded_file($tmpname, $image_path)){ //MSK-000143-U-7
					$sql = "update teacher set full_name='".$full_name."',i_name='".$i_name."',address='".$address."',gender='".$gender."',phone='".$phone."' ,email='".$email."',image_name='".$image_path."' where id='$id'";
	
					if(mysqli_query($conn,$sql)){
									
						$msg+=1; 
						//MSK-000143-U-8 The record has been successfully updated into the database
					}else{
						$msg+=2; 
						//MSK-000143-U-9 Connection problem
					}
		
				}else{
					//MSK-000143-U-10 If there aren't any folder - "uploads"
					$msg+=3;  
				}
		
			}
			
		}else{
			//MSK-000143-U-11 You didn't make any changes.:D
			$msg+=4;
		}
	
	}else if($id != $id1){//MSK-000143-U-12
	
		if($email == $email1){
		
			//MSK-000143-U-13 The email address is duplicated
			$msg+=5;
				
		}else{//MSK-000143-U-14

			if(!$name){//MSK-000143-U-15
			
				$sql = "update teacher set full_name='".$full_name."',i_name='".$i_name."',address='".$address."',gender='".$gender."',phone='".$phone."' ,email='".$email."' where id='$id'";

				if(mysqli_query($conn,$sql)){
					$msg+=1; 
					//MSK-000143-U-16 The record has been successfully updated into the database
				}else{
					$msg+=2; 
					//MSK-000143-U-17 Connection problem
				}

			}else{//MSK-000143-U-18
			
				if(move_uploaded_file($tmpname, $image_path)){//MSK-000143-U-19	
			
					$sql = "update teacher set full_name='".$full_name."',i_name='".$i_name."',address='".$address."',gender='".$gender."',phone='".$phone."' ,email='".$email."',image_name='".$image_path."' where id='$id'";

					if(mysqli_query($conn,$sql)){
						$msg+=1; 
						//MSK-000143-U-20 The record has been successfully updated into the database
					}else{
						$msg+=2; 
						//MSK-000143-U-21 Connection problem
					}
	
				 }else{
					//MSK-000143-U-22 If there aren't any folder - "uploads"
					$msg+=3;  
				 }
	
			  }
	
		}
	}else{	
		
	}		

	header("Location: view/all_teacher.php?do=alert_from_update&msg=$msg&page=$c_page");//MSK-000143-U-23		

}
?>