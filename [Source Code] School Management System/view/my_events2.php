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
	width:97%;	
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
	height:75px;
	
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
	width:20px;
	height:20px;	
	font-size:14px;
	font-weight:bold;
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	text-align:center;
	float:right;
	padding-top:3px;
	margin-bottom:40%;
	
}
.div-event-c{
	margin-top:45%;
	
}

#cal_month{
	width:23%;
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
        	My Events
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">My Events</a></li>
    	</ol>
	</section>
<?php 

$my_index=$_SESSION['index_number'];
$my_type=$_SESSION['type'];


?>   

    
  <!-- table for view all records -->     
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->    
        	<div class="col-md-8">
            	<div class="box">
                    <div id="calendar-container">
                        <div id="calendar-header">
                           	<center><h2> <a href="#" class="" onClick="ShowEvents('P','<?php echo $my_index; ?>','<?php echo $my_type; ?>')" id="btn1">&#8249;</a>
                            <span id="calendar_month_year"></span>
                            <a href="#" class="" onClick="ShowEvents('N','<?php echo $my_index; ?>','<?php echo $my_type; ?>')" id="btn2">&#8250;</a></h2></center>
        				</div>
                        <div class="col-md-4">
                                
						</div>
                        <div class="col-md-7" >
                            <select class="form-control col-md-4 " id="cal_month" ><!--MSK-000107-->
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
                                                       
                            <select class="form-control col-md-3" id="cal_year" ><!--MSK-000107-->
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                            </select> 
                                                       
                           <button type="button" class="btn btn-info btn-md"  id="btnShow" onClick="ShowEvents1(this)">
                                <i class="fa fa-calendar" aria-hidden="true"></i> Show<!--MSK-000138-->
                           </button>
                           <input type="hidden" id="my_index" value="<?php echo $my_index; ?>">  
                           <input type="hidden" id="my_type" value="<?php echo $my_type; ?>">                         
                        </div>
                        <div class="col-md-1">
                        	<a href="#" onClick=" createEvents('<?php echo $my_index; ?>','<?php echo $my_type; ?>')" class="btn btn-sm  bg-orange-active pull-right " data-id="" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Create Event </a><!-- MSK-00094--> 
                        </div>
                        <br><br>
                        <div class="row" id="row">
                        
                        </div>
       				</div>
        		</div>  
        	</div>             
		</div>
	</section>
    
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
		xhttp.open("GET", "event1.php?year=" + y1 + "&month="+m3 + "&my_type="+my_type + "&my_index="+my_index , true);	
		xhttp.send();//MSK-00105-Ajax End
		
};

function ShowEvents1(){
	
	var year = $("#cal_year").val();
	var month = $("#cal_month").val();
	
	var my_index = $("#my_index").val();
	var my_type = $("#my_type").val();
	
	var d = new Date();    //new Date('2017','08','25');
	var month_name = ['January','February','March','April','May','June','July','August','September','Octomber','November','December'];	
		

	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200){
					//MSK-00107 
				document.getElementById('row').innerHTML = this.responseText;//MSK-000132
				
				var start_date = $('#start_date').val().split(',');
				var end_date = $('#end_date').val().split(',');
				var color = $('#color').val().split(',');
				var event_id = $('#event_id').val().split(',');
			
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
		xhttp.open("GET", "event1.php?year=" + year + "&month="+month + "&my_type="+my_type + "&my_index="+my_index , true);	
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
		
		xhttp.open("GET", "show_events.php?event_id="+event_id , true);												
		xhttp.send();//MSK-00105-Ajax End
};

function  createEvents(my_index,my_type){
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
					//MSK-00107 
				document.getElementById('cEvent').innerHTML = this.responseText;//MSK-000132
				
       			$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        		//Date range as a button
				$('#daterange-btn').daterangepicker(
					{
					  ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					  },
					  startDate: moment().subtract(29, 'days'),
					  endDate: moment()
					},
					function (start, end) {
					  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
					}
				);
				
				$('#modalcEvent').modal('show');
				$(".my-colorpicker2").colorpicker();
				
				$("#divGrade").hide();
				var type = $("#type").value;

				$("#category").change(function(){
					var category = this.value;
					if(category == 3 ){
						$("#type").val(1);
						
						$("#type option[value=0]").hide();
						$("#type option[value=2]").hide();
						$("#type option[value=3]").hide();
						$("#divGrade").hide();
					}
					if(category == 1 ){
						
						$("#type option[value=0]").show();
						$("#type option[value=1]").show();
						$("#type option[value=2]").show();
						$("#type option[value=3]").show();
						
					}
					
					if(category == 2 ){
						
						$("#type option[value=0]").show();
						$("#type option[value=1]").show();
						$("#type option[value=2]").show();
						$("#type option[value=3]").show();
						
					}
					
				});
				
				$("#type").change(function(){
					var type = this.value;
					if(type == 3){
						$("#divGrade").show();
						
					}else{
						$("#divGrade").hide();
					}
				});
				
				
				
			}
				
		};	
			
		xhttp.open("GET", "create_events.php?my_type=" + my_type + "&my_index="+my_index, true);												
		xhttp.send();//MSK-00105-Ajax End
	
	
}

