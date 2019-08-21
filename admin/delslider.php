<?php
    include '../lib/Session.php';
    Session::checkSession();
?>
<?php
    include '../config/config.php';
    include '../lib/Database.php';
    $db = new Database();
?>
<?php
    if (!isset($_GET['sliderid']) || $_GET['sliderid']==NULL) {
        echo "<script>window.location = 'sliderlist.php';</script>";
        //header('Location:sliderlist.php');
    }else{
        $sliderid = $_GET['sliderid'];
        $query = "SELECT * FROM tbl_slider WHERE id='$sliderid'";
        $getData = $db->select($query);
        if ($getData) {
        	while ($delimg = $getData->fetch_assoc()) {
        		$dellink = $delimg['image'];
        		unlink($dellink);
        	}
        }
        $delquery = "DELETE FROM tbl_slider WHERE id = '$sliderid'";
        $deldata = $db->delete($delquery);
        if ($deldata) {
        	echo "<script>alert('Slider Deleted Successfully!!!');</script>";
        	echo "<script>window.location = 'sliderlist.php';</script>";
        }else{
        	echo "<script>alert('Slider Not Deleted!!!');</script>";
        	echo "<script>window.location = 'sliderlist.php';</script>";
        }
    }
?>  