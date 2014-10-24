<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); } 

$url1 = (isset($url[1]) ? $url[1] : '');

// Main Navigation
$html = '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . (in_array($url[0], array("", "home")) ? " nav-active" : "") . '"><a href="/">Home<span class="icon-circle-right nav-arrow"></span></a></li>';
		
		if(Me::$loggedIn)
		{
			$html .= '
			<li class="nav-slot' . ($url[0] == Me::$vals['handle'] ? " nav-active" : "") . '"><a href="/' . Me::$vals['handle'] . '">My UniFaction<span class="icon-circle-right nav-arrow"></span></a></li>';
		}
		
		if(Me::$clearance >= 6)
		{
			$html .= '
			<li class="nav-slot' . ($url[0] == "post-list" ? " nav-active" : "") . '"><a href="/post-list">Page List<span class="icon-circle-right nav-arrow"></span></a></li>';
		}
		
		$html .= '
	</ul>
</div>';

WidgetLoader::add("SidePanel", 10, $html);

// Related Sites
WidgetLoader::add("SidePanel", 45, '
<div class="panel-box">
	<a href="#" class="panel-head">Related Sites<span class="icon-circle-right nav-arrow"></span></a>
	<ul class="panel-notes">
		<li class="nav-note"><a href="/docs/faqs">MicroFaction</a></li>
		<li class="nav-note"><a href="/docs/tos">My UniFaction</a></li>
		<li class="nav-note"><a href="/docs/privacy">Another Site</a></li>
	</ul>
</div>');

// Tip Option
if(isset($contentData))
{
	WidgetLoader::add("SidePanel", 50, '
	<div class="panel-box" style="min-height:10px; text-align:center;">
		<div style="padding:10px;"><a class="button" href="' . $contentData['url_slug'] . "?" . Link::prepareData("send-tip-myuni", $contentData['uni_id']) . '">Tip ' . $contentData['display_name'] . '</a></div>
	</div>');
}