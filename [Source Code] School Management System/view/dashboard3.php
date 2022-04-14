<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_parents.php'); ?>
<?php include_once('sidebar3.php'); ?>
<?php include_once('alert.php'); ?>

<style>

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
}


.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.5s;
    animation-name: animatetop;
    animation-duration: 0.5s;
	

}

.modal-content1 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: 25%; 
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

.cal-table{
	
width:100%;
padding:0;
margin:0;	
}

#calendar_dates{
	padding:10px;
	margin-left:10px;
	width:95%;	
	
}

.tHead{
	
	height:40px;
	background-color:#8e1c82;
	color:#FFF;
	text-align:center;
	border:1px solid #FFF;
	width:70px;
}

.cal-tr{
	height:50px;
	
}

.td_no_number{
	border:1px solid white;
	width:70px;
	background-color:#979045;
	padding:0;
}



.cal-number-td{
	border:1px solid white;
	width:70px;
	background-color:#677be2;
	color:white;
	
		
}


.h5{
	color:#FFF;
	display: inline-block;
	background:#636;
	width:15px;
	height:15px;	
	font-size:11px;
	font-weight:bold;
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	text-align:center;
	float:right;
	padding-top:1px;
	margin-bottom:50%;
	
}
.div-event-c{
	margin-top:65%;
	height:17px;
	
}

#cal_month{
	width:20%;
	border-radius:5%;
	
	padding:0;
}
#cal_year{
	width:15%;
	border-radius:5%;
	margin-left:5px;
	padding:0;
}

#btnShow{
	
	margin-left:5px;
	
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Dashboard
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
    	</ol>
	</section>
    
<?php
include_once('../controller/config.php');

$my_index= $_SESSION["index_number"];

$sql1="SELECT * FROM parents WHERE index_number='$my_index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$my_son_index=$row1['my_son_index'];
$name=$row1['i_name'];

?>    
	
     <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
            	<span class="info-box-text">Total Student</span>
<?php
include_once('../controller/config.php');

$sql1="SELECT count(id) FROM student WHERE _status=''";
$total_count1=0;

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$total_count1=$row1['count(id)'];

?>               
            	<span class="info-box-number"><?php echo $total_count1; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
            	<span class="info-box-text">Total Teacher</span>
<?php
include_once('../controller/config.php');

$sql2="SELECT count(id) FROM teacher";
$total_count2=0;

$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$total_count2=$row2['count(id)'];

?> 
              	<span class="info-box-number"><?php echo $total_count2; ?></span>
            </div>

            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Monthly Fee</span>
<?php
include_once('../controller/config.php');
$my_index= $_SESSION["index_number"];
$current_year=date('Y'); 
$current_month=date('F'); 
$monthly_fee=0;

$sql1="SELECT * FROM parents WHERE index_number='$my_index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$my_son_index=$row1['my_son_index'];

$sql="select subject_routing.fee as s_fee 
      from student_subject
	  inner join subject_routing
	  on student_subject.sr_id=subject_routing.id 
      where student_subject.index_number='$my_son_index' and year='$current_year'";

$result=mysqli_query($conn,$sql);
    
if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_assoc($result)){
        
		$monthly_fee+=$row['s_fee'];
		$monthly_fee = number_format($monthly_fee, 2, '.', '');
	}
	
}

?>  
              <span class="info-box-number"><small>$</small><?php echo $monthly_fee ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My Son's Total Paid</span>
<?php
include_once('../controller/config.php');
$my_index= $_SESSION["index_number"];

$sql1="SELECT * FROM parents WHERE index_number='$my_index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$my_son_index=$row1['my_son_index'];

$sql3="SELECT SUM(paid) FROM student_payment WHERE index_number='$my_son_index'";
$total_paid=0;

$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_assoc($result3);
$total_paid=$row3['SUM(paid)'];

