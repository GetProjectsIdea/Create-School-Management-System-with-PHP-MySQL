<?php define('MAIN_INCLUDED', 1); ?>
<?php
$_arguments = array();
if(count($_POST) > 0){
	$_arguments = $_POST;
}else if(count($_GET) > 0){
	$_arguments = $_GET;
}

if(isset($_arguments["do"])&& ($_arguments["do"] != "")){
	if(($_arguments["do"] == "add_classroom")){//MSK-000143-add_classroom
		$page = "model/add_classroom.php";
	}else if(($_arguments["do"] == "add_grade")){//MSK-000143-add_grade
		$page = "model/add_grade.php";
	}else if(($_arguments["do"] == "add_subject")){//MSK-000143-add_subject
		$page = "model/add_subject.php";
	}else if(($_arguments["do"] == "add_teacher")){//MSK-000143-add_teacher
		$page = "model/add_teacher.php";
	}else if(($_arguments["do"] == "update_teacher")){//MSK-000143-update_teacher
		$page = "model/update_teacher.php";
	}else if(($_arguments["do"] == "add_subject_routing")){//MSK-000143-add_subject_routing
		$page = "model/add_subject_routing.php";
	}else if(($_arguments["do"] == "add_timetable")){//MSK-000143-add_timetable
		$page = "model/add_timetable.php";
	}else if(($_arguments["do"] == "update_timetable")){//MSK-000143-update_timetable
		$page = "model/update_timetable.php";
	}else if(($_arguments["do"] == "add_student")){//MSK-000143-add_student
		$page = "model/add_student.php";
	}else if(($_arguments["do"] == "update_student")){//MSK-000143-update_student
		$page = "model/update_student.php";
	}else if(($_arguments["do"] == "add_student_payment")){//MSK-000143-add_student_payment
		$page = "model/add_student_payment.php";
	}else if(($_arguments["do"] == "add_exam")){//MSK-000143-add_exam
		$page = "model/add_exam.php";
	}else if(($_arguments["do"] == "add_emarks_range_grade")){//MSK-000143-add_emarks_range_grade
		$page = "model/add_emarks_range_grade.php";
	}else if(($_arguments["do"] == "add_exam_timetable")){//MSK-000143-add_exam_timetable
		$page = "model/add_exam_timetable.php";
	}else if(($_arguments["do"] == "update_exam_timetable")){//MSK-000143-update_exam_timetable 
		$page = "model/update_exam_timetable.php";
	}else if(($_arguments["do"] == "add_student_exam_mark")){//MSK-000143-add_student_exam_mark 
		$page = "model/add_student_exam_mark.php";
	}else if(($_arguments["do"] == "add_student_exam_mark1")){//MSK-000143-add_student_exam_mark1 
		$page = "model/add_student_exam_mark1.php";
	}else if(($_arguments["do"] == "update_student_exam_mark")){//MSK-000143-update_student_exam_mark
		$page = "model/update_student_exam_mark.php";
	}else if(($_arguments["do"] == "update_student_exam_mark2")){//MSK-000143-update_student_exam_mark2
		$page = "model/update_student_exam_mark2.php";
	}else if(($_arguments["do"] == "add_teacher_salary")){//MSK-000143-add_teacher_salary add_attendents
		$page = "model/add_teacher_salary.php";
	}else if(($_arguments["do"] == "add_attendance")){//MSK-000143-add_attendance
		$page = "model/add_attendance.php";
	}else if(($_arguments["do"] == "user_login")){//MSK-000143-user_login
		$page = "model/user_login.php";
	}else if(($_arguments["do"] == "add_petty_cash")){//MSK-000143-add_petty_cash
		$page = "model/add_petty_cash.php";
	}else if(($_arguments["do"] == "add_events")){//MSK-000143-add_events 
		$page = "model/add_events.php";
	}else if(($_arguments["do"] == "update_events")){//MSK-000143-update_events
		$page = "model/update_events.php";
	}else if(($_arguments["do"] == "update_admin_profile")){//MSK-000143-update_admin_profile  
		$page = "model/update_admin_profile.php";
	}else if(($_arguments["do"] == "update_teacher_profile")){//MSK-000143-update_teacher_profile
		$page = "model/update_teacher_profile.php";
	}else if(($_arguments["do"] == "update_student_profile")){//MSK-000143-update_student_profile
		$page = "model/update_student_profile.php";
	}else if(($_arguments["do"] == "update_parents_profile")){//MSK-000143-update_parents_profile
		$page = "model/update_parents_profile.php";
	}else if(($_arguments["do"] == "add_group_message")){//MSK-000143-add_group_message
		$page = "model/add_group_message.php";
	}																				
}else{
	header("Location: view/login.php");
}
require $page;

?>


