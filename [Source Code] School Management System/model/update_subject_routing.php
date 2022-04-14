<?php
include_once('../controller/config.php');

	$id=$_GET['id'];
	$grade=$_GET['grade']; 
	$subject=$_GET['subject']; 
	$teacher=$_GET['teacher']; 
	$fee=$_GET['fee']; 

	$sql1="SELECT * FROM grade where name='$grade'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$grade_id=$row1['id'];

	$sql2="SELECT * FROM subject where name='$subject'";
	$result2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_assoc($result2);
	$subject_id=$row2['id'];

	$sql3="SELECT * FROM teacher where i_name='$teacher'";
	$result3=mysqli_query($conn,$sql3);
	$row3=mysqli_fetch_assoc($result3);
	$teacher_id=$row3['id'];
	
	$sql4="SELECT * FROM subject_routing where grade_id='$grade_id' and subject_id='$subject_id' and teacher_id='$teacher_id'";
	$result4=mysqli_query($conn,$sql4);
	$row4=mysqli_fetch_assoc($result4);

	$id4=$row4['id'];
	$grade_id4=$row4['grade_id'];	
	$subject_id4=$row4['subject_id'];
	$teacher_id4=$row4['teacher_id'];
	$fee4=$row4['fee'];

	$msg=0;
	$grade1=""; 
	$subject1=""; 
	$teacher1=""; 
	$fee1="";  
	
	if($grade_id == $grade_id4 && $subject_id == $subject_id4 && $teacher_id == $teacher_id4){
		if($id == $id4){//MSK-000143-U-1
		
			if($fee == $fee4){
				$msg+=3;
				//MSK-000143-U-2 You didn't make any of changes.:D	
				
			}else{//MSK-000143-U-3
				$sql5 = "update subject_routing set grade_id='".$grade_id."',subject_id='".$subject_id."',teacher_id='".$teacher_id."',fee='".$fee."' where id='$id'";
				if(mysqli_query($conn,$sql5)){
					$msg+=1;
					//MSK-000143-U-4 The record has been successfully updated in the database
					
					$sql6="select subject_routing.fee as s_fee,grade.name as g_name,subject.name as s_name,teacher.i_name as t_name
						   from subject_routing
						   inner join grade
						   on subject_routing.grade_id=grade.id 
						   inner join subject
						   on subject_routing.subject_id=subject.id 
						   inner join teacher
						   on subject_routing.teacher_id=teacher.id
						   where subject_routing.id='$id'";
					
					$result6=mysqli_query($conn,$sql6);
					$row6=mysqli_fetch_assoc($result6);//MSK-000143-U-5
					
					$grade1=$row6['g_name']; 
					$subject1=$row6['s_name']; 
					$teacher1=$row6['t_name']; 
					$fee1=$row6['s_fee']; 
						
				}else{
					$msg+=2;
					//MSK-000143-U-6 Connection problem
				}
				
			}
			
		}else{
			$msg+=4;
			//MSK-000143-U-7 The record is duplicated
		}
		
	}else{//MSK-000143-U-8
	
		$sql5 = "update subject_routing set grade_id='".$grade_id."',subject_id='".$subject_id."',teacher_id='".$teacher_id."',fee='".$fee."' where id='$id'";
		
		if(mysqli_query($conn,$sql5)){

			$msg+=1;
			//MSK-000143-U-9 The record has been successfully updated in the database
			
			$sql6="select subject_routing.fee as s_fee,grade.name as g_name,subject.name as s_name,teacher.i_name as t_name
				   from subject_routing
				   inner join grade
				   on subject_routing.grade_id=grade.id 
				   inner join subject
				   on subject_routing.subject_id=subject.id 
				   inner join teacher
				   on subject_routing.teacher_id=teacher.id
				   where subject_routing.id='$id'";
			
			$result6=mysqli_query($conn,$sql6);
			$row6=mysqli_fetch_assoc($result6);//MSK-000143-U-10
			
			$grade1=$row6['g_name']; 
			$subject1=$row6['s_name']; 
			$teacher1=$row6['t_name']; 
			$fee1=$row6['s_fee']; 
				
		}else{
			$msg+=2;
			//MSK-000143-U-11 Connection problem
		}
		
	}

$res=array($grade1,$subject1,$teacher1,$fee1,$msg);
echo json_encode($res);//MSK-000143-U-12


?>