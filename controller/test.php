<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Run Global Script
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

// Display the Page
echo '
<div id="content">' . Alert::display();

echo '


<div style="font-size:2em;">
<span class="icon-home"></span>
<span class="icon-star"></span>
<span class="icon-user"></span>
<span class="icon-login"></span>
<span class="icon-settings"></span>
<span class="icon-trash"></span>
<span class="icon-home"></span>
<span class="icon-flag"></span>
<span class="icon-tags"></span>
<span class="icon-plus"></span>
<span class="icon-minus"></span>
<span class="icon-cancel"></span>
<span class="icon-checkmark"></span>
<span class="icon-question"></span>

<span class="icon-info"></span>
<span class="icon-exclamation"></span>
<span class="icon-comment"></span>
<span class="icon-comments"></span>
<span class="icon-briefcase"></span>
<span class="icon-group"></span>
<span class="icon-gamepad"></span>
<span class="icon-circle-right"></span>
<span class="icon-newspaper"></span>
<span class="icon-edit"></span>
<span class="icon-image"></span>
<span class="icon-video"></span>
<span class="icon-book"></span>
<span class="icon-document"></span>
<span class="icon-file"></span>
<span class="icon-folder"></span>
<span class="icon-tag"></span>
<span class="icon-coin"></span>
<span class="icon-address-book"></span>
<span class="icon-envelope"></span>
<span class="icon-calendar"></span>
<span class="icon-phone"></span>
<span class="icon-lock"></span>
<span class="icon-menu"></span>
<span class="icon-globe"></span>
<span class="icon-earth"></span>
<span class="icon-link"></span>
<span class="icon-attachment"></span>
<span class="icon-eye"></span>
<span class="icon-thumbs-up"></span>
<span class="icon-thumbs-down"></span>
<span class="icon-plus-big"></span>

</div>
<br /><br />

<form>
<a onclick="UniMarkup(\'thistest\', \'something\')">Test1</a>

</a>

<br /><br />

' . UniMarkup::buttonLine("thistest") . '

<textarea id="thistest" style="width:100%; height:150px;"></textarea>

</form>';

echo '
</div>';


?>

<script>



</script>

<?php


// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
