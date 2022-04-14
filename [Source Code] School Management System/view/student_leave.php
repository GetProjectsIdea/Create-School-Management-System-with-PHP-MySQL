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

.noScroll{
	overflow-y:hidden;	
}

body { 
	overflow-y:scroll;
}

.msk-set-height-inv{
	height:500px;
}

.form-control-feedback {
  
   pointer-events: auto;
  
}

.msk-set-width-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
}
.msk-set-color-tooltip + .tooltip > .tooltip-inner { 
  
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

.msk-modal-content {
   position: absolute;
   left: 125px; 
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

/* #modalINV css  */

#modalINV .div-logo {
	float: left;
	height: 130px;
}

#modalINV .logo{
	float: left;
	width: 90px;
	height: 90px;
	margin-right: 10px;
	border-radius: 50%;
	text-align: center;
	background-color:#8860a7;
}

#modalINV .class-name{
	float: left;		
	margin-top:0;
	padding-top:0;			
}

#modalINV h1,#modalINV h2,#modalINV h3{
	margin-top:0;
	color:#8860a7;

}

#modalINV .class-address {
	float: left;
			
}

#modalINV .class-email {
	float: right;
	margin-right:15px;
	padding-right:0;
	color:white;
	background-color:#8860a7;
}

#modalINV th{			
	background-color:#8860a7;
	color:white;
}
#modalINV .std-name{
	color:#8860a7;
	font-size:16px;
}
#modalINV #h1{
display:none;	
}

#modalINV .pdetail1 {
	padding:0;
	float:right;
	margin-right:7px; 
	
}

#modalINV .pdetail2 {
	float: right;
	
}


@media print{

 body  {
    visibility: hidden;

  }
 #modalINV  {
    visibility: visible;
  }
#divPhoto{
	display:none;	
}
	
#modalINV .logo{
		background-color:#8860a7 !important;	
	}

#modalINV h1,#modalINV h2,#modalINV h3,#modalINV .std-name{
		color:#8860a7 !important;	
	}
	
	
#modalINV .table-bordered th{
			
		color:white!important;
		background-color:#8860a7 !important;		
				
	}
#modalINV .class-email {
		color:white!important;
		background-color:#8860a7 !important;
		
} 

	
#modalINV .panel{
		border:hidden!important;
}
#modalINV #btn1,#modalINV .panel-footer ,#modalINV .msk-heading {
	display:none;
			
}
	
#modalINV #h1{
		display:inline;	
}

#modalINV .close{
		display:none;	
}

	
@-moz-document url-prefix() {
		
	.panel{
		
		margin:0;
		padding:0;
	}
	#modalINV{
		
		margin:0!important;
		padding:0!important;
		position:absolute;
		left:-150px;
	}
	@page{
		margin:0;
		padding:0;	
	}

}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Leave Student
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Leave Student</a></li>
        </ol>
	</section>
    
    <!-- table for view all records -->
    <section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000112--> 
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Leave Student</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-4">Name</th>
                                <th class="col-md-2">Action</th>
                            </thead>
                            <tbody>
<?php
include_once('../controller/config.php');
$sql="select * from student where _status='leave'";
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
    	$count++;
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row['i_name']; ?></td>
                                    <td> 
       <!--MSK-00128 -->
       <a href="#" class="confirm-active btn btn-danger btn-xs" data-id="<?php echo $row['id']; ?>,<?php echo $row['index_number']; ?>">Active</a>
       <!--MSK-00146 -->
       <a href="#modalviewform" onClick="showModal(this)" class="btn btn-primary btn-xs"  data-id="<?php echo $row['id']; ?>,<?php echo $row['index_number']; ?>" data-toggle="modal">View</a>
                                   </td>
                                </tr>
<?php } } ?>
                            </tbody>
                        </table>	
                    </div><!-- /.box-body -->           
                </div><!-- /.box-->
            </div>
    	</div>
    </section> <!-- End of table section -->
    
    
<!-- //MSK-000131 Modal-Active Confirm Popup -->
	<div class="modal msk-fade " id="activeConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  		<div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header bg-primary">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        			<h4 class="modal-title" id="frm_title">Delete</h4>
      			</div>

				<div class="modal-body bgColorWhite">
        			<strong style="color:red;">Are you sure?</strong>  Do you want to Active this Student?
        		</div>
      			<div class="modal-footer">
					<a href="#" style='margin-left:10px;' id="btnYes" class="deletebtn btn btn-danger col-sm-2 pull-right">Yes</a><!-- MSK-000132 -->
        			<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      			</div>
    		</div>
  		</div>
	</div> 
    
<script>

$('body').on('click', '.confirm-active', function (e){	
//MSK-000129
    e.preventDefault();
    var id = $(this).data('id');
	$('#modalviewform').modal('hide');//MSK-000130
	$('#activeConfirm').data('id1', id).modal('show');//MSK-000130
 	
});

