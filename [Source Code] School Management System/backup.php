<script>

							if(status == "Total Salary"){
								
								alert('ouw ouw ethin Total Salary');
								var tSalary = $('#tBody td:last').text().replace("$", "");
								$('#amount').val(tSalary);	
								
							}










							setTimeout(function() {
									
									var amount = $('#amount').val();// this is the value after the keypress
									
									if(amount != tSalary){
										//alert('payyakda karanna yanne');
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




</script>