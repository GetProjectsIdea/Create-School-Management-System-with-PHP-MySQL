<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<table id="table_exam_mark" class="table">
	<thead>
    	<th class="col-md-2">Subject</th>
        <th class="col-md-3">Marks</th>
    </thead>
	<tbody class="tBody">
<?php
include_once('../controller/config.php');
$index_number=$_GET['index'];
$exam=$_GET['exam'];
$current_year=date('Y');

$sql="SELECT * FROM student_grade WHERE index_number='$index_number' and year='$current_year'";	  
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$grade_id=$row['grade_id'];

	$sql1="select subject.name as s_name,subject.id as s_id
	       from exam_timetable
		   inner join subject_routing
		   on exam_timetable.grade_id=subject_routing.grade_id and exam_timetable.subject_id=subject_routing.subject_id
		   inner join student_subject
		   on student_subject.sr_id=subject_routing.id
		   inner join subject
		   on subject_routing.subject_id=subject.id
		   where exam_timetable.grade_id='$grade_id' and subject_routing.grade_id='$grade_id' and student_subject.year='$current_year' and  	student_subject.index_number='$index_number'";	  
	
	$result1=mysqli_query($conn,$sql1);
	$count=0;
	while($row1=mysqli_fetch_assoc($result1)){
	
		$count++;
?>			
		<tr id="tr_<?php echo $count; ?>">
        	<input type="hidden" name="subject_id[]" id="eSubject_id_<?php echo $count; ?>" value="<?php echo $row1['s_id']; ?>">
            <input type="hidden" name="grade" value="<?php echo $grade_id; ?>"/>
        	<td id="eSubject_td_<?php echo $count; ?>"><?php echo $row1['s_name']; ?></td>
            <td id="eMark_td_<?php echo $count; ?>"><input type="text" class="mark-grade form-control" id="eMark_text_<?php echo $count; ?>" name="eMark[]"  placeholder="85" autocomplete="off"/></td>
        </tr>

<?php	} ?>
	</tbody>
</table>