function get_calendar(day_no,days){
	
	var table = document.createElement('table');
	var tr = document.createElement('tr');
	
	table.className = 'cal-table';
	
	// row for the day letters
	for(var c=0; c<=6; c++){
		var th = document.createElement('th');
		th.innerHTML =  ['Sunday','Monday','Tuesday','Wednesday','Thuresday','Friday','Saturday'][c];
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

<div class="modal msk-fade" id="modaluEvent" tabindex="-1" role="dialog" aria-labelledby="modalInsertform" aria-hidden="true">  
  	<div class="modal-dialog ">
    	<div class="container msk-modal-content"><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-6">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="cboxUncheck()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Edit Event</h3>
   						</div>
            			 <form role="form" action="../index.php" method="post" id="" class="form-horizontal">
            				<div class="panel-body"> <!-- Start of modal body--> 
                                <div class="form-group" >
                                	<div class="col-md-3">
                                    	<label for="" >Title:</label>
                                    </div>
                                    <div class="input-group col-md-8">
                                    	<input type="text" class="form-control" name="title" id="title_update" autocomplete="off">
                                    </div>      						
                                </div>
                                <div class="form-group">
                               		<div class="col-md-3">
                                    	<label>Category:</label>
                                    </div>
                                    <div class="input-group col-md-4">
                                        <select name="category" class="form-control" id="category_update" style="width:105%;"><!--MSK-000107-->
                                        	<option value="0">Select Category</option>
                                    		<option value="1">All Student & Teachers</option>
                                            <option value="2">Only Student</option>
                                            <option value="3">Only Teachers</option> 
                                		</select> 
                            		</div> 
                                </div>
                                <div class="form-group">
                               		<div class="col-md-3">
                                    	<label>Type:</label>
                                    </div>
                                    <div class="input-group col-md-4">
                                        <select name="category_type" class="form-control" id="type_update" style="width:105%;"><!--MSK-000107-->
                                    		<option value="0">Select Type</option>
                                    		<option value="1">All</option>
                                            <option value="2">Only My Students</option>
                                            <option value="3">Specific Grades</option>
                                		</select> 
                            		</div> 
                            	</div> 
                                <div class="form-group" id="divGradeUpdate">
                               		<div class="col-md-3">
                                    	<label>Grade:</label>
                                    </div>
                                    <div class="input-group col-md-4" id="divGradeUpdate1">
                                   		<table class="table borderless">
                                        	<tbody>   
<?php
include_once('../controller/config.php');
$sql="SELECT * FROM grade";
$count=0;
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		$count++;
?> 
                                                <tr>
                                                    <td><input type="checkbox" name="checkbox1[]" id="ck_<?php echo $count; ?>" value="<?php echo $row['id']; ?>"></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                </tr>
<?php }} ?>
                                			</tbody>
                                     	</table>       
                            		</div> 
                            	</div> 
                                 <div class="form-group" >
                                	<div class="col-md-3">
                                    	<label>Date and time range:</label>
                                    </div>
                                    <div class="input-group col-md-8">
                                    	<div class="input-group-addon">
                                        	<i class="fa fa-clock-o"></i>
                                         </div>
                                    	<input type="text" class="form-control pull-right" id="reservationtime_update" name="date_time_range">
                                    </div><!-- /.input group -->
                              	</div> 
                                <div class="form-group " id="divExamSubject">
                               		<div class="col-md-3">
                                    	<label>Note:</label>
                                    </div>
                                    <div class="input-group col-md-8">
                                        <textarea class="form-control" id="note_update" name="note" rows="3"></textarea>
                            		</div> 
                            	</div> 
                                <div class="form-group " >
                               		<div class="col-md-3">
                                    	<label>Color:</label>
                                    </div>
                                    <div class="input-group col-md-4 my-colorpicker2">
                                      <input type="text" class="form-control" name="color" id="color_update">
                                      <div class="input-group-addon">
                                        <i></i>
                                      </div>
                                    </div><!-- /.input group -->
                            		<br><br><br>
                            	</div> 
            				</div><!--/.modal body-->
            				<div class="panel-footer bg-blue-active">
                            	<input type="hidden" name="my_type" id="my_type_update" value="">
                            	<input type="hidden" name="event_id" id="id_update" value=""/>
            					<input type="hidden" name="do" value="update_events"/>
                    			<button type="submit" class="btn btn-info btnS" id="btnSubmit4" style="width:100%;">Update</button>
             				</div>
             			</form>      
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalInsertform -->

<script>

