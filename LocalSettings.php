<?php
# This file was automatically generated by the MediaWiki 1.27.1
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}


/******************** Adair  Start ***************************/

//Adair 2017.11.03
//判断手机登录还是服务器登录
function isMobile(){ 
	$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; 
	$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';   

	function CheckSubstrs($substrs,$text){ 
		foreach($substrs as $substr) 
		if(false!==strpos($text,$substr)){ 
			return true; 
		} 
		return false; 
	}

	$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
	$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod'); 
	 
	$found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) || CheckSubstrs($mobile_token_list,$useragent); 
	 
	if ($found_mobile){ 
		return true; 
	}else{ 
		return false; 
	} 

}



## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;
//Adair 2017.11.03
//手机登录展示AMP 版本
if(isMobile()){
	define("wgMobileFlag",ture);
	wfLoadSkin( 'Example' );
	$wgDefaultSkin = "Example";
	
}else{

	define("wgMobileFlag",false);
	//$wgDefaultSkin = "vector";
	require_once( "$IP/skins/chameleon/Chameleon.php" );
	//
	//
	// require_once( "$IP/skins/bootstrap/bootstrapskin.php" );
	// $wgRestrictDisplayTitle = false;
	// $wgAllowExternalImages = true;
	//
	$egChameleonLayoutFile= __DIR__ . '/skins/chameleon/layouts/navhead.xml';
	$wgDefaultSkin = "chameleon";

	
}

/******************** Adair  End ***************************/


## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "*** Electronic Product Wiki and Tutorial: Arduino and Robot Wiki-***.com";
$wgMetaNamespace = "Robot_Wiki";

$wgUsePathInfo = true;
$wgSend404Code = false;

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/wiki";

## The protocol and server name to use in fully-qualified URLs
$wgServer = "https://www.***.com";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

// $wgInvalidateCacheOnLocalSettingsChange = true;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgFavicon = "$wgResourceBasePath/resources/assets/wiki.ico";
$wgLogo    = "$wgResourceBasePath/resources/assets/wiki.png";
##$wgLogo    = "$wgResourceBasePath/logo.png";

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "service@***.com";
$wgPasswordSender = "service@***.com";

$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "***.c0kawrtcp9yc.ap-northeast-1.rds.amazonaws.com";
$wgDBname = "df_wikiv3";
$wgDBuser = "***";
$wgDBpassword = "Zw***2017";

# MySQL specific settings
$wgDBprefix = "wk";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = true;

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";
$wgAllowExternalImages = true;

// $wgGroupPermissions['autoconfirmed']['upload_by_url'] = true;
// $wgAllowCopyUploads = true;
// $wgCopyUploadsFromSpecialUpload = true;

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "en";

$wgSecretKey = "123";

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "03b102ad4020db55";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://www.gnu.org/copyleft/fdl.html";
$wgRightsText = "GNU Free Documentation License 1.3 or later";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/gnu-fdl.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
// $wgGroupPermissions['*']['edit'] = false;

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
// $wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
// wfLoadSkin( 'CologneBlue' );
// wfLoadSkin( 'Modern' );
// wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Vector' );
// wfLoadSkin( 'Dusk' );
// wfLoadSkin( 'erudite' );
// wfLoadSkin( 'DuskToDawn' );


/**********************Adair Edit  Start********************/
/*require_once( "$IP/skins/chameleon/Chameleon.php" );
//
//
// require_once( "$IP/skins/bootstrap/bootstrapskin.php" );
// $wgRestrictDisplayTitle = false;
// $wgAllowExternalImages = true;
//
$egChameleonLayoutFile= __DIR__ . '/skins/chameleon/layouts/navhead.xml';
$wgDefaultSkin = "chameleon";
// $wgDefaultSkin = "Vector";*/
/**********************Adair Edit  End********************/



require_once "$IP/extensions/VisualEditor/VisualEditor.php";

// Enable by default for everybody
$wgDefaultUserOptions['visualeditor-enable'] = 1;

// Optional: Set VisualEditor as the default for anonymous users
// otherwise they will have to switch to VE
// $wgDefaultUserOptions['visualeditor-editor'] = "visualeditor";

// Don't allow users to disable it
$wgHiddenPrefs[] = 'visualeditor-enable';

// OPTIONAL: Enable VisualEditor's experimental code features
#$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;

$wgVirtualRestConfig['modules']['parsoid'] = array(
  // URL to the Parsoid instance
  // Use port 8142 if you use the Debian package
  'url' => 'http://localhost:8142',
  // Parsoid "domain", see below (optional)
  'domain' => 'localhost',
  // Parsoid "prefix", see below (optional)
  'prefix' => 'localhost'
);

