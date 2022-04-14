<?php include_once('head.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Classroom 
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Classroom</li>
          </ol>
        </section>
 <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Classroom</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="index.php" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter classroom name" name="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Student Count</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter student count" name="student_count">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Hall Charge</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter hall charge" name="hall_charge">
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                
                </div>
              </div>
         	</div>
         </section><!-- End of form section tag -->   

                                                      
<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">All Classroom</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	<!-- table start here -->
                	<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	
                        <th>ID</th>
                        <th>Classroom Name</th>
                        <th>Hall Charge</th>
                        <th>Student Count</th>
                      </tr>
                    </thead>
                    <tbody> 
<?php
include_once('config.php');

$sql="SELECT * FROM class_room";
$result = mysqli_query($conn,$sql);
$count=0;
while($row=mysqli_fetch_assoc($result)){
$count++;	
?>

						<tr>
                        	 <td> <?php echo $count; ?>  </td>
                            <td> <?php echo $row['name']; ?> </td>
                            <td> <?php echo $row['student_count']; ?> </td>
                            <td> <?php echo $row['hall_charge']; ?> </td>                  
                        </tr>
 <?php
 }
 ?>                          
                    </tbody>
                    <tfoot>
                   </tfoot>
                  </table>
                
                </div>
              </div>
             </div>
            </div>
          </section>
                
  </div><!-- /.content-wrapper -->        

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    
<?php include_once('footer.php'); ?>


    
    
    
    
    
    
    