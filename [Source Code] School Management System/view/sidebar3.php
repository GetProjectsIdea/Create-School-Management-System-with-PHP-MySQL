<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
<?php
include_once('../controller/config.php');

$index=$_SESSION["index_number"];

$sql="SELECT * FROM parents WHERE index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
$image=$row['image_name'];

?>      
      
      <div class="user-panel">
      	<div class="pull-left image">
        	<img src="../<?php echo $image; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        	<p><?php echo $name; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="dashboard3.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="parents_profile.php"><i class="fa fa-circle-o"></i> My Profile</a></li>
            <li><a href="my_sons_profile.php"><i class="fa fa-circle-o"></i> My Son's Profiler</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Teacher</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="my_sons_teacher.php"><i class="fa fa-circle-o"></i> My Son's Teacher</a></li>
            <li><a href="all_teacher3.php"><i class="fa fa-circle-o"></i> All Teacher</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Subject</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="my_sons_subject.php"><i class="fa fa-circle-o"></i> My Son's Subject</a></li>
            <li><a href="all_subject3.php"><i class="fa fa-circle-o"></i> All Subject</a></li>
          </ul>
        </li>
         
         <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar-plus-o"></i>
            <span>Timetable</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="my_sons_timetable.php"><i class="fa fa-circle-o"></i> My Son's Timetable</a></li>
            <li><a href="all_timetable3.php"><i class="fa fa-circle-o"></i>All Timetable</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar-check-o"></i>
            <span>Attendance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="my_sons_attendance.php"><i class="fa fa-circle-o"></i> My Son's Attendance</a></li>
            <li><a href="my_sons_attendance_history.php"><i class="fa fa-circle-o"></i> My Son's Attendance History</a></li>
          </ul>
        </li>
         <li>
          <a href="my_sons_payments.php">
            <i class="fa fa-money"></i> <span>My Son's Payments</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-certificate"></i>
            <span>Exam</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="my_sons_exam_marks.php"><i class="fa fa-circle-o"></i> My Son's Exam Marks</a></li>
            <li><a href="my_sons_exam_marks_history.php"><i class="fa fa-circle-o"></i> My Son's  Exam Marks History</a></li>
            <li><a href="my_sons_exam_timetable.php"><i class="fa fa-circle-o"></i>My Son's Exam Timetable</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>