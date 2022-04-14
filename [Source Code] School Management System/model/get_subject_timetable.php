<?php

include_once('../controller/config.php');
$index=$_GET['index'];
$grade_id=$_GET['grade'];

$sql1="SELECT * FROM teacher WHERE index_number='$index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['id'];

$sql="select subject_routing.subject_id as s_id,subject.name as s_name
      from subject_routing
      inner join subject
      on subject_routing.subject_id=subject.id 
      where subject_routing.grade_id=$grade_id and subject_routing.teacher_id=$id";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
			
?>
        <option value="<?php echo $row["s_id"]; ?>"><?php echo $row['s_name']; ?></option><!--MSK-000122-->
<?php } } ?>