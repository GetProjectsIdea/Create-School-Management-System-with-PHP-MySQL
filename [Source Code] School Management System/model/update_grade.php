<?php
include_once('../controller/config.php');

if(isset($_GET["do"])&&($_GET["do"]=="update_grade")){

	$id=$_GET['id'];
	$name=$_GET['name'];
	$admission_fee=$_GET['admission_fee']; 
	$hall_charge=$_GET['hall_charge']; 
	
	$sql="SELECT * FROM grade where name='$name'";	
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	
	$id1=$row['id'];
	$name1=$row['name'];
	$admission_fee1=$row['admission_fee']; 
	$hall_charge1=$row['hall_charge']; 
	
	$msg=0;//for alerts
	$id2="";
	$name2="";
	$admission_fee2="";
	$hall_charge2="";
	
	if($name == $name1){
		if($id == $id1){
			if($admission_fee == $admission_fee1 && $hall_charge == $hall_charge1){
				$msg+=3;
				//MSK-000143-U-1 You didn't make any changes.:D
			}else{
				$sql1 = "update grade set admission_fee='".$admission_fee."',hall_charge='".$hall_charge."' where id='$id'";
		
				if(mysqli_query($conn,$sql1)){
					
					$msg+=1;
					//MSK-000143-U-4 The record has been successfully updated in the database.
						
					$sql2="SELECT * FROM grade where id='$id'";	
					$result2=mysqli_query($conn,$sql2);
					$row2=mysqli_fetch_assoc($result2);//MSK-000143-U-5
						
					$id2=$row2['id'];
					$name2=$row2['name'];
					$admission_fee2=$row2['admission_fee'];
					$hall_charge2=$row2['hall_charge'];
									
				}else{
					$msg+=2;
					//MSK-000143-U-6 Connection problem	
				}
				
			}	
		}else{
			$msg+=4;
			//MSK-000143-U-2 The grade is duplicated
		}
	
	}else{//MSK-000143-U-3
				
		$sql1 = "update grade set name='".$name."',admission_fee='".$admission_fee."',hall_charge='".$hall_charge."' where id='$id'";
		
		if(mysqli_query($conn,$sql1)){
			
			$msg+=1;
			//MSK-000143-U-4 The record has been successfully updated in the database.
				
			$sql2="SELECT * FROM grade where id='$id'";	
			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($result2);//MSK-000143-U-5
				
			$id2=$row2['id'];
			$name2=$row2['name'];
			$admission_fee2=$row2['admission_fee'];
			$hall_charge2=$row2['hall_charge'];
							
		}else{
			$msg+=2;
			//MSK-000143-U-6 Connection problem	
		}
	
	}

$res=array($id2,$name2,$admission_fee2,$hall_charge2,$msg);
echo json_encode($res);//MSK-000143-U-7

}
?>