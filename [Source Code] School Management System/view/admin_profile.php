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

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	My Profile
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">My Profile</a></li>
    	</ol>
	</section>
    
<?php 
include_once('../controller/config.php');

$index=$_SESSION["index_number"];

$sql="SELECT * FROM admin WHERE index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$full_name=$row['full_name'];
$i_name=$row['i_name'];
$gender=$row['gender'];
$address=$row['address'];
$phone=$row['phone'];
$email=$row['email'];
$image=$row['image_name'];

$sql1="SELECT * FROM user WHERE email='$email'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);

$user_name=$row1['email'];
$password=$row1['password'];

?>
    
	<section class="content"> 
    	<div class="row">
        	<div class="col-md-7">
            	<div class="panel"><!--panel bg-maroon--> 
                	<div class="panel-heading bg-aqua-active">	
                    	<h4 class="panel-title" id="hname"><?php echo $i_name; ?></h4>
                    </div>				
                    <div class="panel-body"><!--panel-body -->
                    	<div class="row" id="my_profile">
                			<div class="col-md-3"> 
                				<img id="photo2" alt="User Pic" src="../<?php echo $image; ?>" class="img-circle img-responsive"> 
                			</div>
                			<div class=" col-md-9"> 
                  				<table class="table table-bordered table-striped">
                    				<tbody>
                      					<tr>
                        					<td class="col-md-4">Full Name</td>
                        					<td id="full_name"><?php echo $full_name; ?></td>
                      					</tr>
                      					<tr>
                        					<td>Name With Initials</td>
                        					<td id="i_name"><?php echo $i_name; ?> </td>
                      					</tr>
                             			<tr>
                        					<td>Address</td>
                        					<td id="address"><?php echo $address; ?> </td>
                      					</tr>
                        				<tr>
                        					<td>Gender</td>
                        					<td id="gender"><?php echo $gender; ?> </td>
                      					</tr>
                      					<tr>
                        					<td>Email</td>
                        					<td id="email"><?php echo $email; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>Phone Number</td>
                        					<td id="phone"><?php echo $phone; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>User Name</td>
                        					<td id="email"><?php echo $user_name; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>Password</td>
                        					<td id="phone"><?php echo $password; ?> </td>
                      					</tr>
                    				</tbody>
                  				</table>
                  			</div>
                   		</div>
                        <p class="alert-info" id="note1"><strong>Note: We get the email address for the user name.</strong></p>
                     </div>
                     <div class="panel-footer text-right" id="panel_footer" >
                    	<a href="#" onClick="editMyProfile('<?php echo $index; ?>')" type="button" class="btn btn-sm btn-warning" id="btnEdit"><i class="glyphicon glyphicon-edit"></i></a><!--MSK-00151-->
                        <input type="hidden" id="id1" value="">
                        <input type="hidden" id="i_path1" value="">
                        <span class="pull-right"></span>
                    </div>
            	</div><!--/. panel--> 
        	</div>
		</div><!--/.row --> 
	</section><!-- /.section -->
	
<script>

