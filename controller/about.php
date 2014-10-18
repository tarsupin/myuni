<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Prepare Values
$meURL = URL::unifaction_me();
$ownerURL = Me::$loggedIn ? $meURL . "/" . Me::$vals['handle'] : $meURL . "/Nikola_Tesla";

// Run Global Script
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Display Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

echo '
<div id="panel-right"></div>
<div id="content">' . Alert::display();

echo '
<h2>How do I create My Website?</h2>
<p>You own <a href="' . $ownerURL . '">' . $ownerURL . '</a>, and all of the pages in it! To edit the home page, visit the link and click "Edit This Page".</p>

<p>
You can also edit any page on your site by visiting any URL segment within your site, such as:
<ul>
	<li><a href="' . $ownerURL . '/about-me">' . $ownerURL . '/about-me</a></li>
	<li><a href="' . $ownerURL . '/my-portfolio">' . $ownerURL . '/my-portfolio</a></li>
	<li><a href="' . $ownerURL . '/hobbies">' . $ownerURL . '/hobbies</a></li>
</ul>
</p>

</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
