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
<?php include_once('alert.php'); ?>

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


</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Exam
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Exam</a></li>
            <li><a href="#">Student Exam Marks</a></li>
        </ol>
	</section>

	<!-- Main content -->
    <section class="content">
    	<div class="row">
            <div class="col-md-5"><!-- left column -->
              	<div class="box box-primary"><!-- general form elements -->
                	<div class="box-header with-border">
                  		<h3 class="box-title">Student Exam Marks</h3>
                	</div><!-- /.box-header -->
                  	<div class="box-body">
                    	
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
                        <div class="form-group" id="divExam">
                        	<div class="col-md-3">
                        		<label>Exam</label>
                     		</div>
                        	<div class="col-md-7" id="divExam1">
                                <select name="exam" class="form-control" id="exam" style="width:105%;" ><!--MSK-000107-->
                                    <option>Select Exam</option>
<?php
include_once('../controller/config.php');
$my_index=$_SESSION["index_number"];
$current_year=date('Y');
    
$sql="SELECT * FROM exam";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                                    <option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>
                                </select>
                     		</div>
                    	</div>    
                  	</div><!-- /.box-body -->
                  	<div class="box-footer">
                    	<input type="hidden" id="current_year" value="<?php echo $current_year; ?>">
	                  	<input type="hidden" id="my_index" value="<?php echo $my_index; ?>">
                    	<button type="button" id="btnSubmit" class="btn btn-primary"  onClick="showStudent(this)">Submit</button><!--MSK-000108-->
                  	</div>
            	</div><!-- /.box -->
        	</div>
    	</div>
	</section><!-- End of form section -->

<!-- table for view all records-->
	<!-- Main content -->
    <section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000112--> 
           
        </div>
    </section> <!-- End of table section --> 
        
<script>
function showStudent(){
//MSK-000109
	
	var current_year = document.getElementById("current_year").value;
	var exam = document.getElementById("exam").value;
	var grade = document.getElementById("grade").value;
	
	if(exam == 'Select Exam'){
		$("#btnSubmit").attr("disabled", true);
		//$('#lableExam').addClass('has-error');
		$('#divExam').addClass('has-error');
		$('#divExam1').addClass('has-feedback');
		$('#divExam1').append('<span id="spanExam" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The exam is required" ></span>');	
					
		$("#exam").change(function() {
							//MSK-00128-classroom
			$("#btnSubmit").attr("disabled", false);	
			//$('#lableExam').removeClass('has-error');
			$('#divExam').removeClass('has-error has-feedback');
			$('#spanExam').remove();
						
		});
		
	}
	
	if(grade == 'Select Grade'){
		$("#btnSubmit").attr("disabled", true);
		//$('#lableExam').addClass('has-error');
		$('#divGrade').addClass('has-error');
		$('#divGrade1').addClass('has-feedback');
		$('#divGrade1').append('<span id="spanGrade" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The grade is required" ></span>');	
					
		$("#grade").change(function() {
							//MSK-00128-classroom
			$("#btnSubmit").attr("disabled", false);	
			//$('#lableExam').removeClass('has-error');
			$('#divGrade').removeClass('has-error has-feedback');
			$('#spanGrade').remove();
						
		});
		
	}
	
	
	if(exam == 'Select Exam' || grade == 'Select Grade'){
	
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
			
    	xhttp.open("GET", "show_student.php?exam="+exam  +  "&year="+current_year+  "&my_index="+my_index +  "&grade="+grade , true);												
  		xhttp.send();//MSK-000110-End Ajax
		
	}
		
};

function showStudent1(exam,current_year,grade){
	
	var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table1').innerHTML = this.responseText;//MSK-000111
				
				$(function () {
					$("#example1").DataTable();
				});
												
    		}
			
  		};
			
    	xhttp.open("GET", "show_student.php?exam="+exam  +  "&year="+current_year +  "&grade="+grade, true);												
  		xhttp.send();//MSK-000110-End Ajax
		

};
//
</script>

<?php
if(isset($_GET["do"])&&($_GET["do"]=="show_student_from_insert")){

	$exam=$_GET['exam'];
	$current_year=$_GET['current_year'];
	$grade=$_GET['grade'];
	$msg=$_GET['msg'];
	
	if($msg > 0){
		
		echo '<script>','showStudent1('.$exam.','.$current_year.','.$grade.');','</script>';
		
		echo"
			<script>
			
			var myModal = $('#insert_Success');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
		
	}else{
	
		echo '<script>','showStudent1('.$exam.','.$current_year.','.$grade.');','</script>';
		
		echo"
			<script>
			
			var myModal = $('#connection_Problem');
			myModal.modal('show');

			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
		
		
	}
		
	
			
}
?>

<?php
if(isset($_GET["do"])&&($_GET["do"]=="show_student")){

	$exam=$_GET['exam'];
	$current_year=$_GET['current_year'];
	$grade=$_GET['grade'];
	$msg=$_GET['msg'];
	
	if($msg > 0){
		
		echo '<script>','showStudent1('.$exam.','.$current_year.','.$grade.');','</script>';
		
		echo"
			<script>
			
			var myModal = $('#update_Success');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
		
	}else{
		
		echo '<script>','showStudent1('.$exam.','.$current_year.','.$grade.');','</script>';
		
		echo"
			<script>
			
			var myModal = $('#connection_Problem');
			myModal.modal('show');

			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
		
		
	}
		
	
			
}
?>

	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table2"><!--MSK-000112--> 
           
        </div>
    </section> <!-- End of table section --> 
	
    <div id="stdProfile">
    
    </div>

	<div id="add_eMark">
    
    </div>
    
    <div id="edit_eMark">
    
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

function showModalAddExam(exam,std_index,grade){
	
	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('add_eMark').innerHTML = this.responseText;//MSK-000111
				$('#inserteMark').modal('show');
				
    		}
			
  		};
			
    	xhttp.open("GET", "student_exam_mark_insert_form1.php?exam="+exam  + "&std_index="+std_index + "&grade="+grade + "&page="+currentPage, true);												
  		xhttp.send();//MSK-000110-End Ajax
};

function showModalEditExam(exam,std_index,grade){
	
	var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('edit_eMark').innerHTML = this.responseText;//MSK-000111
				$('#edit_examMark').modal('show');
				
    		}
			
  		};
			
    	xhttp.open("GET", "student_exam_mark_update_form.php?exam="+exam  + "&std_index="+std_index + "&grade="+grade, true);												
  		xhttp.send();//MSK-000110-End Ajax
};

function showModalViewExam(exam,year,index){
	
	var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table2').innerHTML = this.responseText;//MSK-000111
				window.scrollTo(0,document.body.scrollHeight);
				var subject = document.getElementById('chartLable').value;
				var marks = document.getElementById('chartData').value;
				
				showBarChart(subject,marks);
				
    		}
			
  		};
			
    	xhttp.open("GET", "my_student_exam_marks1.php?exam="+exam +  "&year="+year +  "&index="+index, true);												
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