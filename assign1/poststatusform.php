<?php
//All pages with appearance call "header.php" and "footer.php" to display the top and bottom side of the website.
include 'header.php';
?>

<div class="am-container" style="margin-top: 15px;">
    <?php
    //Check if there are error messages and display them, display nothing if error message doesn't exist.
    echo (!empty($_SESSION['notice_msg'])) ? '<div class="am-panel '.($_SESSION['notice_type'] == 'warning' ? 'am-panel-danger' : 'am-panel-success').'"><div class="am-panel-hd">Notice</div><div class="am-panel-bd">'.$_SESSION['notice_msg'].'</div></div>' : '';
        session_unset();
    session_destroy();
    ?>
    <form class="am-form am-form-horizontal" method="POST" action="poststatusprocess.php">

	<div class="am-form-group">
	    <label for="status_code" class="am-u-sm-3 am-form-label">Status Code <span class="am-icon-circle" style="color: #FF0000;"></span></label>
	    <div class="am-u-sm-9"><input name="status_code" id="status_code" type="text" placeholder="Please enter status code! e.g. S0001"></div>
	</div>

	<div class="am-form-group">
	    <label for="status" class="am-u-sm-3 am-form-label">Status <span class="am-icon-circle" style="color: #FF0000;"></span></label>
	    <div class="am-u-sm-9"><input name="status" id="status" type="text" placeholder="Please enter status!"></div>
	</div>

	<div class="am-form-group">
	    <label for="share" class="am-u-sm-3 am-form-label">Share</label>
	    <div class="am-u-sm-9">
		<label class="am-radio-inline"><input type="radio" name="share" value="Public" > Public</label>
		<label class="am-radio-inline"><input type="radio" name="share" value="Friends" > Friends</label>
		<label class="am-radio-inline"><input type="radio" name="share" value="Only Me" > Only Me</label>
	    </div>
	</div>

	<div class="am-form-group">
	    <label for="date" class="am-u-sm-3 am-form-label">Date</label>
	    <div class="am-u-sm-9">
		<input type="text" name="date" id="date" placeholder="Please choose date!" value="<?php echo date('d/m/Y'); ?>" data-am-datepicker="{format: 'dd/mm/yyyy'}" readonly>
	    </div>
	</div>

	<div class="am-form-group">
	    <label for="permission_type" class="am-u-sm-3 am-form-label">Permission Type</label>
	    <div class="am-u-sm-9">
		<label class="am-checkbox-inline"><input type="checkbox" name="permission_type[]" value="allow_like"> Allow Like</label>
		<label class="am-checkbox-inline"><input type="checkbox" name="permission_type[]" value="allow_comment"> Allow Comment</label>
		<label class="am-checkbox-inline"><input type="checkbox" name="permission_type[]" value="allow_share"> Allow Share</label>
	    </div>
	</div>

	<div class="am-form-group">
	    <div class="am-u-sm-9 am-u-sm-offset-3">
		<p class="am-text-sm">Notice: The fields marked <span class="am-icon-circle" style="color: #FF0000;"></span> are required!</p>
		<button type="submit" class="am-btn am-btn-default" style="margin-right: 15px;">Post</button><button type="reset" class="am-btn am-btn-default">Reset</button>
	    </div>
	</div>

    </form>
</div>

<?php
include 'footer.php';
?>
