<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<table id="table_student_exam" class="table">
	<thead>
    	<th>Subject</th>
        <th>Marks</th>
        <th>Action</th>
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

	$sql1="select subject.name as s_name,student_exam.id as ex_id,student_exam.marks as ex_mark
		   from student_exam 
		   inner join subject
		   on student_exam.subject_id=subject.id
		   where student_exam.index_number='$index_number' and student_exam.exam_id='$exam' and student_exam.year='$current_year'";	  
	
	$result1=mysqli_query($conn,$sql1);
	$count=0;
	while($row1=mysqli_fetch_assoc($result1)){
	
		$count++;
?>			
		<tr id="tr_<?php echo $count; ?>">
        	<input type="hidden" name="subject_id[]" id="eSubject_id_<?php echo $count; ?>" value="<?php echo $row1['s_id']; ?>">
            <input type="hidden" name="grade" value="<?php echo $grade_id; ?>"/>
        	<td id="eSubject_td_<?php echo $count; ?>"><?php echo $row1['s_name']; ?></td>
            <td id="eMark_td_<?php echo $count; ?>"><?php echo $row1['ex_mark']; ?></td>
            <td id="action_<?php echo $count; ?>">
            	<a href="#" id="edit_exam_mark_<?php echo $count; ?>" onClick="editExamMark('<?php echo $row1['ex_id']; ?>','<?php echo $count; ?>')" data-id="<?php echo $row['id']; ?>,<?php echo $count; ?>" class="label-warning "><span class="glyphicon glyphicon-edit "></span></a><!-- MSK-00094--> 
            </td>
        </tr>

<?php	} ?>
	</tbody>
</table>