// This feature requires a non-locking session store. The default session store will not work and
// will cause deadlocks (connection timeouts from Parsoid) when trying to use this feature.
$wgSessionsInObjectCache = true;

// Forward users' Cookie: headers to Parsoid. Required for private wikis (login required to read).
// If the wiki is not private (i.e. $wgGroupPermissions['*']['read'] is true) this configuration
// variable will be ignored.
//
// WARNING: ONLY enable this on private wikis and ONLY IF you understand the SECURITY IMPLICATIONS
// of sending Cookie headers to Parsoid over HTTP. For security reasons, it is strongly recommended
// that $wgVisualRestConfig['modules']['parsoid']['url'] be pointed to localhost if this setting is enabled.
// $wgVirtualRestConfig['modules']['parsoid']['forwardCookies'] = true;

// require_once "$IP/extensions/BootStrapSkinContact/BootStrapSkinContact.php";
//
//
// # Enabled extensions. Most of the extensions are enabled by adding
// # wfLoadExtensions('ExtensionName');
// # to LocalSettings.php. Check specific extension documentation for more details.
// # The following extensions were automatically enabled:
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'TemplateData' );
// Set this to true to enable the TemplateData GUI editor
$wgTemplateDataUseGUI = false;

$wgNoFollowDomainExceptions = array( 'www.***.com', 'images.***.com' );
//
//
// # End of automatically generated settings.
// # Add more configuration options below.
// enableSemantics( '***.com' );
$wgGroupPermissions['*']['createaccount']    =false;
$wgGroupPermissions['*']['read']             = true;
$wgGroupPermissions['*']['edit']             = false;
$wgGroupPermissions['*']['createpage']       = false;
$wgGroupPermissions['*']['createtalk']       = false;
$wgGroupPermissions['*']['writeapi']         = false;

// Implicit group for all logged-in accounts
$wgGroupPermissions['user']['move']             = false;
$wgGroupPermissions['user']['move-subpages']    = false;
$wgGroupPermissions['user']['move-rootuserpages'] = false; // can move root userpages
//$wgGroupPermissions['user']['movefile']         = true;	// Disabled for now due to possible bugs and security concerns
$wgGroupPermissions['user']['read']             = true;
$wgGroupPermissions['user']['edit']             = true;
$wgGroupPermissions['user']['createpage']       = true;
$wgGroupPermissions['user']['createtalk']       = false;
$wgGroupPermissions['user']['writeapi']         = true;
$wgGroupPermissions['user']['upload']           = true;
$wgGroupPermissions['user']['reupload']         = true;
$wgGroupPermissions['user']['reupload-shared']  = true;
$wgGroupPermissions['user']['minoredit']        = true;
$wgGroupPermissions['user']['purge']            = false; // can use ?action=purge without clicking "ok"


// Implicit group for accounts that pass $wgAutoConfirmAge
$wgGroupPermissions['autoconfirmed']['autoconfirmed'] = false;

// Users with bot privilege can have their edits hidden
// from various log pages by default
$wgGroupPermissions['bot']['bot']              = true;
$wgGroupPermissions['bot']['autoconfirmed']    = true;
$wgGroupPermissions['bot']['nominornewtalk']   = true;
$wgGroupPermissions['bot']['autopatrol']       = true;
$wgGroupPermissions['bot']['suppressredirect'] = true;
$wgGroupPermissions['bot']['apihighlimits']    = true;
$wgGroupPermissions['bot']['writeapi']         = true;
#$wgGroupPermissions['bot']['editprotected']    = true; // can edit all protected pages without cascade protection enabled

