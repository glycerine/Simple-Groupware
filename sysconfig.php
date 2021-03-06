<?php
/**
 * @package Simple Groupware
 * @link http://www.simple-groupware.de
 * @copyright Simple Groupware Solutions Thomas Bley 2002-2012
 * @license GPLv2
 */

define("NOCONTENT",true);

require("index.php");
if (!sys_is_super_admin($_SESSION["username"])) sys_die(t("{t}Not allowed. Please log in as super administrator.{/t}"));

sysconfig::header();
sysconfig::init();
  
$show_form = true;
if (!empty($_REQUEST["token"])) {
  $no_hash = false;
  if ($_REQUEST["setup_admin_pw"]=="" and $_REQUEST["setup_admin_user"]==SETUP_ADMIN_USER) {
	$_REQUEST["setup_admin_pw"] = SETUP_ADMIN_PW;
	$no_hash = true;
  }
  $no_hash2 = false;
  if ($_REQUEST["setup_admin_pw2"]=="" and $_REQUEST["setup_admin_user2"]==SETUP_ADMIN_USER2) {
	$_REQUEST["setup_admin_pw2"] = SETUP_ADMIN_PW2;
	$no_hash2 = true;
  }
  $error = sysconfig::validate();
  if ($error=="") {
	sysconfig::write_config($no_hash, $no_hash2);
	echo t("{t}Setup: setup-data written to %s.{/t}","simple_store/config.php");
	$show_form = false;
  } else {
	echo $error;
  }
  echo "<br><br>";
}
echo '<a href="index.php">'.t("{t}Back{/t}").'</a>&nbsp; - &nbsp;';
echo '<a href="http://www.simple-groupware.de/cms/AdministrationConfiguration" target="_blank">'.t("{t}Help{/t}").'</a><br><br></div>';
if ($show_form) sysconfig::show_form();
sysconfig::footer();