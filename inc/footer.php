	</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
<?php 
    $query = "SELECT * FROM tbl_footer WHERE id='1'";
    $copyright = $db->select($query);
    if ($copyright) {
    while ($result = $copyright->fetch_assoc()) {
?> 
	  <p>&copy; <?php echo $result['note']," ",date('Y');?></p>
<?php } } ?>
	</div>
	<div class="fixedicon clear">
<?php 
	$query = "SELECT * FROM tbl_social WHERE id='1'";
	$blog_title = $db->select($query);
	if ($blog_title) {
	while ($result = $blog_title->fetch_assoc()) {
?> 
		<a href="<?php echo $result['fb'];?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['tw'];?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['ln'];?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['gp'];?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
<?php } } ?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>