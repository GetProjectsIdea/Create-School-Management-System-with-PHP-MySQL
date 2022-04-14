<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>

<style>

body { 
	overflow-y:scroll;
}

.msk-modal-content {
	
   position: absolute;
   left: 125px; 
}


.modal-content1 {
	
   position: absolute;
   left: 125px; 
   
}

@media only screen and (max-width: 500px) {

	.modal-content1 {
   		
		position:static;
   
	}
}

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
}
.set-color-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
	 background-color:red;
}
.image-error{
	border:1px solid #f44336;
	
}

.image-success{
	border:1px solid #009900;
	
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}

body.modal-open-noscroll1
{
    overflow:hidden;
	
 
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
	width:25px;
	height:25px;	
	font-size:14px;
	font-weight:bold;
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	text-align:center;
	float:right;
	padding-top:5px;
	margin-bottom:20px;
	
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

.present{
	background-color:#00FF66;
	
}

.absent{
	background-color:#FF0033;
	
}

.not_held{
	background-color:#FFCC33;
	
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Student Attendance
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Exam</a></li>
            <li><a href="#">Student Attendance History</a></li>
        </ol>
	</section>

	<!-- Main content -->
    <section class="content">
    	<div class="row">
        	<!-- left column -->
            <div class="col-md-5">
            	<!-- general form elements -->
              	<div class="box box-primary">
                	<div class="box-header with-border">
                  		<h3 class="box-title">Student Attendance History</h3>
                	</div><!-- /.box-header -->
                  	<div class="box-body">
                        <div class="form-group" id="divYear">
                            <div class="col-md-3">
                        		<label>Year</label>
                     		</div>
                        	<div class="col-md-7" id="divYear1">
                                <select name="year" class="form-control" id="year" style="width:105%;" ><!--MSK-000107-->
                                    <option>Select Year</option>
<?php
include_once('../controller/config.php');

    
$sql="SELECT 
      DISTINCT year
      FROM
         student_attendance
      ORDER BY
         year";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                                    <option value="<?php echo $row["year"]; ?>"><?php echo $row['year']; ?></option>
<?php }} ?>
                                </select>
                     		</div>
                    	</div> 
                        <br><br>
                        <div class="form-group" id="divGrade">
                        	<div class="col-md-3">
                        		<label>Grade</label>
                     		</div>
                        	<div class="col-md-7" id="divGrade1">
                                <select name="grade" class="form-control" id="grade" style="width:105%;" ><!--MSK-000107-->
                                    <option>Select Grade</option>
<?php
include_once('../controller/config.php');
$index=$_SESSION["index_number"];
$current_year=date('Y');
    
$sql="SELECT * FROM grade";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                                    <option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>
                                </select>
                     		</div>
                    	</div>   
                    	<br><br>
                         <div class="form-group " id="divMonth">
                            <div class="col-md-3">
                                <label>Month</label>
                            </div>
                        	<div class="col-md-7" id="divMonth1">
                                <select name="month" class="form-control " id="month" style="width:105%;"><!--MSK-000107-->
                                    <option>Select Month</option>
                                    <option value="0">January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                    <option value="4">May</option>
                                    <option value="5">June</option>
                                    <option value="6">July</option>
                                    <option value="7">August</option>
                                    <option value="8">September</option>
                                    <option value="9">October</option>
                                    <option value="10">November</option>
                                    <option value="11">December</option>
                                </select>
                     		</div>
                    	</div>   
                  	</div><!-- /.box-body -->
                  	<div class="box-footer">
	                  	<input type="hidden" id="my_index" value="<?php echo $my_index; ?>">
                    	<button type="button" id="btnSubmit" class="btn btn-primary"  onClick="showStudent(this)">Submit</button><!--MSK-000108-->
                  	</div>
            	</div><!-- /.box -->
        	</div>
    	</div>
	</section><!-- End of form section -->

	<!-- table for view all records-->
    <section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000112--> 
           
        </div>
    </section> <!-- End of table section --> 
        
<script>
function showStudent(){
//MSK-000109
	var year = document.getElementById("year").value;
	var month = document.getElementById("month").value;
	var grade = document.getElementById("grade").value;
	
	if(year == 'Select Year'){
		
		$("#btnSubmit").attr("disabled", true);
		$('#divYear').addClass('has-error');
		$('#divYear1').addClass('has-feedback');
		$('#divYear1').append('<span id="spanYear" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The year is required" ></span>');	
					
		$("#year").change(function(){
			
			//MSK-00128-classroom
			$("#btnSubmit").attr("disabled", false);	
			$('#divYear').removeClass('has-error has-feedback');
			$('#spanYear').remove();
						
		});
		
	}
	
	if(month == 'Select Month'){
		
		$("#btnSubmit").attr("disabled", true);
		$('#divMonth').addClass('has-error');
		$('#divMonth1').addClass('has-feedback');
		$('#divMonth1').append('<span id="spanMonth" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The month is required" ></span>');	
					
		$("#month").change(function(){
			
			//MSK-00128-classroom
			$("#btnSubmit").attr("disabled", false);	
			$('#divMonth').removeClass('has-error has-feedback');
			$('#spanMonth').remove();
						
		});
		
	}
	
	if(grade == 'Select Grade'){
		
		$("#btnSubmit").attr("disabled", true);
		$('#divGrade').addClass('has-error');
		$('#divGrade1').addClass('has-feedback');
		$('#divGrade1').append('<span id="spanGrade" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The grade is required" ></span>');	
					
		$("#grade").change(function(){
			
			//MSK-00128-classroom
			$("#btnSubmit").attr("disabled", false);	
			$('#divGrade').removeClass('has-error has-feedback');
			$('#spanGrade').remove();
						
		});
		
	}
	
	if(year == 'Select Year' || month == 'Select Month' || grade == 'Select Grade'){
	
	}else{
		var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table1').innerHTML = this.responseText;//MSK-000111
				
				$(function () {
					$("#example1").DataTable();
				});
												
    		}
			
  		};
			
    	xhttp.open("GET", "show_student2.php?year="+year  +  "&grade="+grade +  "&month="+month, true);												
  		xhttp.send();//MSK-000110-End Ajax
		
	}
		
};

