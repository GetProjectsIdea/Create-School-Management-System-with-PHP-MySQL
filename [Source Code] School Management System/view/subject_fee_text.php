<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php 
if(isset($_GET["do"])&&($_GET["do"]=="show_subject_fee_text")){
$id=$_GET['id'];
$count=$_GET['count'];
$fee=$_GET['fee'];

?>

<td  id="td4_<?php echo $count; ?>"><input type="text" value="<?php echo $fee; ?>" style="width:40px;" id="sFeeText_<?php echo $count; ?>"></td>

<?php } ?>