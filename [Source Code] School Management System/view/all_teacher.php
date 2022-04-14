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

body{
	overflow-y:scroll;	
}

.msk-col-md-4{
	width:28%;
}
.modal{
	overflow-y: auto;
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
.msk-image-error{
	border:1px solid #f44336;
	
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

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


.modal-dialog1 {
  width: 75%;
  height: 100%;
  margin: 0;
  padding: 0;
}

.modal-content1 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: 16%; 
}
.modal-content2 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: 10%; 
}

.modal-content3 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: -31%; 
}

@media only screen and (max-width: 500px) {
	
	.modal-content1, .modal-content2, .modal-content3, .container, .modal-dialog1{
		
	 	width:100%;
	  	position: static;
		
		
	}
	
	#salaryDetails, #salary_details, #salary_details2{
		width:100%;
	}
	
	 #tableSdetails, #tableSdetails1, #tableSdetails2 , #tableSdetails3{
		
		width:100%;
		
	}
	
	.panel-body, .table1-responsive, .table2-responsive {
		overflow-x:auto !important; 
	}
	
	

}

@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    [class*="col-"] {
        width: 100%;
    }
	
	.panel-body, .table1-responsive, .table2-responsive  {
		overflow-x:auto !important; 
	}
	
	
	.modal-content1, .modal-content2, .modal-content3, .container, .modal-dialog1{
		
	 	width:100%;
	  	position: static;
		
		
	}
	
	#salaryDetails, #salary_details, #salary_details2{
		width:100%;
	}
	
	 #tableSdetails, #tableSdetails1, tableSdetails2{
		
		width:100%;
		
	}
	
	
	
}

@media only screen and (max-width: 1200px) {
    /* For mobile phones: */
 
	
	.modal-content1, .modal-content2, .modal-content3, .container, .modal-dialog1{
		
	 	width:100%;
	  	position: static;
		
		
	}
	
	[class*="col-"] {
        width: 100%;
    }
	
	#salaryDetails, #salary_details, #salary_details2{
		width:100%;
	}
	
	 #tableSdetails, #tableSdetails1, tableSdetails2{
		
		width:100%;
		
	}
	
	.panel-body, .table1-responsive, .table2-responsive  {
		overflow-x:auto !important; 
	}
	
	
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
	
	#show_INV{
		height:450px;
	}
	

	body{
		visibility: hidden;
	}
	
	#modalINV{
	   visibility: visible;
	}
	
	#tSalaryhistory{
		display:none !important;
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
	
	#modalINV .pdetail1 {
		margin:0;	
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
}


/* #modalINV1 css  */

#modalINV1 .div-logo {
	float: left;
	height: 130px;
}

#modalINV1 .logo{
	float: left;
	width: 90px;
	height: 90px;
	margin-right: 10px;
	border-radius: 50%;
	text-align: center;
	background-color:#8860a7;
}

#modalINV1 .class-name{
	float: left;		
	margin-top:0;
	padding-top:0;			
}

#modalINV1 h1,#modalINV1 h2,#modalINV1 h3{
	margin-top:0;
	color:#8860a7;

}

#modalINV1 .class-address {
	float: left;
			
}

#modalINV1 .class-email {
	float: right;
	margin-right:15px;
	padding-right:0;
	color:white;
	background-color:#8860a7;
}

#modalINV1 th{			
	background-color:#8860a7;
	color:white;
}
#modalINV1 .std-name{
	color:#8860a7;
	font-size:16px;
}
#modalINV1 #h1{
display:none;	
}

#modalINV1 .pdetail1 {
	padding:0;
	float:right;
	margin-right:7px; 
	
}

#modalINV1 .pdetail2 {
	float: right;
	
}


@media print{
	
	#show_INV{
		height:450px;
	}
	

	body{
		visibility: hidden;
	}
	
	#modalINV1{
	   visibility: visible;
	}
	
	#tSalaryhistory{
		display:none !important;
	}

	#divPhoto{
		display:none;	
	}
	
	#modalINV1 .logo{
		background-color:#8860a7 !important;	
	}

	#modalINV1 h1,#modalINV1 h2,#modalINV1 h3,#modalINV1 .std-name{
		color:#8860a7 !important;	
	}
		
		
	#modalINV1 .table-bordered th{
		color:white!important;
		background-color:#8860a7 !important;		
	}
	#modalINV1 .class-email {
		color:white!important;
		background-color:#8860a7 !important;
	} 
	
	#modalINV1 .panel{
		border:hidden!important;
	}
	#modalINV1 #btn1,#modalINV1 .panel-footer ,#modalINV1 .msk-heading {
		display:none;
	}
		
	#modalINV1 #h1{
		display:inline;	
	}
	
	#modalINV1 .close{
		display:none;	
	}
	#modalINV1 .pdetail1 {
		margin:0;	
		
	}
	@-moz-document url-prefix() {
			
		.panel{
			margin:0;
			padding:0;
		}
		#modalINV1{
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
}