function editMyProfile(my_index){
	
	var xhttp = new XMLHttpRequest();//MSK-000131-Start Ajax  
		xhttp.onreadystatechange = function() {		
				
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('my_profile').innerHTML = this.responseText;//MSK-000132
										
				var xhttp1 = new XMLHttpRequest();//MSK-000131-Start Ajax  
					xhttp1.onreadystatechange = function() {		
							
						if (this.readyState == 4 && this.status == 200) {
													
							var myArray = eval(xhttp1.responseText);
							
							document.getElementById("id1").value =myArray[0];
							document.getElementById("full_name1").value =myArray[1];//MSK-000114
							document.getElementById("i_name1").value =myArray[2];//MSK-000114
							document.getElementById("gender2").value =myArray[3];//MSK-000114
							document.getElementById("address1").value =myArray[4];//MSK-000114
							document.getElementById("phone1").value =myArray[5];//MSK-000114
							document.getElementById("email1").value =myArray[6];//MSK-000114
							document.getElementById("profile_pic1").src ="../"+myArray[7];
							document.getElementById("user_name1").innerHTML =myArray[8];//MSK-000114
							document.getElementById("password1").value =myArray[9];//MSK-000114
							
							$("#panel_footer").hide();
							$("#note1").hide();
							
							$('[type="file"]').change(function (){
								
								var fileSize = this.files[0].size;	
								var maxSize = 1000000;// bytes
								var ext = $('#fileToUpload').val().split('.').pop().toLowerCase();
								var imageNoError = 0;
								
								if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
									//MSK-00099
									profile_pic1.src="../uploads/error.png";
									$("#btnUpdate").attr("disabled", true);
									$('#divPhoto').addClass('has-error has-feedback');
									$('#divPhoto').append('<span id="spanPhoto" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The file type is not allowed" ></span>');
									
								}else{
							
									if(fileSize > maxSize) {
										//MSK-00100
										profile_pic1.src="../uploads/error.png";
										$("#btnUpdate").attr("disabled", true);
										$('#divPhoto').addClass('has-error has-feedback');
										$('#divPhoto').append('<span id="spanPhoto1" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The file size is too large" ></span>');		
										
									}else{
										// MSK-00101
										profile_pic1.src = URL.createObjectURL(this.files[0]);	
										$('#divPhoto').removeClass('has-error has-feedback');
										$('#spanPhoto').remove();// MSK-00101
										$('#spanPhoto1').remove();// MSK-00101
										$("#btnUpdate").attr("disabled", false);
										$("#i_path1").val()=profile_pic1.src;
										
									}
								}

							});
							
							$("form").submit(function (e){
								
								var full_name = document.getElementById("full_name1").value;
								var i_name = document.getElementById("i_name1").value;
								var address = document.getElementById("address1").value;
								var phone = document.getElementById("phone1").value;
								var email = document.getElementById("email1").value;
								
								var password = document.getElementById("password1").value;
								
								var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;	
								var telformat = /\d{3}[\-]\d{3}[\-]\d{4}$/;
								
								if(full_name == ''){
									//MSK-00102-full_name 
									$("#btnUpdate").attr("disabled", true);
									//$('#tdFullName1').addClass('has-error has-feedback');
									$('#tdFullName2').addClass('has-error has-feedback');
									$('#tdFullName2').append('<span id="spanFullName" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip"    title="The full name is required" ></span>');	
										
									$("#full_name1").keydown(function(){
										//MSK-00103-full_name 
										$("#btnUpdate").attr("disabled",false);	
										$('#tdFullName2').removeClass('has-error has-feedback');
										$('#spanFullName').remove();
										
									});
							
								}else{
									
								}
	
								if(i_name == ''){
									//MSK-00102-full_name 
									$("#btnUpdate").attr("disabled", true);
									//$('#tdIName1').addClass('has-error has-feedback');
									$('#tdIName2').addClass('has-error has-feedback');
									$('#tdIName2').append('<span id="spanIName" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip"    title="The intial name is required" ></span>');	
										
									$("#i_name1").keydown(function(){
										//MSK-00103-full_name 
										$("#btnUpdate").attr("disabled",false);	
										$('#tdIName2').removeClass('has-error has-feedback');
										$('#spanIName').remove();
										
									});
							
								}else{
									
								}
	
								if(address == ''){
									//MSK-00102-full_name 
									$("#btnUpdate").attr("disabled", true);
									//$('#tdAddress1').addClass('has-error has-feedback');
									$('#tdAddress2').addClass('has-error has-feedback');
									$('#tdAddress2').append('<span id="spanAddress" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip"   title="The address is required" ></span>');	
										
									$("#address1").keydown(function(){
										//MSK-00103-full_name 
										$("#btnUpdate").attr("disabled",false);	
										$('#tdAddress2').removeClass('has-error has-feedback');
										$('#spanAddress').remove();
										
									});
							
								}else{
									
								}
	
								if(phone == ''){
									//MSK-00102-full_name 
									$("#btnUpdate").attr("disabled", true);
									//$('#tdPhone1').addClass('has-error has-feedback');
									$('#tdPhone2').addClass('has-error has-feedback');
									$('#tdPhone2').append('<span id="spanPhone" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip"   title="The phone number is required" ></span>');	
										
									$("#phone1").keydown(function(){
										//MSK-00103-full_name 
										$("#btnUpdate").attr("disabled",false);	
										$('#tdPhone2').removeClass('has-error has-feedback');
										$('#spanPhone').remove();
										
									});
							
								}else{
									
									if (telformat.test(phone) == false){ 
										//MSK-00104-phone
										$('#tdPhone2').addClass('has-error has-feedback');
										$('#tdPhone2').append('<span id="spanPhone" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip"    title="Enter valid phone number" ></span>');
										
										$("#phone1" ).keydown(function() {
											//MSK-00105-phone
											var $field = $(this);
											var beforeVal = $field.val();// this is the value before the keypress
								
											setTimeout(function() {
								
												var afterVal = $field.val();// this is the value after the keypress
												
													if (telformat.test(afterVal) == true){
														//MSK-00106-phone
														$("#btnUpdate").attr("disabled", false);
														$('#tdPhone2').removeClass('has-error has-feedback');
														$('#spanPhone').remove();
														$('#spanPhone').remove();
														$('#tdPhone2').addClass('has-success has-feedback');
														$('#tdPhone2').append('<span id="spanPhone" class="glyphicon glyphicon-ok form-control-feedback"></span>');
														
													}else{
														//MSK-00107-phone
														$("#btnUpdate").attr("disabled", true);
														$('#spanPhone').remove();
														$('#tdPhone2').addClass('has-error has-feedback');
														$('#tdPhone2').append('<span id="spanPhone" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip"    title="Enter valid phone number" ></span>');
												
													}
												
											}, 0);
													
										});
										
									}else{
										
									}
									
								}
	
								if(email == ''){
									//MSK-00102-full_name 
									$("#btnUpdate").attr("disabled", true);
									//$('#tdEmail1').addClass('has-error has-feedback');
									$('#tdEmail2').addClass('has-error has-feedback');
									$('#tdEmail2').append('<span id="spanEmail" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip"   title="The email address is required" ></span>');	
										
									$("#email1").keydown(function(){
										//MSK-00103-full_name 
										$("#btnUpdate").attr("disabled",false);	
										$('#tdEmail2').removeClass('has-error has-feedback');
										$('#spanEmail').remove();
										
									});
							
								}else{
									
									if (mailformat.test(email) == false){ 
										//MSK-00108-email
										$('#tdEmail2').addClass('has-error has-feedback');
										$('#tdEmail2').append('<span id="spanEmail" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip"    title="Enter valid email address" ></span>');
										
										$("#email1").keydown(function(){
											//MSK-00109-email
											var $field = $(this);// this is the value before the keypress
											var beforeVal = $field.val();
								
											setTimeout(function() {
								
												var afterVal = $field.val();// this is the value after the keypress
												
													if (mailformat.test(afterVal) == true){
														//MSK-00110-email
														$("#btnUpdate").attr("disabled", false);
														$('#tdEmail2').removeClass('has-error has-feedback');
														$('#spanEmail').remove();
														$('#tdEmail2').addClass('has-success has-feedback');
														$('#tdEmail2').append('<span id="spanEmail" class="glyphicon glyphicon-ok form-control-feedback"></span>');
														
													}else{
														//MSK-00111-email
														$("#btnUpdate").attr("disabled", true);
														$('#spanEmail').remove();
														$('#tdEmail2').addClass('has-error has-feedback');
														$('#tdEmail2').append('<span id="spanEmail" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip"    title="Enter valid email address" ></span>');
													
													}
												
											}, 0);
													
										});
										
									}else{
										
									}
			  
								}
	
								if(password == ''){
									//MSK-00102-full_name 
									$("#btnUpdate").attr("disabled", true);
									//$('tdPassword1').addClass('has-error has-feedback');
									$('#tdPassword2').addClass('has-error has-feedback');
									$('#tdPassword2').append('<span id="spanPassword" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip"   title="The password is required" ></span>');	
										
									$("#password1").keydown(function(){
										//MSK-00103-full_name 
										$("#btnUpdate").attr("disabled",false);	
										$('#tdPassword2').removeClass('has-error has-feedback');
										$('#spanPassword').remove();
										
									});
							
								}else{
									
								}
								
								if(full_name == '' || i_name == '' || address == '' || phone == '' || telformat.test(phone) == false || email == '' || mailformat.test(email) == false || password == ''){
								
									$("#btnUpdate").attr("disabled",true);	
									
									e.preventDefault();
									return false;
									
								}else{
									//We submit the form.		
								}
							});
						}
											
					};
						
					xhttp1.open("GET", "../model/get_admin_profile.php?my_index=" + my_index , true);												
					xhttp1.send();//MSK-000131-End Ajax
							
			}
								
		};
						
		xhttp.open("GET", "my_profile_update_form.php" , true);												
  		xhttp.send();//MSK-000131-End Ajax
		
};

</script>    


<?php
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_update")){
//MSK-000143-6-PHP-JS-INSERT
  
	$msg=$_GET['msg'];

	if($msg==1){
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

	if($msg==3){
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