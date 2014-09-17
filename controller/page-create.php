<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Force the user to log in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/", "/");
}

// Prepare Form
$contentForm = new ContentForm('/page-create', (isset($_GET['content']) ? (int) $_GET['content'] : 0));

// Set the modules allowed in this content entry
$contentForm->modules = array(
	"Text"			=> ContentForm::MODULE_TYPE_SEGMENT
,	"Image"			=> ContentForm::MODULE_TYPE_SEGMENT
,	"Video"			=> ContentForm::MODULE_TYPE_SEGMENT
,	"Related"		=> ContentForm::MODULE_TYPE_META
);

// Prepare Settings
ContentForm::$contentType = 'page';				// Set the content entry type.

$contentForm->guestPosts = false;				// Allows guest submissions on the site.
$contentForm->privatePosts = true;				// Allow private pages (friends only)
$contentForm->maxStatus = 6;					// Sets the maximum allowed status for a user to set.

// $contentForm->urlPrefix = Me::$vals['handle'] . '/';		// Used in the blog
// $contentForm->urlFixed = "";								// If set, forces the URL to be a specific value
$contentForm->urlClearance = ContentForm::URL_DENY;			// Allows the writer to update his own URL

$contentForm->useHashtags = false;
$contentForm->useComments = false;
$contentForm->useVoting = false;

// Make sure you have permissions to edit this form
$contentForm->verifyAccess("/");

// Run Form Behaviors and Interpretations
$contentForm->runBehavior();
$contentForm->runInterpreter();

// Include Responsive Script
Photo::prepareResponsivePage();
Metadata::addHeader('<link rel="stylesheet" href="' . CDN . '/css/content-block.css" />');

// Run Global Script
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

// Display the Page
echo '
<div id="panel-right"></div>
<div id="content">' . Alert::display();

echo '
<h1>' . $contentForm->contentData['title'] . '</h1>';

if($contentForm->contentData['status'] != 0)
{
	echo '<p>Page is LIVE. Posted ' . Time::fuzzy($contentForm->contentData['date_posted']) . '.</p>';
}

$contentForm->drawEditingBox();
$contentForm->drawContent();

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
