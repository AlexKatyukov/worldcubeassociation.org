<?php
// session information needs to be created before <html> tag is output.  Thus this php code should come at the beginning of the file.
if ( ! preg_match( '/worldcubeassociation.org$/i', $_SERVER["SERVER_NAME"] ) ) {
  // if not on WCA server, in development environment - show errors.
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
}
require_once( '_framework.php' );
$standAlone = getBooleanParam( 'standAlone' );

?><!doctype html><html lang="en">
<head>
<title>World Cube Association - Official Results</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="author" content="WCA Website Team" />
<meta name="description" content="Official World Cube Association Competition Results" />
<meta name="keywords" content="rubik's cube,puzzles,competition,official results,statistics,WCA" />
<link rel="shortcut icon" href="<?php print pathToRoot(); ?>images/wca.ico" />

<?php

/* Deal with scripts here, for now */
$scripts = new WCAClasses\WCAScripts();
if(isset($jQuery) && $jQuery) {
  $scripts->add('//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js');
}
if(isset($jQueryUI) && $jQueryUI) {
  $scripts->add('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');
}
if(isset($jQuery_chosen) && $jQuery_chosen) {
  $scripts->add('chosen.jquery.min.js');
}
if(isset($currentSection) && $currentSection != 'admin') {
  $scripts->add('ga.js');
}
print $scripts->getHTMLAll();

/* Deal with styles here, for now */
$styles = new WCAClasses\WCAStyles();
$styles->add('general.css');
$styles->add('pageMenu.css');
$styles->add('tables.css');
$styles->add('links.css');
$styles->add('chosen.min.css');
if(isset($currentSection) && $currentSection == 'admin') {
  $styles->add('admin.css');
}
print $styles->getHTMLAll();


?>


<?php print isset( $extraHeaderStuff ) ? $extraHeaderStuff : ''; ?>
</head>

<body>
<?php if (!$standAlone) { ?>
<div id="main">
<div id="content">
<?php
  $sections = array(
    array( 'Home',         'home', '../'  ),
    array( 'Rankings',     'events'       ),
    array( 'Records',      'regions'      ),
    array( 'Competitions', 'competitions' ),
    array( 'Persons',      'persons'      ),
    array( 'Multimedia',   'media'        ),
    array( 'Statistics',   'statistics'   ),
    array( 'Misc',         'misc'         ),
  );
  if ($currentSection == 'admin') {
    $sections[] = array('Admin', 'admin', 'admin/');
  }

  if (!preg_match( '/worldcubeassociation.org$/', $_SERVER["SERVER_NAME"])) {
    noticeBox3( 0, "Note: This is only a copy of the WCA results system used for testing stuff. The official WCA results are at:<br /><a href='http://www.worldcubeassociation.org/results/'>http://www.worldcubeassociation.org/results/</a>" );
  }

  // only show errors in admin section
  if($currentSection == 'admin' && isset($installation_errors) && !empty($installation_errors)) {
    showErrors($installation_errors);
  }
?>

<div id="pageMenuFrame">
  <div id="pageMenu">
    <ul class="navigation">
      <?php print_menu($sections, $currentSection); ?>
    </ul>
  </div>
</div>

<div id='header'><a href='https://www.worldcubeassociation.org/'>World Cube Association<br />Official Results</a></div>
<?php } ?>

<?php startTimer(); ?>
