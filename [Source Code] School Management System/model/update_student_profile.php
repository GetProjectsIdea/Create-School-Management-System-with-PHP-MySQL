<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="update_student_profile")){

	$id=$_POST['id'];
	$my_son_index_number=$_POST['son_index_number'];
	
	$full_name=$_POST['full_name'];
	$i_name=$_POST['i_name']; 
	$gender=$_POST['gender']; 
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	
	$g_name=$_POST['g_name']; 
	$g_address=$_POST['g_address'];
	$g_phone=$_POST['g_phone']; 
	$g_email=$_POST['g_email'];
	
	$email=$_POST['email']; 
	$password=$_POST['password']; 
	
	$sql2="SELECT * FROM student WHERE id='$id'";
	$result2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_assoc($result2);
	$email2=$row2['email'];
	
	$tarPOST_dir = "uploads/";
	$name = basename($_FILES["fileToUpload"]["name"]);
	$size = $_FILES["fileToUpload"]["size"];
	$type = $_FILES["fileToUpload"]["type"];
	$tmpname = $_FILES["fileToUpload"]["tmp_name"];

	$max = 31457280;
	$extention = strtolower(substr($name, strpos($name, ".")+ 1));
	$filename = date("Ymjhis");
	
	$msg=0;//for alerts  
	$image_path = $tarPOST_dir.$filename.".".$extention;
	
	if(!$name){
		
		$sql = "update student set full_name='".$full_name."',i_name='".$i_name."', gender='".$gender."',address='".$address."', phone='".$phone."',email='".$email."' where id='$id'";
		
		if(mysqli_query($conn,$sql)){
			
			$sql5 = "update parents set i_name='".$g_name."',address='".$g_address."', phone='".$g_phone."',email='".$g_email."' where my_son_index='$my_son_index_number'";
			mysqli_query($conn,$sql5);
							
			if($email == $email2){
				$sql1 = "update user set password='".$password."' where email='$email'";
				mysqli_query($conn,$sql1);
					
			}else{
				$sql3="DELETE FROM user WHERE email='$email2'";
				mysqli_query($conn,$sql3);
					
				$sql4="INSERT INTO user (email,password,type) 
					   VALUES ( '".$email."','".$password."','Student')";
				mysqli_query($conn,$sql4);
					
			}
			
			$msg+=1;
			//MSK-000143-U-4 The record has been successfully updated in the database.
		
		}else{
			$msg+=2;
			//MSK-000143-U-6 Connection problem	
		}
		
	}else{
		
		if(move_uploaded_file($tmpname, $image_path)){
			
			$sql = "update student set full_name='".$full_name."',i_name='".$i_name."', gender='".$gender."',address='".$address."', phone='".$phone."',email='".$email."',image_name='".$image_path."' where id='$id'";
		
			if(mysqli_query($conn,$sql)){
				
				$sql5 = "update parents set i_name='".$g_name."',address='".$g_address."', phone='".$g_phone."',email='".$g_email."' where my_son_index='$my_son_index_number'";
			    mysqli_query($conn,$sql5);
							
				if($email == $email2){
					$sql1 = "update user set password='".$password."' where email='$email'";
					mysqli_query($conn,$sql1);
					
				}else{
					$sql3="DELETE FROM user WHERE email='$email2'";
					mysqli_query($conn,$sql3);
					
					$sql4="INSERT INTO user (email,password,type) 
						   VALUES ( '".$email."','".$password."','Student')";
					mysqli_query($conn,$sql4);
					
				}
				$msg+=1;
				//MSK-000143-U-4 The record has been successfully updated in the database.
		
			}else{
				$msg+=2;
				//MSK-000143-U-6 Connection problem	
			}
			
			
			
		}else{
			
			//There is haven't image root folder.
		}
		
	}
	
	header("Location:view/my_profile.php?do=alert_from_update&msg=$msg");//MSK-000143-5

}
?>