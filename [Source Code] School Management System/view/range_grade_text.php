<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php 
if(isset($_GET["do"])&&($_GET["do"]=="show_range_grade_text")){
$id=$_GET['id'];
$count=$_GET['count'];
$range=$_GET['range'];
$grade=$_GET['grade'];

?>
<td  id="rangeU_td_<?php echo $count; ?>"><input type="text" value="<?php echo $range; ?>" style="width:40px;" id="rangeText_<?php echo $count; ?>"></td>
<td  id="gradeU_td_<?php echo $count; ?>"><input type="text" value="<?php echo $grade; ?>" style="width:40px;" id="gradeText_<?php echo $count; ?>"></td>
<td id="action_<?php echo $count; ?>">
	
</td>
<?php } ?>