</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	All Teacher
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-teacher"></i> Teacher</a></li>
            <li><a href="#"> All Teacher</a></li>
         </ol>
     </section>

    <!-- table for view all records //MSK-00112 -->
    <section class="content" > <!-- Start of table section -->
        <div class="row" id="table1"><!-- after delete methanata thamay overite karanne view_classroom table -->
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Teacher</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-3">Name</th>
                                <th class="col-md-4">Action</th>
                            </thead>
                            <tbody>
<?php
include_once('../controller/config.php');
$sql="SELECT * FROM teacher";
$result=mysqli_query($conn,$sql);
$count = 0;
$cant_remove1=0;
$cant_remove2=0;
$cant_remove3=0;
$cant_remove4=0;
$cant_remove5=0;
$cant_remove6=0;
$cant_remove7=0;
$cant_remove8=0;
$cant_remove9=0;
$cant_remove10=0;

if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
    	$count++;
		$id=$row['id'];
		$index=$row['index_number'];
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td id="td1_<?php echo $row['id']; ?>">
                                    	<a href="#modalViewform" onClick="showModal1(this)" class=""  data-id="<?php echo $row["id"]; ?>" data-toggle="modal">
											<?php echo $row['i_name']; ?>
                                        </a>
                                    </td>
                                    <td>

<?php

$sql1="SELECT * FROM subject_routing WHERE teacher_id='$id'";	
   
$result1=mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0){
	$cant_remove1=1;
}else{
	$cant_remove1=0;
}

$sql2="SELECT * FROM timetable WHERE teacher_id='$id'";	
   
$result2=mysqli_query($conn,$sql2);

if(mysqli_num_rows($result2) > 0){
	$cant_remove2=1;
}else{
	$cant_remove2=0;
}


$sql3="SELECT * FROM teacher_attendance WHERE index_number='$index'";	
   
$result3=mysqli_query($conn,$sql3);

if(mysqli_num_rows($result3) > 0){
	$cant_remove3=1;
}else{
	$cant_remove3=0;
}

$sql4="SELECT * FROM teacher_salary WHERE index_number='$index'";	
   
$result4=mysqli_query($conn,$sql4);

if(mysqli_num_rows($result4) > 0){
	$cant_remove4=1;
}else{
	$cant_remove4=0;
}

$sql5="SELECT * FROM teacher_salary_history WHERE index_number='$index'";	
   
$result5=mysqli_query($conn,$sql5);

if(mysqli_num_rows($result5) > 0){
	$cant_remove5=1;
}else{
	$cant_remove5=0;
}

$sql6="SELECT * FROM my_friends WHERE friend_index='$index'";	
   
$result6=mysqli_query($conn,$sql6);

if(mysqli_num_rows($result6) > 0){
	$cant_remove6=1;
}else{
	$cant_remove6=0;
}


$sql7="SELECT * FROM online_chat WHERE user_index='$index' AND user_type='Teacher'";	
   
$result7=mysqli_query($conn,$sql7);

if(mysqli_num_rows($result7) > 0){
	$cant_remove7=1;
}else{
	$cant_remove7=0;
}

$sql8="SELECT * FROM petty_cash WHERE received_by='$index' AND received_type='Teacher'";	
   
$result8=mysqli_query($conn,$sql8);

if(mysqli_num_rows($result8) > 0){
	$cant_remove8=1;
}else{
	$cant_remove8=0;
}

$sql9="SELECT * FROM petty_cash_history WHERE received_by='$index' AND received_type='Teacher'";	
   
$result9=mysqli_query($conn,$sql9);

if(mysqli_num_rows($result9) > 0){
	$cant_remove9=1;
}else{
	$cant_remove9=0;
}


$sql10="SELECT * FROM events WHERE create_by='$index' AND creator_type='Teacher'";	
   
$result10=mysqli_query($conn,$sql10);

if(mysqli_num_rows($result10) > 0){
	$cant_remove10=1;
}else{
	$cant_remove10=0;
}

if($cant_remove1 > 0 || $cant_remove2 > 0 || $cant_remove3 > 0 || $cant_remove4 > 0 || $cant_remove5 > 0 || $cant_remove6 > 0 || $cant_remove7 > 0 || $cant_remove8 > 0 || $cant_remove9 > 0 || $cant_remove10 > 0){
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-warning btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#" onClick="addSalary(this)" class="btn btn-success btn-xs"  data-id="'.$index.','.$id.'">Add Salary</a>';
	echo ' <a href="#" onClick="viewPayments(this)" class="btn btn-info btn-xs"  data-id="'.$index.'">View Payments</a>';
	
}else{
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-warning btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#" class="confirm-delete btn btn-danger btn-xs"  data-id="'.$id.'">Delete</a>';
	echo ' <a href="#" onClick="addSalary(this)" class="btn btn-success btn-xs"  data-id="'.$index.','.$id.'">Add Salary</a>';
	echo ' <a href="#" onClick="viewPayments(this)" class="btn btn-info btn-xs"  data-id="'.$index.'">View Payments</a>';
	
}

