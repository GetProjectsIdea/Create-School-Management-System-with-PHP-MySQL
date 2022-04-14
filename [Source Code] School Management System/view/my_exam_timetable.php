<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_student.php'); ?>
<?php include_once('sidebar1.php'); ?>

<style>

body { 

	overflow-y:scroll;
	
}

tbody tr{
	
	height:100px;	
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
            <li><a href="#">Exam Timetabe</a></li>
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
                  		<h3 class="box-title">My Exam Timetable</h3>
                	</div><!-- /.box-header -->
                  	<div class="box-body">
                        <div class="form-group col-md-3" id="divGender1">
                        	<label>Exam</label>
                    		
                     	</div>
                        <div class="form-group col-md-6" id="divGender1">
                        	
                    		<select name="exam" class="form-control " id="exam" ><!--MSK-000107-->
                    			<option>Select Exam</option>
<?php
include_once('../controller/config.php');

$index=$_SESSION["index_number"];
$current_year=date('Y');

$sql1="SELECT * FROM student_grade WHERE index_number='$index' AND year='$current_year'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['grade_id'];
		
$sql="SELECT * FROM exam";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
     							<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>
					  		</select>
                     	</div>
                        
                  	</div><!-- /.box-body -->
                  	<div class="box-footer">
                    	<input type="hidden" id="index" value="<?php echo $index; ?>">
                    	<input type="hidden" id="grade" value="<?php echo $id; ?>">
                    	<button type="button" class="btn btn-primary"  onClick="showExamTimetable(this)">Submit</button><!--MSK-000108-->
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
function showExamTimetable(){
//MSK-000109
	var index = document.getElementById("index").value;
    var grade = document.getElementById("grade").value;
	var exam = document.getElementById("exam").value;
			
	var do1 ="show_exam_Timetable";
	
	var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table1').innerHTML = this.responseText;//MSK-000111
										
    		}
			
  		};
			
    	xhttp.open("GET", "my_exam_timetable1.php?grade="+grade +  "&exam="+exam+  "&index="+index +  "&do="+do1 , true);												
  		xhttp.send();//MSK-000110-End Ajax
	
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