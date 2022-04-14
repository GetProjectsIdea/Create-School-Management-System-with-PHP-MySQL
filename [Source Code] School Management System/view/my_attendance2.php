
<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?><?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>

<style>

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
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
        	Attendance
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Attendance</a></li>
            <li><a href="#">My Attendance</a></li>
    	</ol>
	</section>
    
<script>

var current_day_no;
var status;
var calendar_month_year;

function show_calendar(){
	
	var status = $('#status5').val().split(',');
	var date_no2 = $('#date_no2').val().split(',');
	var count5 = date_no2.length;
	
		var d = new Date();    //new Date('2017','08','25');
		var month_name = ['January','February','March','April','May','June','July','August','September','Octomber','November','December'];	
		
		
		var month = d.getMonth(); //0-11
		var year = d.getFullYear(); //2017 
		var current_date = d.getDate();
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
				
}


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
    
    <!-- table for view all records -->     
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->    
            <div class="col-md-12">
            	<div class="box">
                	<div class="box-header">
                    	<h3 class="box-title">My Attendance in this Month</h3>
                	</div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                         <div class="row">
                            <div class=" col-md-7">
                                  
                                <table id="example1" class="table table-bordered table-striped">
                                	<thead>
                                    	<th class="col-md-1">ID</th>
                                        <th class="col-md-2">Date</th>
                                        <th class="col-md-1">Month</th>
                                        <th class="col-md-1">Year</th>
                                        <th class="col-md-1">Status</th>
                                        <th class="col-md-1">Intime</th>
                                        <th class="col-md-1">Outtime</th>
                                    </thead>
                                   	<tbody>
<?php
include_once('../controller/config.php');
$index=$_SESSION["index_number"];

$current_year=date('Y');
$current_month=date('F');

$prefix="";
$prefix1="";
$status5="";
$date_no2="";
$sql="select * from teacher_attendance where index_number='$index' and (_status1='intime' or _status1='') and year='$current_year' and month='$current_month'";

$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
		$status1=$row['_status1'];
		$status2=$row['_status2'];
		$date=$row['date'];
		
		$date_no =(explode('-',$date,4));
		$date_no1 =$date_no[2];
		
		$intime=$row['time'];
		
		if($status1='intime'){
			$sql2="select * from teacher_attendance where index_number='$index' and _status1='outtime' and date='$date'";
			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($result2);
			$outtime=$row2['time'];
		}
		if($status2=='Absent'){
			$intime="A";
			$outtime="A";
		}
		
		if($status2=='Present'){
			
		}
		
		$status5.=$prefix.$status2;
		$prefix=',';
		
		$date_no2.=$prefix1.$date_no1;
		$prefix1=',';
					
?>   
                                    	<tr>
                                            <td><?php echo $count; ?></td>
                                            
                                            <td id="td_date_<?php echo $count; ?>"><?php echo $date; ?></td>
                       <!--MSK-000115-td2--><td id="td_month_<?php echo $count; ?>"><?php echo $row['month']; ?></td>
                       <!--MSK-000115-td1--><td id="td_year_<?php echo $count; ?>"><?php echo $row['year']; ?></td>
                       <!--MSK-000115-td3--><td id="td_status_<?php echo $count; ?>"><?php echo $row['_status2']; ?></td>
                       <!--MSK-000115-td4--><td id="td_paid_<?php echo $count; ?>"><?php echo $intime; ?></td>
                                            <td id="td_date_<?php echo $count; ?>"><?php echo $outtime; ?></td>
                                        
                                    	</tr>
<?php } ?>
                        			</tbody>
                    			</table>
                        	</div>
                            <div id="calendar-container" class="col-md-5">
                                <div id="calendar-header">
                                    <center><h3><span id="calendar_month_year"></span></h3></center>
                                </div>
                                <div id="calendar_dates">
                                <input type="hidden" id="date_no2" value="<?php echo $date_no2; ?>">
                                <input type="hidden" id="status5" value="<?php echo $status5; ?>">  
                            	</div><br><br>
                             
                            <div style="float:left; width:100px; ">
                                	<div style="background-color:#FF0033; width:15px; height:15px; float:left; margin-right:2px;"> </div> <span style="text-align:left;">  - Absent </span><br> 
                                    <div style="background-color:#00FF66; width:15px; height:15px; float:left; margin-right:2px;"> </div> <span style="text-align:left;">  - Present </span><br> 
                                    <div style="background-color:#FFCC33; width:15px; height:15px; float:left; margin-right:2px;"> </div> <span style="text-align:left;">  - Not Held  </span><br> 
                            </div>
<?php  }echo '<script>','show_calendar()','</script>'; ?>                            
                    	</div>
                	</div><!-- /.box-body -->           
            	</div><!-- /.box-->
        	</div> 
		</div>
	</section>   
     
</div><!-- /.content-wrapper -->  

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
              
<?php include_once('footer.php');?>