?>                                    

                                    </td>
                                </tr>
<?php } } ?>
                            </tbody>
                        </table>
                	</div><!-- /.box-body -->	
                </div>
            </div>
        </div>
    </section> <!-- End of table section --> 

<!--Modal-Update form //MSK-00114-->  
  	<div class="modal msk-fade" id="modalUpdateform" tabindex="-1" role="dialog" aria-labelledby="modalUpdateform" aria-hidden="true">  
  		<div class="modal-dialog">
    		<div class="container">
            	<div class="row ">
            		<div class="col-md-6">
                		<div class="panel">
        					<div class="panel-heading bg-orange">               
                    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    			<h4 class="modal-title custom_align" id="Heading">Edit Teacher</h4>
                			</div>
                			<form action="../index.php" method="post" enctype="multipart/form-data" id="form2">
                				<div class="panel-body"><!-- Start of the modal body--> 
                                    <div class="form-group" id="divFullNameUpdate">
                                        <label for="">Full Name</label>
                                        <input class="form-control" type="text" id="full_name1" name="full_name" autocomplete="off">
                                    </div>
                                    
                                    <div class="form-group" id="divINameUpdate">
                                        <label for="">Name With Initials</label>
                                        <input class="form-control " type="text" id="i_name1" name="i_name" autocomplete="off">
                                    </div>
                                    
                                    <div class="form-group" id="divAddressUpdate">
                                        <label for="">Address</label>
                                        <input class="form-control " type="text" id="address1" name="address" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gender</label>
                                        <select class="form-control" style="width:200px;" id="gender1" name="gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="divPhoneUpdate">
                                        <label for="">Phone Number</label>
                                        <input class="form-control" type="text" id="phone1" name="phone" autocomplete="off">
                                    </div>
                                    <div class="form-group" id="divEmailUpdate">
                                        <label for="">Email</label>
                                        <input class="form-control " type="text" id="email1" name="email" autocomplete="off">
                                    </div>
                                    <div class="form-group" id="divPhotoUpdate">
                                        <label for="">Photo</label>
                                    </div>
                                    <div class="form-group"  id="divPhotoUpdate1">
                                        <img id="output1" style="width:130px;height:150px;" src="" />
                                        <input type="file" name="fileToUpload" id="fileToUpload1"  style="margin-top:7px; "  />
                                    </div>
                				</div><!--/.modal body-->
                                <div class="panel-footer bg-gray-light">
                                    <input type="hidden" id="c_page"  name="c_page" value="" />
                                    <input type="hidden" id="id1"  name="id" value="" />
                                    <input type="hidden" name="do" value="update_teacher">
                                    <button type="submit" class="btn btn-info" id="btnSubmit1" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                            	</div><!--/.panel-footer-->
                        	</form> 
            			</div><!--/.panel--> 
            		</div><!--/.col-md-6-->
            	</div><!--/.row-->                                    
        	</div><!-- /.modal-content -->  		 
  		</div><!-- /.modal-dialog -->        
	</div><!--/.Modal-Update form -->   

<script>

