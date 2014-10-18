<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure the user belongs on this page
if(!Me::$loggedIn or !isset($url[0]) or Me::$vals['handle'] != $url[0])
{
	header("Location: /"); exit;
}

// The user must have appropriate clearance to update this
if(Form::submitted("my-uni-gen-empty"))
{
	// Make sure you don't have too many drafts
	$draftCount = (int) Database::selectValue("SELECT COUNT(*) as totalNum FROM content_by_user u INNER JOIN content_entries c ON u.content_id=c.id WHERE u.uni_id=? AND c.status=? LIMIT 10", array(Me::$id, 0));
	
	if($draftCount >= 10)
	{
		Alert::error("Too Many Drafts", "You have ten unfinished pages. Please finish some before creating new ones.");
	}
	
	// Make sure you don't have too many entries total
	$totalPages = (int) Database::selectValue("SELECT COUNT(*) as totalNum FROM content_by_user u INNER JOIN content_entries c ON u.content_id=c.id WHERE u.uni_id=? LIMIT 50", array(Me::$id));
	
	if($totalPages >= 50)
	{
		Alert::error("Too Many Entries", "You have reached the maximum limit of fifty pages.");
	}
	
	else if($totalPages >= 25)
	{
		Alert::saveInfo("Many Entries", "You have used " . $totalPages . " of your available 50 pages.");
	}
	
	if(FormValidate::pass())
	{
		// Create the New Entry
		$contentID = ContentForm::createEntry(Me::$id, "Untitled Page", Content::STATUS_OFFICIAL, 0, 0, Content::COMMENTS_DISABLED, Content::VOTING_DISABLED, $url_relative);
		
		// Begin editing the entry
		header("Location: /page-create?content=" . $contentID); exit;
	}
}

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

// If this is the home page
if(!isset($url[1]) and Me::$vals['handle'] == $url[0])
{
	echo '
	<h2>Welcome to your Home Page!</h2>
	<p>This is your official UniFaction page, where people can see what you\'re all about.</p>
	
	<p><form class="uniform" action="/' . Sanitize::variable($url_relative, "/") . '" method="post">' . Form::prepare("my-uni-gen-empty") . '
		<p><input type="submit" name="submit" value="Create This Page" tabindex="10" /></p>
	</form></p>
	
	</div>';
}
else
{
	echo '
	<h2>Create This Page</h2>
	<p>You own all pages under the /' . Me::$vals['handle'] . ' segment, but this page has not been created yet. Would you like to create it now?</p>
	
	<p><form class="uniform" action="/' . Sanitize::variable($url_relative, "/") . '" method="post">' . Form::prepare("my-uni-gen-empty") . '
		<p><input type="submit" name="submit" value="Create This Page" tabindex="10" /></p>
	</form></p>
	
	</div>';
}

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
