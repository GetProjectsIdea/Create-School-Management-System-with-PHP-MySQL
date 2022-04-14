<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="update_student")){

	$std_index=$_POST['std_index'];
	$grade_id=$_POST['grade_id'];
	
	$full_name=$_POST['full_name']; 
	$i_name=$_POST['i_name']; 
	$address=$_POST['address']; 
	$gender=$_POST['gender']; 
	$phone=$_POST['phone']; 
	$email=$_POST['email'];
	$b_date = $_POST["b_date"];
	
	$g_full_name = $_POST["g_full_name"];
	$g_i_name= $_POST["g_i_name"];
	$g_gender = $_POST["g_gender"];
	$g_address = $_POST["g_address"];
	$g_phone = $_POST["g_phone"];
	$g_email = $_POST["g_email"];
	$g_b_date = $_POST["g_b_date"];
		
	$target_dir = "uploads/";
	
	$name = basename($_FILES["fileToUpload"]["name"]);
	$size = $_FILES["fileToUpload"]["size"];
	$type = $_FILES["fileToUpload"]["type"];
	$tmpname = $_FILES["fileToUpload"]["tmp_name"];

	$max = 31457280;
	$extention = strtolower(substr($name, strpos($name, ".")+ 1));
	$filename = date("Ymjhis");
	
	//Guardian Details
	$name1 = basename($_FILES["g_fileToUpload"]["name"]);
	$size1 = $_FILES["g_fileToUpload"]["size"];
	$type1 = $_FILES["g_fileToUpload"]["type"];
	$tmpname1 = $_FILES["g_fileToUpload"]["tmp_name"];

	$max1 = 31457280;
	$extention1 = strtolower(substr($name1, strpos($name1, ".")+ 1));
	$filename1 = date("Ymjhis")+1;
 
	$msg=0;//for alerts
	$g_msg=0;
	$image_path = $target_dir.$filename.".".$extention; 
	$g_image_path =  $target_dir.$filename1.".".$extention1;
	
	if(!$name){
		
		$sql = "update student set full_name='".$full_name."',i_name='".$i_name."',address='".$address."',gender='".$gender."',phone='".$phone."' ,email='".$email."',b_date='".$b_date."' where index_number='$std_index'";
	
		if(mysqli_query($conn,$sql)){
			$msg+=1; 
			//MSK-000143-U-8 The record has been successfully updated into the database
		}else{
			$msg+=2; 
			//MSK-000143-U-9 Connection problem
		}
	}else{
		if(move_uploaded_file($tmpname, $image_path)){
			$sql = "update student set full_name='".$full_name."',i_name='".$i_name."',address='".$address."',gender='".$gender."',phone='".$phone."' ,email='".$email."',image_name='".$image_path."',b_date='".$b_date."' where index_number='$std_index'";
	
			if(mysqli_query($conn,$sql)){
				
				$msg+=1; 
				//MSK-000143-U-8 The record has been successfully updated into the database
			}else{
				$msg+=2; 
				//MSK-000143-U-9 Connection problem
			}
		}
		
	}
	
	if(!$name1){
		 $sql1 = "update parents set full_name='".$g_full_name."',i_name='".$g_i_name."',address='".$g_address."',gender='".$g_gender."',phone='".$g_phone."' ,email='".$g_email."',b_date='".$g_b_date."' where my_son_index='$std_index'";
		 
		 if(mysqli_query($conn,$sql1)){
				
			$msg+=1; 
			//MSK-000143-U-8 The record has been successfully updated into the database
		}else{
			$msg+=2; 
			//MSK-000143-U-9 Connection problem
		}
	
	}else{
		if(move_uploaded_file($tmpname1, $g_image_path)){
			
			 $sql1 = "update parents set full_name='".$g_full_name."',i_name='".$g_i_name."',address='".$g_address."',gender='".$g_gender."',phone='".$g_phone."' ,email='".$g_email."',image_name='".$g_image_path."',b_date='".$g_b_date."' where my_son_index='$std_index'";
			 
			 if(mysqli_query($conn,$sql1)){
				
			$msg+=1; 
			//MSK-000143-U-8 The record has been successfully updated into the database
		}else{
			$msg+=2; 
			//MSK-000143-U-9 Connection problem
		}
			 
		}
	}

	
	if(isset($_POST["showPage"])&&($_POST["showPage"]=="all_student")){
	
		header("Location: view/all_student.php?do=alert_from_update&msg=$msg&grade=$grade_id");//MSK-000143-U-23			
	}
	
	if(isset($_POST["showPage"])&&($_POST["showPage"]=="my_student")){
	
		header("Location: view/my_student.php?do=alert_from_update&msg=$msg&grade=$grade_id");//MSK-000143-U-23			
		
	}


		
}
?>