function showModal(Updateform){
//MSK-00115 
	$('#modalViewform').modal('hide');
	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	var Id = $(Updateform).data("id"); 
	var path = "../"; 
	
	var xhttp = new XMLHttpRequest();//MSK-00116-Ajax Start
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				var myArray1 = eval( xhttp.responseText );
				var imagePath = path.concat(myArray1[7]);
			
				//MSK-00118
				document.getElementById("id1").value =myArray1[0];
				document.getElementById("full_name1").value =myArray1[1];
				document.getElementById("i_name1").value =myArray1[2];
				document.getElementById("address1").value =myArray1[3];
				document.getElementById("gender1").value =myArray1[4];
				document.getElementById("phone1").value =myArray1[5];
				document.getElementById("email1").value =myArray1[6];
				document.getElementById("output1").src ='../'+myArray1[7];
				document.getElementById("c_page").value =currentPage;
				
				var telformat = /\d{3}[\-]\d{3}[\-]\d{4}$/;
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				
				$("#phone1" ).keydown(function(){//MSK-00119-phone
					
					var beforeValue = $(this);// this is the value before the keypress
					
    				setTimeout(function() {
        				
        				var afterValue = beforeValue.val();// this is the value after the keypress
						var mom = $('#divPhoneUpdate');
						
						if (telformat.test(afterValue) == false){
							//MSK-00120-phone
							$("#btnSubmit1").attr("disabled", true);
							mom.removeClass('has-success has-feedback');
							mom.children("span").remove();
							
							mom.addClass('has-error has-feedback');
							mom.append('<span id="spanPhoneUpdate" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip" title="Enter valid phone number" ></span>');	
							
						}else{
							//MSK-00121-phone
							$("#btnSubmit1").attr("disabled", false);
							mom.removeClass('has-error has-feedback');
							mom.children("span").remove();
							
							mom.addClass('has-success has-feedback');
							mom.append('<span id="spanPhoneUpdate" class="glyphicon glyphicon-ok form-control-feedback" ></span>');	
						}
				
    				}, 0);

				
				});	
				
				$("#email1" ).keydown(function(){//MSK-00119-email
					
					var beforeValue = $(this);// this is the value before the keypress
					
    				setTimeout(function() {
        				
        				var afterValue = beforeValue.val();// this is the value after the keypress
						var mom = $('#divEmailUpdate');
						
						if (mailformat.test(afterValue) == false){
							//MSK-00120-email
							$("#btnSubmit1").attr("disabled", true);
							mom.removeClass('has-success has-feedback');
							mom.children("span").remove();
							
							mom.addClass('has-error has-feedback');
							mom.append('<span id="spanEmailUpdate" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip" title="Enter valid email address" ></span>');	
							
						}else{
							//MSK-00121-email
							$("#btnSubmit1").attr("disabled", false);
							mom.removeClass('has-error has-feedback');
							mom.children("span").remove();
							
							mom.addClass('has-success has-feedback');
							mom.append('<span id="spanEmailUpdate" class="glyphicon glyphicon-ok form-control-feedback" ></span>');	
						}
				
    				}, 0);

				
				});	
				
				$('[type="file"]').change(function () {
					//MSK-00119-photo
					var fileSize = this.files[0].size;	
					var maxSize = 1000000;// bytes
					var ext = $('#fileToUpload1').val().split('.').pop().toLowerCase();
										
						if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
    						//MSK-00120-photo
							
							output1.src="../uploads/error.png";
							
							$("#btnSubmit1").attr("disabled", true);
							$('#divPhotoUpdate1').addClass('has-error has-feedback msk-col-md-4');
							$('#divPhotoUpdate1').append('<span id="spanPhoto" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="This file type is not allowed" ></span>');
														
						}else{
							
							if(fileSize > maxSize) {
								//MSK-00121-photo
								output1.src="../uploads/error.png";
								
								$("#btnSubmit1").attr("disabled", true);
								$('#divPhotoUpdate1').addClass('has-error has-feedback msk-col-md-4');	
								$('#divPhotoUpdate1').append('<span id="spanPhoto" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The image size is too large" ></span>');		
							
							}else{
								//MSK-00122-photo 
								output1.src = URL.createObjectURL(this.files[0]);
								
								$("#btnSubmit1").attr("disabled", false);	
								$('#divPhotoUpdate1').removeClass('has-error has-feedback msk-col-md-4');
								$('#spanPhoto').remove();
	   
							}
						}
					});
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/get_teacher.php?id=" + Id , true);//MSK-00116-Ajax End											
  		xhttp.send();
	 
};

$("#form2").submit(function(e){
//MSK-000098-form2 submit

	var Id1 = document.getElementById('id1').value;
	var full_name = document.getElementById("full_name1").value;
	var i_name = document.getElementById("i_name1").value;
	var address = document.getElementById("address1").value;	
	var gender = document.getElementById("gender1").value;
	var phone = document.getElementById("phone1").value;
	var email = document.getElementById("email1").value;
	var photo = document.getElementById("output1").src;

	if(full_name == ''){
		//MSK-00123-full_name 
		$('#divFullNameUpdate').addClass('has-error has-feedback');
		$('#divFullNameUpdate').append('<span class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The full name is required" ></span>');
			
		$("#full_name1").keydown(function(){
			//MSK-00124-full_name 
			$("#btnSubmit1").attr("disabled",false);
			$('#divFullNameUpdate').removeClass('has-error has-feedback');
			$('#divFullNameUpdate').children("span").remove();
			
		});
		
	}else{
			
	}
	
	if(i_name == ''){
		//MSK-00123-i_name 
		$('#divINameUpdate').addClass('has-error has-feedback');
		$('#divINameUpdate').append('<span class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The initials name is required" ></span>');
		
		$("#i_name1").keydown(function(){
			//MSK-00124-i_name 
			$("#btnSubmit1").attr("disabled",false);
			$('#divINameUpdate').removeClass('has-error has-feedback');
			$('#divINameUpdate').children("span").remove();
			
		});
		
	}else{
			
	}
	
	if(address == ''){
		//MSK-00123-address
		$('#divAddressUpdate').addClass('has-error has-feedback');
		$('#divAddressUpdate').append('<span class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The address is required" ></span>');
		
		$("#address1").keydown(function(){
			//MSK-00124-address
			$("#btnSubmit1").attr("disabled",false);
			$('#divAddressUpdate').removeClass('has-error has-feedback');
			$('#divAddressUpdate').children("span").remove();
			
		});
		
	}else{
			
	}
	
	var telformat = /\d{3}[\-]\d{3}[\-]\d{4}$/;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if(full_name == '' || i_name == '' || address == '' || phone == '' || email == '' || gname == '' || gaddress == '' || gphone == '' || gemail == '' ||telformat.test(phone) == false || mailformat.test(email) == false ){
		//MSK-000098- form2 validation failed
		$("#btnSubmit1").attr("disabled", true);
		e.preventDefault();
		return false;
		
	}else{
		$("#btnSubmit1").attr("disabled", false);
		//return true;
	}
});