?>              
              <span class="info-box-number"><small>$</small><?php echo $total_paid; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
     <h5><?php echo $name; ?>,<strong><span style="color:#cf4ed4;"> Welcome back! </span></strong></h5>
     
     <div class="row" id="table1"><!--MSK-000132-1-->    
        	<div class="col-md-8">
           		<center><h4 class="box-title">My Son's Monthly Attendance</h4></center>
                <canvas id="barChart" width="800" height="438"></canvas>
  			</div>

<script>

function showBarChart(monthly_attendance){	
 
	var monthly_attendance1 = JSON.parse("[" + monthly_attendance + "]");

	new Chart(document.getElementById("barChart"), {
		type: 'bar',
		data: {
			
		   labels: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
		  datasets: [
			{
			  label: "Monthly Attendants",
			  backgroundColor: ["#e80a68", "#d74340","#8e3d87","#40b9d7","#26ab8d","#7e5c3e", "#3e447e","#638e3d","#766677","#f35df8","#e49e23","#f68b98"],
			  data: monthly_attendance1
				//data: [12, 19, 3, 5, 10, 3,12, 19, 10, 5, 10, 15],
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});

};
</script>

<?php
include_once('../controller/config.php');
$current_year=date("Y");
$prefix="";
$monthly_attendance="";

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

for($i=0; $i<count($month); $i++){
	$sql="SELECT COUNT(id) FROM student_attendance WHERE year='$current_year' AND month='$month[$i]' AND index_number='$my_son_index' AND _status1='intime'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	$monthly_attendance.=$prefix.'"'.$row['COUNT(id)'].'"';
	$prefix=',';
	
}

echo "<script>showBarChart('$monthly_attendance');</script>";

?>            
          
        	<div class="col-md-4">
                <div id="calendar-container">
                	<div id="calendar-header">
                    	<center><h4><span id="calendar_month_year"></span> <?php echo $current_year; ?> </h4></center>
        			</div>
                    <input type="hidden" id="my_index" value="<?php echo $my_index; ?>">  
                    <input type="hidden" id="my_type" value="<?php echo $my_type; ?>">                         
                 </div>
                 <div class="row1" id="row">
                        
                 </div>
       		</div>
        </div>  
	
    <div id="cEvent">
    
    </div>  
    
<script>

var m2 = 0;

function ShowEvents(status,my_index,my_type){
	
	var d = new Date();    //new Date('2017','08','25');
	var month_name = ['January','February','March','April','May','June','July','August','September','Octomber','November','December'];	
		
	var m1 = d.getMonth(); //0-11
	var y1 = d.getFullYear(); //2017
	
	var current_date = d.getDate();
		
	if(status == 'K'){
		var m3 = m1;
	}
		
	if(status == 'N'){
		m2++;
		var m3 = m1 + m2;
	}
				
	if(status == 'P'){
		m2--;
		var m3 = m1 + m2;
	}
				
	if(m3 == 0){
		$('#btn1').css('pointer-events', 'none');
	}
				
	if(m3 == 11){
		$('#btn2').css('pointer-events', 'none');
	}
		
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200){
					//MSK-00107 
				document.getElementById('row').innerHTML = this.responseText;//MSK-000132
				
				var start_date = $('#start_date').val().split(',');
				var end_date = $('#end_date').val().split(',');
				var color = $('#color').val().split(',');
				var event_id = $('#event_id').val().split(',');
			
				var month = m3; //0-11
				var year = y1; //2017 
				var first_date = month_name[month] + " " + 1 + " " + year;
				
				var tmp = new Date(first_date).toDateString();
				// Tue Aug 01 2017...
				
				var first_day = tmp.substring(0,3); //Thu
				var day_name = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
				var day_no = day_name.indexOf(first_day);  //4
				var days = new Date(year, month+1, 0).getDate(); //31
				// Thu Aug 31 2017...
				
				var calendar = get_calendar(day_no,days);
				
				document.getElementById("calendar_month_year").innerHTML = month_name[month];
				document.getElementById("calendar_dates").appendChild(calendar);
				$("#td_"+current_date).css("background-color", "#319a5b");
				var count1 = start_date.length;
				var k=0;
				for(var i=0; i<count1; i++){
					var s_date = parseInt(start_date[i], 10);
					var e_date = parseInt(end_date[i], 10);
					
					var count = e_date - s_date;
				
					for(var j=0; j<=count; j++){
					
						k = s_date+j;
						
						$("#td_"+k).append('<div class="div-event-c" style="background-color:'+color[i]+'"><a id="event_"+'+[i]+' style="color:white;" href="#" onclick="showEvent('+event_id[i]+')"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>');
													
					}
					
					
				}

			}
				
		};	
		
		xhttp.open("GET", "all_events1.php?year=" + y1 + "&month="+m3 + "&my_type="+my_type + "&my_index="+my_index , true);	
		xhttp.send();//MSK-00105-Ajax End
		
						
};

</script>

	<div id="showEvent">
    
    </div>
    
<script>

function showEvent(event_id){
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('showEvent').innerHTML = this.responseText;//MSK-000132
				$('#modalviewEvent').modal('show');
			}
				
		};	
		
		xhttp.open("GET", "show_events1.php?event_id="+event_id , true);												
		xhttp.send();//MSK-00105-Ajax End
};

