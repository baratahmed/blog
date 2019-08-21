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
    if (!isset($_GET['delpostid']) || $_GET['delpostid']==NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
        //header('Location:postlist.php');
    }else{
        $postid = $_GET['delpostid'];
        $query = "SELECT * FROM tbl_post WHERE id='$postid'";
        $getData = $db->select($query);
        if ($getData) {
        	while ($delimg = $getData->fetch_assoc()) {
        		$dellink = $delimg['image'];
        		unlink($dellink);
        	}
        }
        $delquery = "DELETE FROM tbl_post WHERE id = '$postid'";
        $deldata = $db->delete($delquery);
        if ($deldata) {
        	echo "<script>alert('Data Deleted Successfully!!!');</script>";
        	echo "<script>window.location = 'postlist.php';</script>";
        }else{
        	echo "<script>alert('Data Not Deleted!!!');</script>";
        	echo "<script>window.location = 'postlist.php';</script>";
        }
    }
?>  