</script>

	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table2"><!--MSK-000112--> 
           
        </div>
    </section> <!-- End of table section --> 
    
    <div id="stdProfile">
    
    </div>


<script>

function studentProfile(std_index){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
		xhttp.onreadystatechange = function() {
																	
			if (this.readyState == 4 && this.status == 200) {
																		
				document.getElementById('stdProfile').innerHTML = this.responseText;
				$('#modalviewStudent').modal('show');														
			}
		};
																
		xhttp.open("GET", "student_profile.php?std_index=" + std_index , true);												
		xhttp.send();	
	
	
};

function show_calendar(year1,month1){
	
	var status = $('#status5').val().split(',');
	var date_no2 = $('#date_no2').val().split(',');
	
	var y1 = Number(year1);
	var m1 = Number(month1);
	
	var count5 = date_no2.length;
	
	var d = new Date();    //new Date('2017','08','25');
	var month_name = ['January','February','March','April','May','June','July','August','September','Octomber','November','December'];	
		
	var month = m1; //0-11
	var year = y1; //2017 
	var first_date = month_name[month] + " " + 1 + " " + year;
		
	// August 31 2017
		
	var tmp = new Date(first_date).toDateString();
	// Tue Aug 01 2017...
		
	var first_day = tmp.substring(0,3); //Thu
	var day_name = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
	var day_no = day_name.indexOf(first_day);  //4
	var days = new Date(year, month+1, 0).getDate(); //31
	// Thu Aug 31 2017...
		
	var calendar = get_calendar(day_no,days);
		
	document.getElementById("calendar_month_year").innerHTML = month_name[month]+" "+year;
	document.getElementById("calendar_dates").appendChild(calendar);
			
	for(var i=0; i<count5; i++){
		
		var d_no = parseInt(date_no2[i], 10);
			
		if(status[i] == 'Present'){
			$("#td_"+d_no).css("background-color", "#00FF66");
		}
			
		if(status[i] == 'Absent'){
			$("#td_"+d_no).css("background-color", "#FF0033");
		}
	
	}
				
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
		h5.id="h5_"+count;
		h5.className = 'h5';
		td.appendChild(h5);
		h5.innerHTML = count;
		count++;
		
	}
	table.appendChild(tr);
	
	//rest of the date rows
	;
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
			td.id = "td_"+count;
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

function showAttendance(year,month,index){
	
	var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table2').innerHTML = this.responseText;//MSK-000111
				$(function () {
					$("#example3").DataTable();
				});
				show_calendar(year,month);
				window.scrollTo(0,document.body.scrollHeight);
				
				
    		}
			
  		};
			
    	xhttp.open("GET", "student_attendance_history1.php?year="+year +  "&month="+month +  "&index="+index, true);												
  		xhttp.send();//MSK-000110-End Ajax
};

function showBarChart(subject,marks){
	
 	$("#barChart").show();	
 	$("#lineChart").hide();
 	$("#pieChart").hide();
 	$("#doughnutChart").hide();
 
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("barChart"), {
		type: 'bar',
		data: {
		  labels: subject1,
		  datasets: [
			{
			  label: "Number of Days",
			  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			  data: marks1
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

function showLineChart(subject,marks){
	
	 $("#lineChart").show();	
	 $("#barChart").hide();
	 $("#pieChart").hide();
	 $("#doughnutChart").hide();
 
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("lineChart"), {
		type: 'line',
		data: {
		  labels: subject1,
		  datasets: [
			{
			  label: "Number of Days",
			  borderColor: "#3e95cd",
			  fill: false,
			  data: marks1
			 
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

function showPieChart(subject,marks){
	
	$("#pieChart").show();	
 	$("#barChart").hide();
 	$("#lineChart").hide();
 	$("#doughnutChart").hide();
	
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("pieChart"), {
		type: 'pie',
		data: {
		  labels: subject1,
		  datasets: [{
			label: "Population (millions)",
			backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			data: marks1
		  }]
		},
		options: {
		  title: {
			display: true,
			text: ''
		  }
		}
	});
	
};

function showDoughnutChart(subject,marks){

	$("#doughnutChart").show();	
 	$("#barChart").hide();
 	$("#lineChart").hide();
 	$("#pieChart").hide();
	
	var subject1 = JSON.parse("[" + subject + "]");
	var marks1 = JSON.parse("[" + marks + "]");

	new Chart(document.getElementById("doughnutChart"), {
		type: 'doughnut',
		data: {
		  labels: subject1,
		  datasets: [
			{
			  label: "Population (millions)",
			  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			  data: marks1
			}
		  ]
		},
		options: {
		  title: {
			display: true,
			text: ''
		  }
		}
	});

};

</script>

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
                          
<?php include_once('footer.php');?>