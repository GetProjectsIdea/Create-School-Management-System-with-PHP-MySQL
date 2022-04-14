<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-md-12">
	<div class="box">
    	<div class="box-header">
<?php
include_once('../controller/config.php');

$exam=$_GET['exam'];
$year=$_GET['year'];
	
$sql="SELECT * FROM exam WHERE id='$exam'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['name'];

?>          
        	<center><h2 class="box-title"><?php echo $year; ?> - <?php echo $name; ?> Exam</h2></center>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
             <div class="row">
        		<div class=" col-md-5">
                       <h4 class="box-title">Exam Marks </h4><br>  
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th width="1">ID</th>
                            <th width="120">Subject</th>
                            <th width="100">Marks</th>
                            <th width="100">Grade</th>
                        </thead>
                        <tbody>
<?php
include_once('../controller/config.php');
$index=$_GET['index'];
$exam=$_GET['exam'];
$year=$_GET['year'];
        
$prefix="";
$prefix1="";
$subject='';
$marks='';
$mark_range='';
$mark_grade='';
        
$sql1="SELECT * FROM student_grade WHERE index_number='$index' and year='$year'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['grade_id'];
		
$sql="select subject.name as s_name,student_exam.marks as se_marks 
      from student_exam 
      inner join subject
      on student_exam.subject_id=subject.id
      where student_exam.index_number='$index' and student_exam.exam_id='$exam' and student_exam.year='$year'";
                  
$result=mysqli_query($conn,$sql);
$count=0;
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		$count++;
				 
$subject.=$prefix.'"'. $row['s_name'].'"';
$prefix=',';

$marks.=$prefix1.'"'.$row['se_marks'].'"'; 
$prefix1=',';

$marks1=$row['se_marks'];
                
$sql2="SELECT * FROM exam_range_grade WHERE grade_id='$id' and '$marks1' > _from and '$marks1' <= _to ";
				
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$mark_grade=$row2['mark_grade'];

if($row['se_marks']=="Absent"){
	$mark_grade="Absent";
}
				
?>   
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['s_name']; ?></td>
                                <td><?php echo $row['se_marks']; ?></td>
                                <td><?php echo $mark_grade; ?></td>
                               
                            </tr>
<?php } } ?>
                        </tbody>
                    </table>	
                </div>
        		<div class=" col-md-7">
                	<h4 class="box-title">Graph </h4>
                	

					<div style="" class="text-right">
                        <input type="hidden" id="chartLable" value="<?php echo htmlspecialchars($subject, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" id="chartData" value="<?php echo htmlspecialchars($marks, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="button" class="btn btn-xs bg-blue-active" value="Bar Chart" onClick="showBarChart('<?php echo htmlspecialchars($subject, ENT_QUOTES, 'UTF-8'); ?>','<?php echo htmlspecialchars($marks, ENT_QUOTES, 'UTF-8'); ?>')">
                        <input type="button" class="btn btn-xs bg-lime-active" value="Pie Chart" onClick="showPieChart('<?php echo htmlspecialchars($subject, ENT_QUOTES, 'UTF-8'); ?>','<?php echo htmlspecialchars($marks, ENT_QUOTES, 'UTF-8'); ?>')"> 
                        <input type="button" class="btn btn-xs bg-orange-active" value="Doughnut Chart" onClick="showDoughnutChart('<?php echo htmlspecialchars($subject, ENT_QUOTES, 'UTF-8'); ?>','<?php echo htmlspecialchars($marks, ENT_QUOTES, 'UTF-8'); ?>')">
                        <input type="button" class="btn btn-xs bg-fuchsia" value="Line Chart" onClick="showLineChart('<?php echo htmlspecialchars($subject, ENT_QUOTES, 'UTF-8'); ?>','<?php echo htmlspecialchars($marks, ENT_QUOTES, 'UTF-8'); ?>')">
    					 
                        <canvas id="barChart" width="800" height="450"></canvas>
                        <canvas id="lineChart" width="800" height="450"></canvas>
                        <canvas id="pieChart" width="800" height="450"></canvas>
                        <canvas id="doughnutChart" width="800" height="450"></canvas>
                    </div>
                </div>
        	</div>
     	</div><!-- /.box-body -->           
	</div><!-- /.box-->
</div> 