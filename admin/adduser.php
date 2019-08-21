<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    if (!Session::get('userRole') == '0') {
        echo "<script>window.location = 'index.php';</script>";
    }
?>
<div class="grid_10">		
    <div class="box round first grid">
        <h2>Add New User</h2>
       <div class="block copyblock"> 
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $fm->validation($_POST['name']);
                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $email = $fm->validation($_POST['email']);
                $details = $fm->validation($_POST['details']);
                $role = $fm->validation($_POST['role']);
                $name = mysqli_real_escape_string($db->link,$name);
                $username = mysqli_real_escape_string($db->link,$username);
                $password = mysqli_real_escape_string($db->link,$password);
                $email = mysqli_real_escape_string($db->link,$email);
                $details = mysqli_real_escape_string($db->link,$details);
                $role = mysqli_real_escape_string($db->link,$role);
                if (empty($name) || empty($username) || empty($password) || empty($role) || empty($email) || empty($details)) {
                    echo "<span class='error'>Field must not be empty!!!</span><br>";
                }
                $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
                $mailcheck = $db->select($mailquery);
                if ($mailcheck != FALSE) {
                    echo "<span class='error'>Email Already Exists!!!</span><br>";
                }
                elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<span class='error'>Email Address is invalid!!!</span><br>";
                }
                else{
                    $query = "INSERT INTO tbl_user(name,username,password,email,details,role) VALUES('$name','$username','$password','$email','$details','$role')";
                    $insertuser = $db->insert($query);
                    if ($insertuser) {
                        echo "<span class='success'>User inserted successfuly!!!</span>";
                    }else{
                        echo "<span class='error'>user not inserted!!!</span>";
                    }
                }
            }
        ?>
         <form action="" method="post">
            <table class="form">	
            <tr>
                    <td>
                        <label>Name: </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Name..." class="medium" name="name" />
                    </td>
                </tr>				
                <tr>
                    <td>
                        <label>Username: </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Username..." class="medium" name="username" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password: </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Password..." class="medium" name="password" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email: </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Email Address..." class="medium" name="email" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Details: </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Details..." class="medium" name="details" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>User Role: </label>
                    </td>
                    <td>
                        <select id="select" name="role">
                            <option>Select User Role</option>
                            <option value="0">Admin</option>
                            <option value="1">Author</option>
                            <option value="2">Editor</option>
                        </select>
                    </td>
                </tr>
				<tr> 
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>lude 'inc/footer.php';?>