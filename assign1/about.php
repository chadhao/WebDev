<?php
include 'header.php';
?>
<div class="am-container" style="margin-top: 15px;">
    <div class="am-panel-group" id="accordion">
	<div class="am-panel am-panel-default">
	    <div class="am-panel-hd">
		<h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-1'}">What special features have you done, or attempted, in creating the site that we should know about?<span class="am-icon-chevron-down am-fr"></span></h4>
	    </div>
	    <div id="do-not-say-1" class="am-panel-collapse am-collapse am-in">
		<div class="am-panel-bd">
		    1. Use class to handle data related operations.<br>
		    2. Use PDO instead of mysqli to handle database connection.<br>
		    3. Use session to pass error messages and search result from process pages to form pages.
		</div>
	    </div>
	</div>

	<div class="am-panel am-panel-default">
	    <div class="am-panel-hd">
		<h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-2'}">Which parts did you have trouble with?<span class="am-icon-chevron-down am-fr"></span></h4>
	    </div>
	    <div id="do-not-say-2" class="am-panel-collapse am-collapse am-in">
		<div class="am-panel-bd">
		    While I was writing the DB class, I constantly got an error when I tried to establish a database connection.<br>
		    Later I found that, I checked a method return directly by empty(). It turned out empty() can check only variables.<br>
		    So I assigned the method return value to a variable to fix this bug.
		</div>
	    </div>
	</div>

	<div class="am-panel am-panel-default">
	    <div class="am-panel-hd">
		<h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-3'}">What would you like to do better next time?<span class="am-icon-chevron-down am-fr"></span></h4>
	    </div>
	    <div id="do-not-say-3" class="am-panel-collapse am-collapse am-in">
		<div class="am-panel-bd">
		    Maybe I'll try to structure my site by using MVC pattern next time.
		</div>
	    </div>
	</div>

	<div class="am-panel am-panel-default">
	    <div class="am-panel-hd">
		<h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-4'}">What references/sources you have used to help you learn how to create your website?<span class="am-icon-chevron-down am-fr"></span></h4>
	    </div>
	    <div id="do-not-say-4" class="am-panel-collapse am-collapse am-in">
		<div class="am-panel-bd">
		    I used a front-end framework called AmazeUI(<a href="http://amazeui.org" target="_blank">http://amazeui.org/</a>) to handle the website appearance.<br>
		    When I came into trouble, I tried to find answers on W3School(<a href="http://www.w3schools.com/" target="_blank">http://www.w3schools.com/</a>) and Stack Overflow(<a href="http://stackoverflow.com/" target="_blank">http://stackoverflow.com/</a>).
		</div>
	    </div>
	</div>

	<div class="am-panel am-panel-default">
	    <div class="am-panel-hd">
		<h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-5'}">What you have learnt along the way?<span class="am-icon-chevron-down am-fr"></span></h4>
	    </div>
	    <div id="do-not-say-5" class="am-panel-collapse am-collapse am-in">
		<div class="am-panel-bd">
		    I learnt how to design and implement a website start from scratch.<br>
		    I learnt how to use framework to speed up the development process.<br>
		    And of course, I learnt basic php, html, css and javascript.
		</div>
	    </div>
	</div>
    </div>
</div>

<?php
include 'footer.php';
?>