function get_calendar(day_no,days){
	
	var table = document.createElement('table');
	var tr = document.createElement('tr');
	
	table.className = 'cal-table';
	
	// row for the day letters
	for(var c=0; c<=6; c++){
		var th = document.createElement('th');
		th.innerHTML =  ['S','M','T','W','T','F','S'][c];
		tr.appendChild(th);
		th.className = "tHead";
		
		
	}
	
	table.appendChild(tr);
	
	//create 2nd row
	
	tr = document.createElement('tr');
	
	var c;
	for(c=0; c<=6; c++){
		
		if(c== day_no){
			break;
		}
		var td = document.createElement('td');
		td.innerHTML = "";
		tr.appendChild(td);
		td.className = "td_no_number";
		tr.className = 'cal-tr';
	}
	
	var count = 1;
	for(; c<=6; c++){
		var td = document.createElement('td');
		td.id = "td_"+count;
		td.className = 'cal-number-td';
		tr.appendChild(td);
		tr.className = 'cal-tr';
		
		var h5 = document.createElement('h5');
		h5.className = 'h5';
		td.appendChild(h5);
		h5.innerHTML = count;
		count++;
		
		
	}
	table.appendChild(tr);
	
	//rest of the date rows
	
	for(var r=3; r<=7; r++){
		tr = document.createElement('tr');
		for(var c=0; c<=6; c++){
			
			if(count > days){
				for(; c<=6; c++){
		
					var td = document.createElement('td');
					td.innerHTML = "";
					tr.appendChild(td);
					td.className = "td_no_number";
					tr.className = 'cal-tr';
				}
				table.appendChild(tr);
				return table;
			}
			
			var td = document.createElement('td');
			//td.innerHTML = count;
			td.id = "td_"+count;
			//td.style.padding = 0;
			td.className = 'cal-number-td';
			
			tr.appendChild(td);
			
			var h5 = document.createElement('h5');
			h5.className = 'h5';
			td.appendChild(h5);
			h5.innerHTML = count;
			count++;
			tr.className = 'cal-tr';
			
		}
		table.appendChild(tr);
		
		
	}
	
	
	
};	
</script>
    

<?php 

$my_index=$_SESSION['index_number'];
$my_type=$_SESSION['type'];

echo '<script>','ShowEvents("K","'.$my_index.'","'.$my_type.'");','</script>';

?>
<br>

       <div class="row" >
            <div class="col-md-9" ><!-- left column -->
                <center><h4>My Son's Exam Marks</h4></center>
                <canvas id="lineChart" width="800" height="450"></canvas>
             </div>  
         </div>

