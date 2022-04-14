<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<form action="../index.php" method="POST" enctype="multipart/form-data" >
	<div class="panel-body"><!--panel-body -->
    	<div class="row">
            <div class="col-md-4" id="divPhoto"> 
                <img id="profile_pic1" alt="User Pic" src="" class="img-circle img-responsive">
                <input type="file" name="fileToUpload" id="fileToUpload" style="margin-top:7px;"  /> 
            </div>
            <div class=" col-md-8"> 
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr id="trFullName">
                            <td class="col-md-4" id="tdFullName1">Full Name</td>
                            <td id="tdFullName2" ><input type="text" class="form-control" value="" name="full_name" id="full_name1" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td id="tdIName1">Name With Initials</td>
                            <td id="tdIName2"><input type="text" class="form-control" value="" name="i_name" id="i_name1" autocomplete="off"> </td>
                        </tr>
                        <tr>
                            <td id="tdAddress1">Address</td>
                            <td id="tdAddress2"><input type="text" class="form-control" value="" name="address" id="address1" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td id="tdGender1">Gender</td>
                            <td id="tdGender2">
                                <select name="gender" class="form-control" id="gender2">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td id="tdEmail1">Email</td>
                            <td id="tdEmail2"><input type="text" class="form-control" value="" name="email" id="email1" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td id="tdPhone1">Phone Number</td>
                            <td id="tdPhone2"><input type="text" class="form-control" value="" name="phone" id="phone1" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td>User Name</td>
                            <td id="user_name1"> </td>
                        </tr>
                        <tr>
                            <td id="tdPassword1">Password</td>
                            <td id="tdPassword2"><input type="password" class="form-control" value="" name="password" id="password1" autocomplete="off"></td>
                        </tr>
                    </tbody>
                </table>
            </div>  
		</div>
         <p class="alert-info"><strong>Note: We get the email address for the user name.</strong></p>
	</div><!--panel-body -->  
    <div class="panel-footer text-right">
        <input type="hidden" id="id1" name="id" value="">
        <input type="hidden" name="do" value="update_teacher_profile">
        <button type="submit" class="btn btn-warning " id="btnUpdate">Update</button>
        <span class="pull-right"></span>
    </div>   
</form>                                      