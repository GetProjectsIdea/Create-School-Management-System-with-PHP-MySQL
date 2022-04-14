<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php 
if(isset($_GET["do"])&&($_GET["do"]=="show_exam_mark_text")){
$id=$_GET['id'];
$count=$_GET['count'];
//$range=$_GET['range'];
$mark=$_GET['mark'];

?>
<input type="text" value="<?php echo $mark; ?>" style="width:40px;" id="examMarkText_<?php echo $count; ?>">

<?php } ?>