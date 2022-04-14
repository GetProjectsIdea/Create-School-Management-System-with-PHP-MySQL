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

.msk-modal-content {
   
   position: absolute;
   left: 125px; 
   
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
  	left: 18%; 

}

.modal-content3 {
	
  	height: auto;
  	min-height: 100%;
  	border-radius: 0;
  	position: absolute;
  	left: -14%; 

}

.noScroll{
	
	overflow-y:hidden;	
	
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

@media print{

	body{
		
		visibility: hidden;
	
	}

	#modalINV{
		
	   visibility: visible;
	
	}

	

}

#modalINV .pdetail1 {
	
	padding:0;
	float:right;
	margin-right:7px; 
	
}

#modalINV .pdetail2 {
	
	float: right;
	
}


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

@media print{
	
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
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Student
        	<small>Payment</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Student Payment</a></li>
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
                  		<h3 class="box-title">Add Payment</h3>
                	</div><!-- /.box-header -->
                  		<div class="box-body">
                    		<div class="form-group" id="divIndex">
                      			<label for="">Index Number</label>
                      			<input type="text" class="form-control" id="index_number" placeholder="Enter index number" name="index_number" autocomplete="off" onChange="this.value">
                    		</div>
                  		</div><!-- /.box-body -->
                  		<div class="box-footer">
                    		<button type="button" class="btn btn-primary" id="btnSubmit" onClick="showPayment(this)">Submit</button>
                  		</div>
				</div><!-- /.box -->
			</div>
		</div>
	</section><!-- End of form section -->
      
    <div id="payment_details">
    
    </div>
    
     <div id="payment_details1">
    
    </div>
  
<script>

function showPayment(){
	
	var index=$("#index_number").val();
	var currentPage=0;
	
	if(index == ''){
		//MSK-00099-name
		$("#btnSubmit").attr("disabled", true);
		$('#divIndex').addClass('has-error has-feedback');	
		$('#divIndex').append('<span id="spanIndex" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The index number is required" ></span>');	
			
		$("#index_number").keydown(function() {
			//MSK-00100-name
			$("#btnSubmit").attr("disabled", false);	
			$('#divIndex').removeClass('has-error has-feedback');
			$('#spanIndex').remove();
			
		});	
		
	}

	if(index == ''){
		//MSK-000098- form validation failed
		$("#btnSubmit").attr("disabled", true);
		e.preventDefault();
		return false;
			
	}else{
		
		$("#btnSubmit").attr("disabled", false);
		
		var xhttp1 = new XMLHttpRequest();
			xhttp1.onreadystatechange = function() {
			
				if(this.readyState == 4 && this.status == 200) {
					var myArray = eval( xhttp1.responseText );
					
					if(myArray == 1){
						
						var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								
								if (this.readyState == 4 && this.status == 200) {
									
									document.getElementById('payment_details').innerHTML = this.responseText;
									$("#modalviewPayment").data('id',index).modal('show');
									
									var lastPaid = document.getElementById('lastPaid').innerHTML.replace("$", " ");
									var dueAmount = document.getElementById('dueAmount').innerHTML.replace("$", " ");
									var currentPaid = document.getElementById('currentPaid').innerHTML.replace("$", "");
									
									if(lastPaid == 0){
										document.getElementById('lastMonth').innerHTML = "You did not attend on last month..!";
										document.getElementById('mFee_lMonth').innerHTML = "No Data...!";
										document.getElementById('lastPaid').innerHTML = "No Data...!";
									}
									
									if(dueAmount == 0){
										document.getElementById('dueAmount').innerHTML = 0;
										
									}
									
									if(currentPaid == " "){
										
										document.getElementById('currentPaid').innerHTML = 0;
										
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
							
							xhttp.open("GET", "student_payment_details.php?index=" + index + "&page="+currentPage , true);												
							xhttp.send();
						
					}
					
					if(myArray == 2){
						var myModal = $('#wrong_Index');
							myModal.modal('show');
				
						myModal.data('hideInterval', setTimeout(function(){
							myModal.modal('hide');
						}, 3000));
					}
					
				}
				
			};	
			
			xhttp1.open("GET", "../model/get_student1.php?index=" + index , true);												
			xhttp1.send();
		
	}
	

};

function addPayment(sIndex){
	
	var index = $("#index_number").val();
	var page = $("#cpage").val();
	
	var xhttp = new XMLHttpRequest();//MSK-00116-Ajax Start
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('payment_details1').innerHTML = this.responseText;	
				$("#modalviewPayment").modal('hide');	
				$("#modalviewPayment1").modal('show');
				
				var MFee = $('#tBody td:last').text();//.replace("$", "");
				$("#type option[value='selectType']").hide();
				$('#type').val('Monthly Fee');
				$('#amount').val(MFee);
				
				$("#amount").keydown(function(){
							
					setTimeout(function() {
							var amount = $('#amount').val();// this is the value after the keypress
										
							if(amount != MFee){
											
								$('#spanAmount').remove();
								$('#divAmount').removeClass('has-success has-feedback');
								$('#divAmount').addClass('has-error has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-remove form-control-feedback msk-set-width-tooltip" data-toggle="tooltip" title="The amount is not equal to Monthly Fee" ></span>');
								$("#btnSubmit").attr("disabled", true);
								
							}else{
								$("#btnSubmit").attr("disabled", false);
								$('#divAmount').removeClass('has-error has-feedback');
								$('#spanAmount').remove();
								$('#divAmount').addClass('has-success has-feedback');
								$('#divAmount').append('<span id="spanAmount" class="glyphicon glyphicon-ok form-control-feedback"></span>');
							
							}
							
						}, 0);		
					});
					
					
				}
							
			
  		};	
		
    	xhttp.open("GET", "student_payment_details4.php?index=" + index + "&page="+page , true);//MSK-00116-Ajax End											
  		xhttp.send();
	
};

</script>
	<br><br><br>
	<section class="content">
        <div id="show_INV">
            
        </div>
	</section>
    
<script>

function printINV(index,invoice_number,desc,monthly_fee,paid){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-00150
				document.getElementById('show_INV').innerHTML = this.responseText;
				$('#modalINV').modal('show');
				
				setTimeout(function() {
					
					window.print(); 
					$('#modalINV').modal('hide');
					
					var myModal = $('#insert_Success');
					myModal.modal('show');//MSK-000145
					
					myModal.data('hideInterval', setTimeout(function(){
    					myModal.modal('hide');
				
    				}, 3000));
					
						
				}, 10);	
				
    		}
			
  		};	
		
    xhttp.open("GET", "student_payment_invoice.php?index=" + index + "&invoice_number="+invoice_number + "&desc="+desc + "&monthly_fee="+monthly_fee + "&paid="+paid, true);												
  	xhttp.send();//MSK-00149--End Ajax
}

</script>

<?php
// MSK-000143-24-PHP-JS-UPDATE
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_payment_insert")){
  
$msg=$_GET['msg'];
$page=$_GET['page'];
$index=$_GET['index'];
$invoice_number=$_GET['invoice_number'];
$desc=$_GET['desc'];
$monthly_fee=$_GET['monthly_fee'];
$paid=$_GET['paid'];
$grade=$_GET['grade'];


	if($msg==1){
		
		echo '<script>','printINV('.$index.','.$invoice_number.','.$desc.','.$monthly_fee.','.$paid.');','</script>';
		 
	}
	
	if($msg==2){
		
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