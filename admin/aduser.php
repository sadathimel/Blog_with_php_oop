<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
    <div class="grid_10">

        <div class="box round first grid">
            <h2>Add New User</h2>
           <div class="block copyblock">

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $role     = $fm->validation($_POST['role']);

                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, $password);
                $role     = mysqli_real_escape_string($db->link, $role);
                if (empty($username) || empty($password) || empty($role)) {
                    echo "<span class='error'>Field must not be empty !</span>";
                }else{
                    $query = "INSERT INTO tbl_user(username, password, role) VALUES('$username','$password','$role')";
                     $cateinsert = $db->insert($query);
                     if ($cateinsert){
                         echo "<span class='success'>User created Successfully.</span>";
                     }else{
                         echo "<span class='error'>user not created.</span>";
                     }
                }
            }
        ?>
             <form action = "" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Username Name..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option value="">Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
    </div>
    <div class="clear">
    </div>
</div>

<?php include 'inc/footer.php'; ?>
