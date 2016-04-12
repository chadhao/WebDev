<?php
include("header.php");
?>

<div class="am-container" style="margin-top: 15px;">
    <?php
	echo (!empty($_SESSION['notice_msg_search']))?'<div class="am-panel '.($_SESSION['notice_type_search']=='warning'?'am-panel-danger':'am-panel-success').'"><div class="am-panel-hd">Notice</div><div class="am-panel-bd">' . $_SESSION['notice_msg_search'] . '</div></div>':'';
        $_SESSION['notice_type_search'] = '';
	$_SESSION['notice_msg_search'] = '';
    ?>
    <form class="am-form am-form-horizontal" method="GET" action="searchstatusprocess.php">
	<div class="am-u-sm-8 am-u-sm-centered">
	    <div class="am-u-sm-10 am-center">
		<input name="search" id="search" type="text" placeholder="Please enter keyword">
	    </div>
	    <button class="am-btn am-btn-default" type="submit">Search</button>
	</div>
    </form>
    <div class="am-u-sm-8 am-u-sm-centered" style="margin-bottom: 15px;">
	<?php
	    if ( isset( $_SESSION['search_result_empty'] ) ) {
		if ( $_SESSION['search_result_empty'] == 1 ) {
		    echo '<h1 class="am-text-center">Result not found!</h1>';
		    session_unset();
		    session_destroy();
		}
	    }
	?>
    </div>
</div>

<?php
include("footer.php");
?>