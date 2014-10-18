<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure the $contentID value was passed properly
if(!isset($contentID))
{
	if(!$contentID = (int) Database::selectValue("SELECT content_id FROM content_by_url WHERE url_slug=? LIMIT 1", array("home")))
	{
		$contentID = ContentForm::createEntry(Me::$id, "Home Page", Content::STATUS_OFFICIAL, 0, 0, Content::COMMENTS_DISABLED, Content::VOTING_DISABLED, "home");
	}
}

// Retrieve important content data
$contentData = Content::load($contentID);

Content::validateClearance($contentData['status'], $contentData['uni_id']);

ModuleRelated::widget($contentID);
ModuleAuthor::widget($contentData['uni_id']);

// Prepare Values
Content::$returnURL = "/" . $contentData['url_slug'];

// Run Tip Exchanges
if($getData = Link::getData("send-tip-myuni") and is_array($getData) and isset($getData[0]))
{
	// Get the user from the post
	Credits::tip(Me::$id, (int) $getData[0]);
}

// Include Responsive Script
Photo::prepareResponsivePage();
Metadata::addHeader('<link rel="stylesheet" href="' . CDN . '/css/content-system.css" />');

/****** Page Configurations ******/
$config['canonical'] = "/" . $contentData['url_slug'];
$config['pageTitle'] = $contentData['title'];
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

// Display the Body Text
if($contentData['body'])
{
	echo $contentData['body'];
}
else
{
	Content::output($contentID);
}

if(Me::$id == $contentData['uni_id'])
{
	echo '
	<div style="padding-top:22px; font-size:0.8em;"><a href="/write?id=' . $contentID . '">Edit this Page</a></div>';
}

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