$('#btnYes').click(function() {
//MSK-000133
     
    var myArray = $('#activeConfirm').data('id1').split(',');		
	
	var std_id=myArray[0];
	var std_index=myArray[1];

	var do1 = "active_student";

	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	var yourArray = new Array();
	 	yourArray.push(std_index,currentPage);
		
	var xhttp = new XMLHttpRequest();//MSK-000134-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000135
				var myArray1 = eval( xhttp.responseText );
				
				if(myArray1[0]==1){//MSK-000136
					
					$("#activeConfirm").modal('hide');	
					
					$('#modalSelectGrade').data('id2',yourArray).modal('show');
					
				}
		
				if(myArray1[0]==2){//MSK-000140
			
					$("#activeConfirm").modal('hide');
					activeAlert(myArray[0]);//MSK-000141
				
				}

    		}
			
  		};	
		
    	xhttp.open("GET", "../model/active_student.php?id=" + std_id + "&do="+do1 + "&page="+currentPage , true);												
  		xhttp.send();//MSK-000134-Ajax End
	 			   		
});
	
</script>


<!-- //MSK-00122 modalSelectGrade -->      
    <div class="modal msk-fade" id="modalSelectGrade" tabindex="-1" role="dialog" aria-labelledby="modalSelectGrade" aria-hidden="true" data-backdrop="static" data-keyboard="false">  
		<div class="modal-dialog"><!--modal-dialog -->  
			<div class="container col-lg-6 msk-modal-content"><!--modal-content --> 
      			<div class="row">
          			<div class="panel panel-primary "><!--panel --> 
            			<div class="panel-heading ">
              				<h3 class="panel-title">Select Grade</h3>
            			</div>
            			<div class="panel-body"><!--panel-body -->
              				<div class="row">
                				<div class="col-lg-3">
                                	<div class="form-group">
                                        <label for="">Grade</label>
                                        <select class="form-control" style="width:200px;" id="grade" name="grade">
                                            <option>Select Grade</option>
<?php
include_once('../controller/config.php');
$sql="SELECT * FROM grade";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		
?>                   				
                                            <option value="<?php echo $row["id"]; ?>" data-id=""><?php echo $row['name']; ?></option>
<?php }} ?>                                    
                                        </select>
                                    </div> 
                            	</div>        
                        	</div>             
              			</div><!--./panel-body -->
             		</div><!--./panel -->
            	</div>
			</div><!--./modal-content -->
		</div><!--./modal-dialog --> 
	</div><!--./modal--> 
    
    <div id="viewSubjectDiv"><!--MSK-000126--> 
            
    </div>
    
    <div id="insertSubjectDiv"><!--MSK-000134--> 
        
    </div>
    
<script>
$('#grade').change(function () {
	//MSK-00123
	var grade = $('#grade').val();
	 
	var myArray = $('#modalSelectGrade').data("id2");
		
	var index=myArray[0];
	
	var do1 = "view_subject";
	
	$('#modalSelectGrade').modal('hide');
	 
	var xhttp = new XMLHttpRequest();//MSK-000124-Start Ajax 
		xhttp.onreadystatechange = function() {
			
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('viewSubjectDiv').innerHTML=this.responseText;//MSK-000125
				
				$("#modalViewSubject").modal('show');//MSK-000127
				
							
			}
				
		};
		
		xhttp.open("GET", "show_student_subject.php?id=" + grade + "&do="+do1+ "&index="+index, true);												
		xhttp.send();//MSK-000124-End Ajax
	

});

function showModalGrade(){
	$('#modalSelectGrade').modal('show');	
	document.getElementById("grade").value ='Select Grade';
};

function insertSubject(){
	//MSK-000131
	var Id = $("#checkbox").data("id");
	var grade = $("#btnSubmit1").data("id");
    var yourArray = new Array();
     
	$("#checkbox:checked").each(function(){
		
		yourArray.push($(this).val());
		
	});

	var xhttp = new XMLHttpRequest();//MSK-000132-Start Ajax 
  		xhttp.onreadystatechange = function() {
			
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('insertSubjectDiv').innerHTML=this.responseText;//MSK-000133
				
				$('#modalSelectGrade').modal('hide');
				$('#modalViewSubject').modal('hide');
				$('#modalINV').modal('show');//MSK-000135
				$('#insertSubjectDiv').addClass('msk-set-height-inv');
				
			}
			
		};
		xhttp.open("GET", "student_first_payment.php?index=" + Id + "&grade="+grade + "&id="+JSON.stringify(yourArray), true);												
		xhttp.send();//MSK-000132-End Ajax
		
};