// Most extra permission abilities go to this group
$wgGroupPermissions['sysop']['block']            = true;
$wgGroupPermissions['sysop']['edit']             = true;
$wgGroupPermissions['sysop']['createaccount']    = true;
$wgGroupPermissions['sysop']['delete']           = true;
$wgGroupPermissions['sysop']['createpage']       = true;
$wgGroupPermissions['sysop']['bigdelete']        = true; // can be separately configured for pages with > $wgDeleteRevisionsLimit revs
$wgGroupPermissions['sysop']['deletedhistory']   = true; // can view deleted history entries, but not see or restore the text
$wgGroupPermissions['sysop']['undelete']         = true;
$wgGroupPermissions['sysop']['editinterface']    = true;
$wgGroupPermissions['sysop']['editusercssjs']    = true;
$wgGroupPermissions['sysop']['import']           = true;
$wgGroupPermissions['sysop']['importupload']     = true;
$wgGroupPermissions['sysop']['move']             = true;
$wgGroupPermissions['sysop']['move-subpages']    = true;
$wgGroupPermissions['sysop']['move-rootuserpages'] = true;
$wgGroupPermissions['sysop']['patrol']           = true;
$wgGroupPermissions['sysop']['autopatrol']       = true;
$wgGroupPermissions['sysop']['protect']          = true;
$wgGroupPermissions['sysop']['proxyunbannable']  = true;
$wgGroupPermissions['sysop']['rollback']         = true;
$wgGroupPermissions['sysop']['trackback']        = true;
$wgGroupPermissions['sysop']['upload']           = true;
$wgGroupPermissions['sysop']['reupload']         = true;
$wgGroupPermissions['sysop']['reupload-shared']  = true;
$wgGroupPermissions['sysop']['unwatchedpages']   = true;
$wgGroupPermissions['sysop']['autoconfirmed']    = true;
$wgGroupPermissions['sysop']['upload_by_url']    = true;
$wgGroupPermissions['sysop']['ipblock-exempt']   = true;
$wgGroupPermissions['sysop']['blockemail']       = true;
$wgGroupPermissions['sysop']['markbotedits']     = true;
$wgGroupPermissions['sysop']['apihighlimits']    = true;
$wgGroupPermissions['sysop']['browsearchive']    = true;
$wgGroupPermissions['sysop']['noratelimit']      = true;
$wgGroupPermissions['sysop']['movefile']         = true;
$wgGroupPermissions['sysop']['minoredit']        = true;
$wgGroupPermissions['sysop']['mergehistory']     = true;
$wgGroupPermissions['sysop']['writeapi']         = true;


// Permission to change users' group assignments
$wgGroupPermissions['bureaucrat']['userrights']  = true;
$wgGroupPermissions['bureaucrat']['noratelimit'] = true;
// Permission to change users' groups assignments across wikis
#$wgGroupPermissions['bureaucrat']['userrights-interwiki'] = true;
// Permission to export pages including linked pages regardless of $wgExportMaxLinkDepth
#$wgGroupPermissions['bureaucrat']['override-export-depth'] = true;

#$wgGroupPermissions['sysop']['deleterevision']  = true;
// To hide usernames from users and Sysops
#$wgGroupPermissions['suppress']['hideuser'] = true;
// To hide revisions/log items from users and Sysops
#$wgGroupPermissions['suppress']['suppressrevision'] = true;
// For private suppression log access
#$wgGroupPermissions['suppress']['suppressionlog'] = true;

/**
 * The developer group is deprecated, but can be activated if need be
 * to use the 'lockdb' and 'unlockdb' special pages. Those require
 * that a lock file be defined and creatable/removable by the web
 * server.
 */
# $wgGroupPermissions['developer']['siteadmin'] = true;
$wgGroupPermissions['sysop']['userrights'] = true;


require_once "$IP/extensions/googleAnalytics/googleAnalytics.php";
// Replace xxxxxxx-x with YOUR GoogleAnalytics UA number
$wgGoogleAnalyticsAccount = 'UA-16770142-1';
// Add HTML code for any additional web analytics (can be used alone or with $wgGoogleAnalyticsAccount)
$wgGoogleAnalyticsOtherCode = '<script type="text/javascript" src="https://analytics.example.com/tracking.js"></script>';

// Optional configuration (for defaults see googleAnalytics.php)
// Store full IP address in Google Universal Analytics (see https://support.google.com/analytics/answer/2763052?hl=en for details)
$wgGoogleAnalyticsAnonymizeIP = false;
// Array with NUMERIC namespace IDs where web analytics code should NOT be included.
$wgGoogleAnalyticsIgnoreNsIDs = array(500);
// Array with page names (see magic word Extension:Google Analytics Integration) where web analytics code should NOT be included.
$wgGoogleAnalyticsIgnorePages = array('ArticleX', 'Foo:Bar');
// Array with special pages where web analytics code should NOT be included.
$wgGoogleAnalyticsIgnoreSpecials = array( 'Userlogin', 'Userlogout', 'Preferences', 'ChangePassword', 'OATH');
// Use 'noanalytics' permission to exclude specific user groups from web analytics, e.g.
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bot']['noanalytics'] = true;
// To exclude all logged in users give 'noanalytics' permission to 'user' group, i.e.
$wgGroupPermissions['user']['noanalytics'] = true;

?>