<script>
                    
function showLineChart(subject,term1,term2,term3){	

	var subject1 = JSON.parse("[" + subject + "]");
	var terms1 = JSON.parse("[" + term1 + "]");
	var terms2 = JSON.parse("[" + term2 + "]");
	var terms3 = JSON.parse("[" + term3 + "]");

	new Chart(document.getElementById("lineChart"), {
		type: 'line',
		data: {
		  //labels: ["January", "February", "March"],
		  labels: subject1,
		  datasets: [
			{
			  label: "Term 1",
			  borderColor: "#00c0ef",
			  fill: false,
			  data: terms1
			 
			}, {
			  label: "Term 2",
			  borderColor: "#ec00ef",
			  fill: false,
			  data: terms2
			 
			}, {
			  label: "Term 3",
			  borderColor: "#17ef00",
			  fill: false,
			  data: terms3
			 
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});

};

</script>

<?php
include_once('../controller/config.php');
$index=$_SESSION["index_number"];
$year=date("Y");
        
$prefix="";

$subject='';
$marks='';
$mark_range='';
$mark_grade='';

 $term2="";
 
 $prefix1="";
 $prefix2="";
 $prefix3="";
 
 $terms1="";
 $terms2="";
 $terms3="";   
 $g=0; 
 
$sql2="SELECT * FROM parents WHERE index_number='$index'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$my_son_index=$row2['my_son_index'];
 
$sql="SELECT * FROM exam";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
while($row=mysqli_fetch_assoc($result)){
	$id=$row['id'];
	
	$sql1="select subject.name as s_name,student_exam.marks as e_marks
	       from student_exam 
		   inner join subject
		   on student_exam.subject_id=subject.id
		   where student_exam.exam_id='$id' and student_exam.index_number='$my_son_index' and year='$year'";
	
	$result1=mysqli_query($conn,$sql1);
	
	$fail=false;
	while($row1=mysqli_fetch_assoc($result1)){
		
		$term2.=$prefix1.'"'.$row1['e_marks'].'"';
		$prefix1=',';
			
		$subject.=$prefix2.'"'.$row1['s_name'].'"';
		$prefix2=',';
			
		$g++;
		
		$fail=true;
	}
		   
	$term2.="k";
	$subject.="k";
	
}
	$o=$term2;
	$o=explode("k",$term2);
	$p=explode("k",$subject);
	
	$terms1=$o[0];
	$terms2=$o[1];
	$terms2 = substr($terms2, 1);
	$terms3=$o[2]; 
	$terms3 = substr($terms3, 1);
	$subject=$p[0];
	
}
echo "<script>showLineChart('$subject','$terms1','$terms2','$terms3');</script>";

?>
		<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-12">
            	<center><h4 class="box-title">My Son's Timetable</h4></center>
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead style="color:white; background-color:#666;">
                                <th class="col-md-1">Time</th>
                                <th class="col-md-1">Sunday</th>
                                <th class="col-md-1">Monday</th>
                                <th class="col-md-1">Tuesday</th>
                                <th class="col-md-1">Wednesday</th>
                                <th class="col-md-1">Thursday</th>
                                <th class="col-md-1">Friday</th>
                                <th class="col-md-1">Saturday</th>
                             </thead>
                             <tbody>
                                
<?php
include_once('../controller/config.php');
            
$index=$_SESSION["index_number"];
$current_year=date('Y');
            
$sql1="SELECT * FROM student_grade WHERE index_number='$my_son_index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$grade=$row1['grade_id'];
            
$sql2="select  subject_routing.grade_id as g_id,subject_routing.subject_id as s_id,subject_routing.teacher_id as t_id
       from student_subject
       inner join subject_routing
       on student_subject.sr_id=subject_routing.id
       where student_subject.index_number='$my_son_index' and student_subject.year='$current_year'";
	   
$result2=mysqli_query($conn,$sql2);
while($row2=mysqli_fetch_assoc($result2)){
                
	$g_id=$row2['g_id'];
    $s_id=$row2['s_id'];
    $t_id=$row2['t_id'];
                
    $sql3="SELECT 
           DISTINCT start_time,end_time
           FROM
              timetable
           WHERE
              grade_id='$g_id' AND subject_id='$s_id' AND teacher_id='$t_id'  
           ORDER BY
              start_time";
                
    $result3=mysqli_query($conn,$sql3);
    while($row3=mysqli_fetch_assoc($result3)){
                    
		$s_time=$row3['start_time'];
        $e_time=$row3['end_time'];
                    
?>    
                                <tr>
                                    <th  style="color:white; background-color:#666;">
                                        <?php echo $s_time." - ".$e_time; ?>		
                                    </th>
                                    <td bgcolor="#d74340" style="color:white;">
<?php 
include_once('../controller/config.php');
            
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.grade_id='$g_id' and timetable.subject_id='$s_id' and timetable.teacher_id='$t_id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Sunday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 1#
	while($row=mysqli_fetch_assoc($result)){ // while loop 1#
                    
?>    	
                                  
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        
<?php }} ?>
                
                                    </td>
                                    <td bgcolor="#d7cb40" style="color:white;">
<?php 
include_once('../controller/config.php');
                
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.grade_id='$g_id' and timetable.subject_id='$s_id' and timetable.teacher_id='$t_id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Monday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 2#
	while($row=mysqli_fetch_assoc($result)){ // while loop 2#
	
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        
<?php } }?>
                                    </td>
                                    <td bgcolor="#40b9d7" style="color:white;">
<?php 
include_once('../controller/config.php');
                
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.grade_id='$g_id' and timetable.subject_id='$s_id' and timetable.teacher_id='$t_id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Tuesday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 3#
	while($row=mysqli_fetch_assoc($result)){ // while loop 3#
            
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        
<?php  } } ?>
                                    </td>
                                    <td bgcolor="#f39037" style="color:white;">
<?php 
include_once('../controller/config.php');
                
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.grade_id='$g_id' and timetable.subject_id='$s_id' and timetable.teacher_id='$t_id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Wednesday'";
	  
$result=mysqli_query($conn,$sql);                  
if (mysqli_num_rows($result) > 0) { // 4#
	while($row=mysqli_fetch_assoc($result)){ // while loop 4# 

?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        
<?php } }?>
                                    </td>
                                    <td bgcolor="#7e5c3e" style="color:white;">
									
<?php 
include_once('../controller/config.php');
                
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.grade_id='$g_id' and timetable.subject_id='$s_id' and timetable.teacher_id='$t_id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Thursday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { //5#
	while($row=mysqli_fetch_assoc($result)){ // while loop 5#
            
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                       
                                    
<?php } } ?>
                                    </td>
                                    <td bgcolor="#3e447e" style="color:white;">
<?php 
include_once('../controller/config.php');
                
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.grade_id='$g_id' and timetable.subject_id='$s_id' and timetable.teacher_id='$t_id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Friday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 6#
	while($row=mysqli_fetch_assoc($result)){// while loop 6#
            
?>    	
                                    
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        
<?php  } }?>
                                    </td>
                                    <td bgcolor="#638e3d" style="color:white;">
<?php 
include_once('../controller/config.php');
                
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.grade_id='$g_id' and timetable.subject_id='$s_id' and timetable.teacher_id='$t_id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Saturday'";
                 
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 7#
	while($row=mysqli_fetch_assoc($result)){ // while loop 7#
                
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        
<?php } } ?>
                                    </td>
          						
                                    
                                </tr>
<?php  } }  ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->	
                </div><!-- /.box -->
            </div><!-- /.col-md-10 -->
        </div><!-- /.row -->
<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>

</div><!-- /.content-wrapper -->    
<?php include_once('footer.php'); ?>