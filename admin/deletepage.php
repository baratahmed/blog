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
    if (!isset($_GET['delpage']) || $_GET['delpage']==NULL) {
        echo "<script>window.location = 'index.php';</script>";
        //header('Location:index.php');
    }else{
        $pageid = $_GET['delpage'];
        $delquery = "DELETE FROM tbl_page WHERE id = '$pageid'";
        $deldata = $db->delete($delquery);
        if ($deldata) {
        	echo "<script>alert('Page Deleted Successfully!!!');</script>";
        	echo "<script>window.location = 'index.php';</script>";
        }else{
        	echo "<script>alert('Page Not Deleted!!!');</script>";
        	echo "<script>window.location = 'index.php';</script>";
        }
    }
?>  