//MSK-000125
function cTablePage(page){
	
	var currentPage1 = (page-1)*10;
	
	$(function(){
		$("#example1").DataTable({
			"displayStart": currentPage1,    
			"bDestroy": true       
   		});
						
	});
					  
	window.scrollTo(0,document.body.scrollHeight);
	
};

</script> 

<!--run update alert using PHP & JS/JQUERY  -->    
<?php
// MSK-000143-24-PHP-JS-UPDATE
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_update")){
  
$msg=$_GET['msg'];
$page=$_GET['page'];

	if($msg==1){
		
		echo '<script>','cTablePage('.$page.');','</script>';
		echo"
				<script>
				
				var myModal = $('#update_Success');
				myModal.modal('show');
				
				myModal.data('hideInterval', setTimeout(function(){
					myModal.modal('hide');
				}, 3000));
							
				</script>
			";
		 
	}
	
	if($msg==2){
		
		echo '<script>','cTablePage('.$page.');','</script>';
		echo"
				<script>
				
				var myModal = $('#connection_Problem');
				myModal.modal('show');
				
				myModal.data('hideInterval', setTimeout(function(){
					myModal.modal('hide');
				}, 3000));
							
				</script>
			";
		 
	}
	
	if($msg==3){
		
		echo '<script>','cTablePage('.$page.');','</script>';
		echo"
				<script>
				
				var myModal = $('#upload_error1');
				myModal.modal('show');
				
				myModal.data('hideInterval', setTimeout(function(){
					myModal.modal('hide');
				}, 3000));
							
				</script>
			";
		
	}
	
	if($msg==4){
		
		echo '<script>','cTablePage('.$page.');','</script>';
		echo"
				<script>
				
				var myModal = $('#update_error1');
				myModal.modal('show');
				
				myModal.data('hideInterval', setTimeout(function(){
					myModal.modal('hide');
				}, 3000));
							
				</script>
			";
		 
	}
	
	if($msg==5){
		
		echo '<script>','cTablePage('.$page.');','</script>';
		echo"
				<script>
				
				var myModal = $('#email_Duplicated');
				myModal.modal('show');
				
				myModal.data('hideInterval', setTimeout(function(){
					myModal.modal('hide');
				}, 3000));
							
				</script>
			";
		 
	}
	
}
?>


<!-- Modal-Delete Confirm Popup //MSK-000129 -->
	<div class="modal msk-fade " id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  		<div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header bg-primary">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        			<h4 class="modal-title" id="frm_title">Delete</h4>
      			</div>

				<div class="modal-body bgColorWhite">
        			<strong style="color:red;">Are you sure?</strong>  Do you want to Delete this Record
        		</div>
      			<div class="modal-footer">
					<a href="#" style='margin-left:10px;' id="btnYes" class="deletebtn btn btn-danger col-sm-2 pull-right">Yes</a><!-- MSK-000130 -->
        			<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      			</div>
    		</div>
  		</div>
	</div>


<script>
//MSK-000127
$('body').on('click', '.confirm-delete', function (e){
	e.preventDefault();
    var id = $(this).data('id');
	$('#modalViewform').modal('hide');
	$('#deleteConfirm').data('id1', id).modal('show');//MSK-000128
});

$('#btnYes').click(function() {
//MSK-000131  
  
    var id = $('#deleteConfirm').data('id1');	
	var do1 = "delete_record";
	var table_name="teacher";	
		
	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	var xhttp = new XMLHttpRequest();//MSK-000132-Ajax Start  

  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200){//MSK-000134
				
				var myArray = eval( xhttp.responseText );
					
				if(myArray[0]==1){//MSK-000135
					
					$("#deleteConfirm").modal('hide');	        		
					var page = myArray[1];
				
					var xhttp1 = new XMLHttpRequest();//MSK-000136-Start Ajax  
						xhttp1.onreadystatechange = function(){		
				
							if (this.readyState == 4 && this.status == 200) {
										
								document.getElementById('table1').innerHTML = this.responseText;//MSK-000137
								cTablePage(page);//MSK-000138
								Delete_alert(myArray[0]);//MSK-000139	
							
							}
								
						}
						xhttp1.open("GET", "show_teacher_table.php" , true);												
  						xhttp1.send(); //MSK-000136-End Ajax
				
				}
		
				if(myArray[0]==2){//MSK-000140
					
					$("#deleteConfirm").modal('hide');
					Delete_alert(myArray[0]);//MSK-000141
				
				}


    		}
			
  		};
			
    	xhttp.open("GET", "../model/delete_record.php?id=" + id + "&do="+do1 + "&table_name="+table_name  + "&page="+currentPage , true);												
  		xhttp.send();//MSK-000133-Ajax End
	 			   		
});

