<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// If you're logging in with a softlog, redirect to your main home
if(Me::$loggedIn and isset($_GET['slg']))
{
	header("Location: /" . Me::$vals['handle']); exit;
}

/****** Page Configurations ******/
$config['canonical'] = "/";
$config['pageTitle'] = "My UniFaction";
Metadata::$index = true;
Metadata::$follow = true;

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
<h1>My UniFaction</h1>
<p>"My UniFaction" is your very own website. Tell your story, show off your interests, or design whatever else comes to mind.</p>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
