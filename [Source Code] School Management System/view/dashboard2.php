<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>
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
	background-color:#979045 ;
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

$sql="SELECT * FROM teacher WHERE index_number='$my_index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
$id=$row['id'];

?>    
    
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My STUDENT</span>
<?php
include_once('../controller/config.php');

$sql1="SELECT * FROM subject_routing WHERE teacher_id='$id'";
$total_count2=0;
$my_student=0;
$current_year=date("Y");

$result1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_assoc($result1)){
	$sr_id=$row1['id'];
	
	$sql2="SELECT count(id) FROM student_subject WHERE sr_id='$sr_id' AND year='$current_year' AND _status=''";
	
	$result2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_assoc($result2);
	$total_count2=$row2['count(id)'];
	$my_student+=$total_count2;

}

?>   
              <span class="info-box-number"><?php echo $my_student; ?></span>
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
              <span class="info-box-text">All Student</span>
<?php
include_once('../controller/config.php');

$sql1="SELECT count(id) FROM student WHERE _status=''";
$all_student=0;

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$all_student=$row1['count(id)'];

?>             
             
              <span class="info-box-number"><?php echo $all_student; ?></span>
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
              <span class="info-box-text">Monthly Salary</span>
<?php
include_once('../controller/config.php');
    

$current_year=date('Y'); 
$current_month=date('F'); 
$current_total = 0;
$current_total1=0;  
$current_total_salary=0;

$sql="select * from subject_routing where teacher_id='$id'";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_assoc($result)){
        $sr_id=$row['id'];
		$subject_fee=$row['fee'];
		$subject_id=$row['subject_id'];
		$grade_id=$row['grade_id'];
	
		$sql2="SELECT count(index_number)
               FROM student_subject
               WHERE sr_id = '$sr_id' and _status=''";
                
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
		$student_count=$row2['count(index_number)'];
		
		$sql3="SELECT * FROM grade WHERE id ='$grade_id'";
                
        $result3=mysqli_query($conn,$sql3);
        $row3=mysqli_fetch_assoc($result3);
		$hall_charge=$row3['hall_charge'];
		
		$subtotal= $student_count*$subject_fee;
		$subtotal1=$subtotal - ($subtotal*$hall_charge/100);
		$current_total+=$subtotal1;
	
	}
	
}

$sql1="SELECT 
	   DISTINCT index_number
       FROM
  	      student_subject
	   WHERE
  		  _status='leave' and year='2017'  
	   ORDER BY
  		  index_number";

$result1=mysqli_query($conn,$sql1);
if(mysqli_num_rows($result1) > 0){
	while($row1=mysqli_fetch_assoc($result1)){
		
		$index_number=$row1['index_number'];
			
		$sql2="SELECT sum(subtotal)
           	   FROM student_payment_history
               WHERE index_number='$index_number' and teacher_id='$id' and year='$current_year' and month ='$current_month' and _status='Monthly_Fee'";
			
		$result2=mysqli_query($conn,$sql2);
			
		if(mysqli_num_rows($result2) > 0){
			
			$row2=mysqli_fetch_assoc($result2);
			$subtotal1=$row2['sum(subtotal)'];
			$current_total1+=$subtotal1;
				
		}
		
	}		
		
				
}
			
    $current_total_salary=$current_total+$current_total1;
	$current_total_salary = number_format($current_total_salary, 2, '.', '');

?>   
              <span class="info-box-number"><small>$</small><?php echo $current_total_salary;?></span>
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
              <span class="info-box-text">Total Earning</span>
<?php
include_once('../controller/config.php');

$sql3="SELECT SUM(paid) FROM teacher_salary WHERE index_number='$my_index'";
$total_earn=0;

$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_assoc($result3);
$total_earn=$row3['SUM(paid)'];

?>             
                
              <span class="info-box-number"><small>$</small><?php echo $total_earn;?></span>
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
           		<center><h4 class="box-title">Monthly Salary</h4></center>
                <canvas id="barChart" width="800" height="438"></canvas>
  			</div>

<script>

function showBarChart(monthly_salary){	
 
	var monthly_salary1 = JSON.parse("[" + monthly_salary + "]");

	new Chart(document.getElementById("barChart"), {
		type: 'bar',
		data: {
			
		   labels: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
		  datasets: [
			{
			  label: "Monthly Income($)",
			  backgroundColor: ["#e80a68", "#d74340","#8e3d87","#40b9d7","#26ab8d","#7e5c3e", "#3e447e","#638e3d","#766677","#f35df8","#e49e23","#f68b98"],
			  data: monthly_salary1 
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
$monthly_salary1="";

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

for($i=0; $i<count($month); $i++){
	$sql="SELECT SUM(paid) FROM teacher_salary WHERE index_number='$my_index' AND year='$current_year' AND month='$month[$i]'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	$monthly_salary1.=$prefix.'"'.$row['SUM(paid)'].'"';
	$prefix=',';
	
}
echo "<script>showBarChart('$monthly_salary1');</script>";

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
	
	var current_date = d.getDate();
		
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

echo '<script>','ShowEvents("K",'.$my_index.',"'.$my_type.'");','</script>';

?>         

	<div class="row" >
    	<div class="col-md-10" ><!-- left column -->
        	<center><h4>Monthly Student Registration</h4></center>
            
            <canvas id="lineChart" width="800" height="450"></canvas>
         </div>  
     </div>
		
<script>
                    
function showLineChart(monthly_std_reg){	
 
	var monthly_std_reg1 = JSON.parse("[" + monthly_std_reg + "]");
 
	new Chart(document.getElementById("lineChart"), {
		type: 'line',
		data: {
		  labels: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
		  datasets: [
			{
			  label: "New Student Registration",
			  borderColor: "#00c0ef",
			  fill: false,
			  data: monthly_std_reg1
			 
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
$prefix1="";
$monthly_std_reg="";
$sr_id1="";
$count5;

for($j=0; $j<12; $j++){
	$count5[$j]=0;
}

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

$sql1="SELECT * FROM subject_routing WHERE teacher_id='$id'";
$result1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_assoc($result1)){
	
	$sr_id=$row1['id'];
	
	for($i=0; $i<count($month); $i++){
		
		$sql="SELECT COUNT(id) FROM student_subject WHERE year='$current_year' AND reg_month='$month[$i]' AND _status='' AND sr_id='$sr_id'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		$a=$row['COUNT(id)'];
		$a=$a*1;
		$count5[$i]+=$a;
	
	}
	
}
 
	for($k=0; $k<count($month); $k++){
		
		$monthly_std_reg.=$prefix.'"'. $count5[$k].'"'; 
		$prefix=',';
		
	}

echo "<script>showLineChart('$monthly_std_reg');</script>";

?>

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