function Delete_alert(msg){
//MSK-000142	
	if(msg==1){
		
    	var myModal = $('#delete_Success');
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
               
<!-- Modal-View form //MSK-00148 --> 
	<div class="modal msk-fade" id="modalViewform" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog"><!--modal-dialog -->  
			<div class="container col-lg-12 "><!--modal-content --> 
      			<div class="row">
                    <div class="panel panel-info"><!--panel --> 
                        <div class="panel-heading">
                        	 <button type="button"  class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h3 class="panel-title" id="hname"></h3>
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
                                                <td>Full Name</td>
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
                                            <tr>
                                                <td>Phone Number</td>
                                                <td id="phone2"> </td>
                                            </tr>
                                             <tr>
                                                <td>Register Date:</td>
                                                <td id="reg_date"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--/.panel-body -->
                        <div class="panel-footer text-right"><!-- panel-footer-->
           <!--MSK-00151--><a href="#modalUpdateform" onClick="showModal(this)"  data-original-title="Edit this user" id="id_Edit"   data-toggle="modal" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
           <!--MSK-00152--><a href="#" data-original-title="Remove this user" id="id_Delete"  data-toggle="modal" type="button" class="confirm-delete btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                           <span class="pull-right"> </span>
                        </div><!--/. panel-footer-->
                   </div><!--/. panel--> 
                </div><!--/.row --> 
            </div><!--/.modal-content -->
        </div><!--/.modal-dialog -->
    </div><!--/.modal -->      
<script>
//MSK-00147
function showModal1(Viewform){
	var Id = $(Viewform).data("id"); 
	var path = "../"; 
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-00150
				var myArray1 = eval( xhttp.responseText );
				
				document.getElementById("full_name2").innerHTML =myArray1[1];
				document.getElementById("i_name2").innerHTML =myArray1[2];
				document.getElementById("hname").innerHTML =myArray1[2];
				document.getElementById("address2").innerHTML =myArray1[3];
				document.getElementById("gender2").innerHTML =myArray1[4];
				document.getElementById("phone2").innerHTML =myArray1[5];
				document.getElementById("email2").innerHTML =myArray1[6];
				document.getElementById("photo2").src ="../"+myArray1[7];	
				document.getElementById("reg_date").innerHTML =myArray1[8];
				
				$('#id_Edit').data('id',myArray1[0]);
				$('#id_Delete').data('id',myArray1[0]);
			
    		}
			
  		};	
		
    xhttp.open("GET", "../model/get_teacher.php?id=" + Id , true);												
  	xhttp.send();//MSK-00149--End Ajax
	 
};
  
</script>

	<div id="salary_details">
    
    </div>
    
    <div id="salary_details2">
    
    </div>
    
<script>
function addSalary(viewTSalary){
	
	var myArray=$(viewTSalary).data('id').split(',');
	
	var index = myArray[0];
	var id = myArray[1];
	
	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);

	var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('salary_details').innerHTML = this.responseText;
				$("#modalviewSalary").data('id',index).modal('show');
				
				var lastPaid = document.getElementById('lastPaid').innerHTML.replace("$", " ");
				var cSalary = document.getElementById('currentSalary').innerHTML.replace("$", " ");
				
				if(lastPaid == 0){
					
					document.getElementById('lastPayment').innerHTML = "You did not attend on last month..!";
					document.getElementById('tSalary_lMonth').innerHTML = "No Data...!";
					document.getElementById('lastPaid').innerHTML = "No Data...!";
				}
				
				if(cSalary == 0){
					document.getElementById('currentSalary').innerHTML = "You have not any Classroom..!";
					document.getElementById('currentPaid').innerHTML = "No Data...!";
					document.getElementById('dueAmount').innerHTML = "No Data...!";
					$("#btnPaid").attr("disabled",true);
				}
				
				
				var today = new Date();
				var SalaryGDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+5;
				var date = today.getDate();
				var d1 = 5;
				if(d1 < 5){
					
					document.getElementById('currentSalary').innerHTML="Your Salary will genarate on"+SalaryGDate;//7th July 2017 kiyala hadaganna balanna
					document.getElementById('currentPaid').innerHTML = "No Data..!";
					document.getElementById('dueAmount').innerHTML = "No Data..!";
					
					$("#btnPaid").attr("disabled",true);
				}
				
				var due = document.getElementById('dueAmount').innerHTML.replace("$", "");
				
				if(due == 0){
					$("#btnPaid").attr("disabled",true);
					document.getElementById('dueAmount').innerHTML = 0;
				}
				var currentPaid = document.getElementById('currentPaid').innerHTML.replace("$", "");
				
				if(currentPaid == " "){
					
					document.getElementById('currentPaid').innerHTML = 0;
				}
				
				
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_details.php?index=" + index + "&teacher_id="+id + "&page="+currentPage , true);												
  		xhttp.send();
}