function addSPayment(){
	//MSK-000139
	var index = $("#index").val();
	var totalSFee = $("#total_sfee").val();
	var aFee = $("#a_fee").val(); 
	var inv_num = $("#inv_num").val(); 
	
	var xhttp = new XMLHttpRequest();//MSK-000140-Start Ajax 
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {//MSK-000142
				
				$("#modalINV").modal('hide');
				var myArray = eval( xhttp.responseText );
				
				if(myArray[0] == 1){//MSK-000144
					
					var myArray5 = $('#modalSelectGrade').data("id2");
					var page = myArray5[1];
					
					var xhttp1 = new XMLHttpRequest();//MSK-000131-Start Ajax  
						xhttp1.onreadystatechange = function() {		
				
							if (this.readyState == 4 && this.status == 200) {
										
								document.getElementById('table1').innerHTML = this.responseText;//MSK-000132
								cTablePage(page);//MSK-000133
								activeAlert(myArray[0]);//MSK-000134	
							
							}
								
						};
						
						xhttp1.open("GET", "show_leave_student_table.php" , true);												
  						xhttp1.send();//MSK-000131-End Ajax

					
				}


				if(myArray[0] == 2){//MSK-000146
					var myModal = $('#connection_Problem');
					myModal.modal('show');//MSK-000147
					
					myModal.data('hideInterval', setTimeout(function(){
    					myModal.modal('hide');
				
    				}, 3000));
				
				}
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/add_student_first_payment.php?index=" + index + "&afee="+aFee + "&totalsfee="+totalSFee + "&inv_num="+inv_num , true);												
  		xhttp.send();//MSK-000140-End Ajax	
	                                       
};

function cTablePage(page){
//MSK-000135	
	var currentPage1 = (page-1)*10;
	
	$(function(){
		$("#example1").DataTable({
			"displayStart": currentPage1,    
			"bDestroy": true       
   		});
						
	});
	
};	

function activeAlert(msg){
//MSK-000136	
	if(msg==1){
		
    	var myModal = $('#insert_Success');
		myModal.modal('show');
		
		clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
			
    	}, 3000));
			
	}
	
	if(msg==2){
		
    	var myModal = $('#connection_Problem');
		myModal.modal('show');
		
    	clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
    	}, 3000));
				
	}

};	

</script>

<!-- //MSK-00148 modalviewform-->
   
<div class="modal msk-fade" id="modalviewform" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container col-lg-12 "><!--modal-content --> 
      		<div class="row">
          		<div class="panel panel-info"><!--panel --> 
            		<div class="panel-heading">
                    	<button type="button"  class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              			<h3 class="panel-title" id="std_name2"></h3>
            		</div>
            		<div class="panel-body"><!--panel-body -->
              			<div class="row">
                			<div class="col-md-3"> 
                				<img id="photo2" alt="User Pic" src="" class="img-circle img-responsive"> 
                			</div>
                			<div class=" col-md-9"> 
                  				<table class="table table-user-information">
                    				<tbody>
                      					<tr>
                        					<td>Full Name1</td>
                        					<td id="full_name2"> </td>
                      					</tr>
                      					<tr>
                        					<td>Name With Initials</td>
                        					<td id="i_name2"> </td>
                      					</tr>
                             			<tr>
                        					<td>Address</td>
                        					<td id="address2"> </td>
                      					</tr>
                        				<tr>
                        					<td>Gender</td>
                        					<td id="gender2"> </td>
                      					</tr>
                      					<tr>
                        					<td>Email</td>
                        					<td id="email2"> </td>
                      					</tr>
                        					<td>Phone Number</td>
                        					<td id="phone2"> </td>
                           
                      					</tr>
                                        <tr>
                        					<td>Guardians Name</td>
                        					<td id="g_name2"> </td>
                      					</tr>
                        				<tr>
                        					<td>Guardians Address</td>
                        					<td id="g_address2"> </td>
                      					</tr>
                      					<tr>
                        					<td>Guardians Phone</td>
                        					<td id="g_phone2"> </td>
                      					</tr>
                     					<tr>
                        					<td>Guardians Email</td>
                        					<td id="g_email2"> </td>
                      					</tr>
                    				</tbody>
                  				</table>
                  			</div>
                   		</div>
                  	</div><!--/.panel-body -->
                	<div class="panel-footer bg-gray-light">
                    	<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="#" id="active" type="button" class="confirm-active btn btn-sm btn-success"><i class="glyphicon glyphicon-user"></i></a><!--MSK-00151-->
                        </span>
                    </div>
            	</div><!--/. panel--> 
			</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal -->  

<script>

function showModal(Viewform){	
//MSK-00147
	
	var id = $(Viewform).data("id"); 			
	var myArray3 = id.split(',');
		
	var std_id=myArray3[0];
	var std_index=myArray3[1];
	 
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-00150
				var myArray1 = eval( xhttp.responseText );
				
				document.getElementById("full_name2").innerHTML =myArray1[1];
				document.getElementById("i_name2").innerHTML =myArray1[2];
				document.getElementById("std_name2").innerHTML =myArray1[2];
				document.getElementById("address2").innerHTML =myArray1[3];
				document.getElementById("gender2").innerHTML =myArray1[4];
				document.getElementById("phone2").innerHTML =myArray1[5];
				document.getElementById("email2").innerHTML =myArray1[6];
				document.getElementById("photo2").src ="../"+myArray1[7];
				document.getElementById("g_name2").innerHTML =myArray1[8];
				document.getElementById("g_address2").innerHTML =myArray1[9];
				document.getElementById("g_phone2").innerHTML =myArray1[10];
				document.getElementById("g_email2").innerHTML =myArray1[11];
				
				$('#active').data('id',std_id+','+std_index);	
			
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/get_student.php?id=" + std_id  , true);												
  		xhttp.send();//MSK-00149--End Ajax
	 
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