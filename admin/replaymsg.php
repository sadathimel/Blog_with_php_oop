<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
    echo "<script>window.location = 'inbox.php'; </script> ";
}else {
    $id = $_GET['msgid'];
}
?>

    <div class="box round first grid">
        <h2>View Message</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $to         = $fm->validation($_POST['toEmail']);
                $from       = $fm->validation($_POST['fromEmail']);
                $subject    = $fm->validation($_POST['subject']);
                $message    = $fm->validation($_POST['message']);

                $sendmail   = mail($to, $subject, $message,$from);
                if ($sendmail) {
                    echo "<span class='success'>Message send Successfully.</span>";
                } else {
                    echo "<span class='error'>Somethig went wrong!</span>";
                }
            }
        ?>
        <div class="block">
            <form action="" method="post">
                <?php
                $query = "SELECT * FROM tbl_contact WHERE id = '$id'";
                $msg = $db->select($query);
                if ($msg) {
                    $i = 0;
                    while ($result = $msg->fetch_assoc()){
                        $i++;
                        ?>
                        <table class="form">
                            <tr>
                                <td>
                                    <label>To</label>
                                </td>
                                <td>
                                    <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>From</label>
                                </td>
                                <td>
                                    <input type="text" name="fromEmail" placeholder="Please Enter your Email Address" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Subject</label>
                                </td>
                                <td>
                                    <input type="text" name="subject" class="medium" placeholder="Please Enter your Subject" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Message</label>
                                </td>
                                <td>
                            <textarea class="tinymce" name="body">

                            </textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="send" />
                                </td>
                            </tr>
                        </table>
                    <?php } } ?>
            </form>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>