function addSalary1(){
	
	var index = $("#index_number").val();
	var id = $("#teacher_id").val();
	var page = $("#cPage").val();
	
	var xhttp = new XMLHttpRequest();//MSK-00116-Ajax Start
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				document.getElementById('salary_details2').innerHTML = this.responseText;	
				$("#modalviewSalary").modal('hide');	
				$("#modalviewSalary1").modal('show');//modal eka meaningful ekak denna.
				
				var d = new Date();
				var day_no = d.getDate();
				
				if(day_no < 25){
					$("#type option[value='Balance']").hide();
					$("#type option[value='Total Salary']").hide();
				}
				
				if(document.getElementById('desc') != null){
					var desc = document.getElementById('desc').innerHTML;
				}
				
				if(document.getElementById('desc') == null){
					$("#type option[value='Balance']").hide();
				}
				
				if(desc =="Total Salary"){
					
					 $("#type option[value='Balance']").hide();
		
				}
				
				if(desc =="Advance"){
					
					 $("#type option[value='selectType']").hide();
					 $("#type option[value='Advance']").hide();
					 $("#type option[value='Total Salary']").hide();
					 $('#type').val('Balance');
		
				}	
				
				if(desc =="Balance"){ 
					
					 $("#type option[value='Balance']").hide();
					
				}
				
				var status = $('#type').val();
				var tSalary = $('#tBody td:last').text().replace("$", "");
				
				if(status == "Balance"){
					
					if(day_no < 25){
						$("#btnSubmit").attr("disabled", true);
					}
					var cPaid = document.getElementById('cPaid').innerHTML;
					var tSalary = $('#tBody td:last').text().replace("$", "");
						
					$('#amount').val(tSalary - cPaid);
				}
				
				$('#type').change(function () {
					
					var status = $('#type').val();
					var tSalary = $('#tBody td:last').text().replace("$", "");
					
					$('#spanAmount').remove();
					$('#divAmount').removeClass('has-success has-feedback');
					$('#divAmount').removeClass('has-error has-feedback');
					$("#btnSubmit").attr("disabled", false);
					
					$('#amount').val('');
					
					if(status == "Total Salary"){
						$('#amount').val(tSalary);
					}
					
					if(status == "Advance"){
						$('#amount').val(tSalary/2);
					}
					
				});
				
				$("#amount").keydown(function(){
							
					var status = $('#type').val();
							
					if(status == "Total Salary"){
								
						var tSalary = $('#tBody td:last').text().replace("$", "");	
						
						setTimeout(function() {
							var amount = $('#amount').val();// this is the value after the keypress
										
							if(amount != tSalary){
											
								$('#spanAmount').remove();
								$('#divAmount').removeClass('has-success has-feedback');
								$('#divAmount').addClass('has-error has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The amount is not equal to Total Salary" ></span>');
								$("#btnSubmit").attr("disabled", true);
								
							}else{
								$("#btnSubmit").attr("disabled", false);
								$('#divAmount').removeClass('has-error has-feedback');
								$('#spanAmount').remove();
								$('#divAmount').addClass('has-success has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-ok form-control-feedback"></span>');
							
							}
							
						}, 0);		
					}
					
					if(status == "Advance"){
								
						var tSalary = $('#tBody td:last').text().replace("$", "");	
						var maxAdvance = tSalary/2; 
						setTimeout(function() {
							var amount = $('#amount').val();// this is the value after the keypress
										
							if(amount > maxAdvance){
											
								$('#spanAmount').remove();
								$('#divAmount').removeClass('has-success has-feedback');
								$('#divAmount').addClass('has-error has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The advace eka wadiy" ></span>');
								$("#btnSubmit").attr("disabled", true);
								
							}else{
								$("#btnSubmit").attr("disabled", false);
								$('#divAmount').removeClass('has-error has-feedback');
								$('#spanAmount').remove();
								$('#divAmount').addClass('has-success has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-ok form-control-feedback"></span>');
							
							}
							
							if(amount == ""){
											
								$('#spanAmount').remove();
								$('#divAmount').removeClass('has-success has-feedback');
								$('#divAmount').addClass('has-error has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The advace eka wadiy" ></span>');
								$("#btnSubmit").attr("disabled", true);
								
							}
							
						}, 0);
						
					}
					
					if(status == "Balance"){
						
						var cSalary = $('#tBody td:last').text().replace("$", "");
						var cPaid = document.getElementById('cPaid').innerHTML;
						var cBalance = cSalary - cPaid;
						
						setTimeout(function() {
							var amount = $('#amount').val();// this is the value after the keypress
										
							if(amount != cBalance){
											
								$('#spanAmount').remove();
								$('#divAmount').removeClass('has-success has-feedback');
								$('#divAmount').addClass('has-error has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The amount is not equal to Total Salary" ></span>');
								$("#btnSubmit").attr("disabled", true);
								
							}else{
								$("#btnSubmit").attr("disabled", false);
								$('#divAmount').removeClass('has-error has-feedback');
								$('#spanAmount').remove();
								$('#divAmount').addClass('has-success has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-ok form-control-feedback"></span>');
							
							}
							
						}, 0);		
					}			
							
				});
						
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_details2.php?index=" + index + "&teacher_id="+id + "&page="+page , true);//MSK-00116-Ajax End											
  		xhttp.send();
	
};
</script>
	
	<div id="show_INV">
        
    </div>
	
