<?php
include_once('../controller/config.php');

if(isset($_GET["do"])&&($_GET["do"]=="update_classroom")){

	$id=$_GET['id'];
	$name=$_GET['name']; 
	$student_count=$_GET['student_count']; 
	
	$sql="SELECT * FROM class_room where name='$name'";	
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	
	$id1=$row['id'];
	$name1=$row['name'];
	$student_count1=$row['student_count'];
	
	$msg=0;//for alerts
	$id2="";
	$name2="";
	$student_count2="";

	if($name == $name1 && $id == $id1){//MSK-000143-U-1
		if($student_count != $student_count1 ){//MSK-000143-U-2
		
			$sql1 = "update class_room set name='".$name."',student_count='".$student_count."' where id='$id'";
			
			if(mysqli_query($conn,$sql1)){
				
				$msg+=1;
				//MSK-000143-U-3 The record has been successfully updated in the database
	
				$sql2="SELECT * FROM class_room where id='$id'";	
				$result2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_assoc($result2);//MSK-000143-U-4
				
				$id2=$row2['id'];
				$name2=$row2['name'];
				$student_count2=$row2['student_count'];
	
			}else{
				$msg+=2;
				//MSK-000143-U-5 Connection problem
			}
			
		}else{	
			$msg+=3;
			//MSK-000143-U-6 You didn't make any changes.:D
		}
	
	}else if($id != $id1){//MSK-000143-U-7
		if($name == $name1){
			
			$msg+=4;
			//MSK-000143-U-8 The classroom is duplicated
			
		}else{//MSK-000143-U-9
				
			$sql1 = "update class_room set name='".$name."',student_count='".$student_count."' where id='$id'";
			if(mysqli_query($conn,$sql1)){
				
				$msg+=1;
				//MSK-000143-U-10 The record has been successfully updated in the database
				
				$sql2="SELECT * FROM class_room where id='$id'";	
				$result2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_assoc($result2);//MSK-000143-U-11
				
				$id2=$row2['id'];
				$name2=$row2['name'];
				$student_count2=$row2['student_count'];
							
			}else{
				$msg+=2;
				//MSK-000143-U-12 Connection problem
			}
			
		}
		
	}else{	
		
	}		


$res=array($id2,$name2,$student_count2,$msg);
echo json_encode($res);//MSK-000143-U-13

}
?>