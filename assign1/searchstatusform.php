<?php
include 'header.php';
?>

<div class="am-container" style="margin-top: 15px;">
    <?php
    echo (!empty($_SESSION['notice_msg_search'])) ? '<div class="am-panel '.($_SESSION['notice_type_search'] == 'warning' ? 'am-panel-danger' : 'am-panel-success').'"><div class="am-panel-hd">Notice</div><div class="am-panel-bd">'.$_SESSION['notice_msg_search'].'</div></div>' : '';
        $_SESSION['notice_type_search'] = '';
    $_SESSION['notice_msg_search'] = '';
    ?>
    <form class="am-form am-form-horizontal" method="GET" action="searchstatusprocess.php" style="margin-bottom: 15px;">
	<div class="am-u-sm-8 am-u-sm-centered">
	    <div class="am-u-sm-10 am-center">
		<input name="search" id="search" type="text" placeholder="Please enter keyword"<?php echo empty($_SESSION['search_keyword']) ? '' : (' value="'.$_SESSION['search_keyword'].'"');?>>
	    </div>
	    <button class="am-btn am-btn-default" type="submit">Search</button>
	</div>
    </form>
    <div class="am-u-sm-8 am-u-sm-centered">
	<?php
        if (isset($_SESSION['search_result_empty'])) {
            if ($_SESSION['search_result_empty'] == 1) {
                echo '<h3 class="am-text-center">Result not found for "'.$_SESSION['search_keyword'].'"!</h3>';
                session_unset();
                session_destroy();
            } else {
                $result = $_SESSION['search_result'];
                echo '<h3>'.count($result).' result(s) found for "'.$_SESSION['search_keyword'].'"</h3>';
                foreach ($result as $r) {
                    $date_added = DateTime::createFromFormat('Y-m-d', $r['date_added']);
                    $date_to_display = $date_added->format('d/m/Y');
                    echo '<div class="am-panel am-panel-secondary">';
                    echo '<header class="am-panel-hd"><h3 class="am-panel-title">'.$r['status_code'].'</h3><small><span class="am-badge am-badge-secondary am-round">'.$r['share'].'</span> <span class="am-badge am-badge-secondary am-round">'.$date_to_display.'</span></small></header>';
                    echo '<div class="am-panel-bd">'.$r['status'].'<br>';
                    echo '<small>';
                    echo 'Allow like: '.($r['allow_like'] ? '<span class="am-icon-check"></span>' : '<span class="am-icon-close"></span>');
                    echo ' / Allow comment: '.($r['allow_comment'] ? '<span class="am-icon-check"></span>' : '<span class="am-icon-close"></span>');
                    echo ' / Allow share: '.($r['allow_share'] ? '<span class="am-icon-check"></span>' : '<span class="am-icon-close"></span>');
                    echo '</small></div>';
                    echo '</div>';
                }
                session_unset();
                session_destroy();
            }
        }
    ?>
    </div>
</div>

<?php
include 'footer.php';
?>