<script>

function printINV(id,invoice_number,desc,total_salary,paid){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-00150
				document.getElementById('show_INV').innerHTML = this.responseText;
				$('#modalINV').modal('show');
				if(desc == 'Advance'){
					$('#trBalance').hide();
					document.getElementById('spanTotal').innerHTML='NaN';
					document.getElementById('spanBalance').innerHTML='NaN';
				}
				if(desc == 'Total Salary'){
					$('#trBalance').hide();
					document.getElementById('spanAdvance').innerHTML=0;
					
				}
				if(desc == 'Balance'){
					$('#trBalance').show();
					document.getElementById('countBalance').innerHTML=2;
				}
				window.print(); 	
				$('#modalINV').modal('hide');
				
				var myModal = $('#insert_Success');
					myModal.modal('show');//MSK-000145
					
					myModal.data('hideInterval', setTimeout(function(){
    					myModal.modal('hide');
				
    			}, 3000));
    		}
			
  		};	
		
    xhttp.open("GET", "teacher_salary_invoice.php?teacher_id=" + id + "&invoice_number="+invoice_number + "&desc="+desc + "&total_salary="+total_salary + "&paid="+paid, true);												
  	xhttp.send();//MSK-00149--End Ajax
}

</script>

<!-- table for view all records -->
    <section class="content" id="tSalaryhistory"> <!-- Start of table section -->
    	<div class="row" id="table2"><!--MSK-000112--> 
           
        </div>
    </section> <!-- End of table section -->
    
    <div id="salaryDetails">
    
    </div>
    
    <div id="viewInvoice">
    
    </div>


<script>
function viewPayments(salaryHistory){
	
	var index = $(salaryHistory).data('id');
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('table2').innerHTML = this.responseText;//MSK-000137
				
				$(function () {
					$("#example2").DataTable();
				});		
				window.scrollTo(0,document.body.scrollHeight);	
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_history1.php?index=" + index , true);												
  		xhttp.send();//MSK-00105-Ajax End
	
};

function showModal2(sDetails){
//MSK-00104
	
	var myArray = $(sDetails).data("id").split(',');
	
	var index = myArray[0];
	var year  = myArray[1];
	var month = myArray[2]; 
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('salaryDetails').innerHTML = this.responseText;//MSK-000137
				$('#modalviewSalary2').modal('show');			
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_details3.php?index=" + index + "&year="+year  + "&month="+month , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
};

function showModal3(viewINV){
//MSK-00104
	
	var myArray = $(viewINV).data("id").split(','); 
	
	var index = myArray[0];
	var year  = myArray[1];
	var month = myArray[2];
	var count = myArray[3];
	
	var year =$('#td_year_'+count).text();
	var month =$('#td_month_'+count).text();
	var desc =$('#td_status_'+count).text();
	var paid =$('#td_paid_'+count).text();
	var date =$('#td_date_'+count).text();
	
		
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('viewInvoice').innerHTML = this.responseText;//MSK-000137
				$('#modalINV1').modal('show');	
				
				
				if(desc == 'Advance'){
					
					$('#trBalance1').hide();
					document.getElementById('spanTotal1').innerHTML = 'NaN';
					document.getElementById('spanBalance1').innerHTML = 'NaN';
				}
				if(desc == 'Total Salary'){
					$('#trBalance1').hide();
					document.getElementById('spanAdvance1').innerHTML = 0;
					
				}
				if(desc == 'Balance'){
					$('#trBalance1').show();
					document.getElementById('countBalance1').innerHTML=2;
				}	
					
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_invoice1.php?index=" + index  + "&desc="+desc + "&paid="+paid + "&year="+year  + "&month="+month  + "&date="+date   , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
};

function scrollDown(){
	
	window.scrollTo(0,document.body.scrollHeight);
}

</script>

<!--run Salary insert alert using PHP & JS/JQUERY  -->    
<?php
// MSK-000143-24-PHP-JS-UPDATE
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_salary_insert")){
  
$msg=$_GET['msg'];
$page=$_GET['page'];
$id=$_GET['teacher_id'];
$invoice_number=$_GET['invoice_number'];
$desc=$_GET['desc'];
$total_salary=$_GET['total_salary'];
$paid=$_GET['paid'];

	if($msg==1){
		
		echo '<script>','cTablePage('.$page.');','</script>';
		echo '<script>','printINV('.$id.','.$invoice_number.','.$desc.','.$total_salary.','.$paid.');','</script>';
		 
	}
	
	if($msg==2){
		
		echo '<script>','cTablePage('.$page.');','</script>';
		echo"
				<script>
				
				var myModal = $('#connection_Problem');
				myModal.modal('show');
				
				myModal.data('hideInterval', setTimeout(function(){
					myModal.modal('hide');
				}, 3000));
							
				</script>
			";
		 
	}
}

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
                             
<?php include_once('footer.php');?>