function showUEventmodal(event_id){
	
	$("#modalviewEvent").modal('hide');
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
				var myArray = eval(xhttp.responseText);
				
				$("#modaluEvent").modal('show');
				
				var grade_id = myArray[6];
				
				if(grade_id == ''){
					$("#divGradeUpdate").hide();
				}else{
					$("#divGradeUpdate").show();
					var g_id = grade_id.split(',');
					
					var count = g_id.length;
				
					for(var i=1; i<count+1; i++){
						$('#ck_'+i).attr('checked', 'checked');
					}
					
				}
				
				var type = $("#type_update").value;

				$("#type_update").change(function(){
					var type = this.value;
					if(type == 3){
						$("#divGradeUpdate").show();
						
					}else{
						$("#divGradeUpdate").hide();
						var g_id = grade_id.split(',');
					
						var count = g_id.length;
				
						for(var i=1; i<count +1; i++){
							$('#ck_'+i).attr('checked', false);
						}
					}
				});
				
				document.getElementById("id_update").value = myArray[0];
				document.getElementById("title_update").value = myArray[1];
				document.getElementById("note_update").value = myArray[2];
				document.getElementById("color_update").value = myArray[3];
				document.getElementById("category_update").value = myArray[4];
				document.getElementById("type_update").value = myArray[5];
				var s_date = myArray[7].split(' ');
				var e_date = myArray[8].split(' ');
				document.getElementById("my_type_update").value = myArray[9];
				
				var s_d = new Date(s_date[0]);
				var dd = s_d.getDate();
				var mm = s_d.getMonth()+1; //January is 0!
				var yyyy = s_d.getFullYear();
				
				if(dd<10){
					dd='0'+dd;
				} 
				if(mm<10){
					mm='0'+mm;
				} 
				var s_d = mm+'/'+dd+'/'+yyyy;
				
				var e_d = new Date(e_date[0]);
				
				var dd1 = e_d.getDate();
				var mm1 = e_d.getMonth()+1; //January is 0!
				
				var yyyy1 = e_d.getFullYear();
				if(dd1<10){
					dd1='0'+dd1;
				} 
				if(mm1<10){
					mm1='0'+mm1;
				} 
				var e_d = mm1+'/'+dd1+'/'+yyyy1;
				
				var d_range = s_d + ' '+s_date[1] + ' - ' + e_d + ' ' + e_date[1];
				
				document.getElementById("reservationtime_update").value = d_range;
				
				$('#reservationtime_update').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
				$('#daterange-btn').daterangepicker(
					{
					  ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					  },
					  startDate: moment().subtract(29, 'days'),
					  endDate: moment()
					},
					function (start, end) {
					  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
					}
        		);
				
				$(".my-colorpicker2").colorpicker();
				
			}
				
		};	
		
		xhttp.open("GET", "../model/get_events.php?event_id="+event_id , true);												
		xhttp.send();//MSK-00105-Ajax End
	
};

function cboxUncheck(){
	window.location.reload();
};

</script>

<!-- //MSK-000131 Modal-Delete Confirm Popup -->
	<div class="modal msk-fade " id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  		<div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header bg-primary">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        			<h4 class="modal-title" id="frm_title">Delete</h4>
      			</div>

				<div class="modal-body bgColorWhite">
        			<strong style="color:red;">Are you sure?</strong>  Do you want to leave this Student?
        		</div>
      			<div class="modal-footer">
					<a href="#" style='margin-left:10px;' id="btnYes" class="deletebtn btn btn-danger col-sm-2 pull-right">Yes</a><!-- MSK-000132 -->
        			<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      			</div>
    		</div>
  		</div>
	</div>

<script>

//$('body').on('click', '.confirm-delete', function (e){	
function deleteEvent(event_id){
//MSK-000129
	$('#modalviewEvent').modal('hide');
	$('#deleteConfirm').data('id1', event_id).modal('show');//MSK-000130
 	
};

$('#btnYes').click(function() {
//MSK-000133
     
    var id = $('#deleteConfirm').data('id1');	
		
	var do1 = "delete_record";	
	var table_name= "events";//give data table name
			
	var xhttp = new XMLHttpRequest();//MSK-000134-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000135
				var myArray = eval( xhttp.responseText );
					
				if(myArray[0]==1){//MSK-000136
					
					$('#deleteConfirm').modal('hide');	
					window.location.reload();	
				}
		
				if(myArray[0]==2){//MSK-000140
					
				}

    		}
			
  		};	
		
    	xhttp.open("GET", "../model/delete_record1.php?id=" + id + "&table_name="+table_name + "&do="+do1 , true);												
  		xhttp.send();//MSK-000134-Ajax End
	 			   		
});
</script> 
<?php 

$my_index=$_SESSION['index_number'];
$my_type=$_SESSION['type'];

echo '<script>','ShowEvents("K",'.$my_index.',"'.$my_type.'");','</script>';

?>

<!-- bootstrap color picker -->
<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>

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