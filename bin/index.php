<?php
  include "dist/cf.php";
  include "dist/templates.php";
	
  $template = new template("index");
  $cf = new clusterFiles();
  
  $user = $cf->getLoginedUser();

  if (!is_null($user)) {
    $template->create([]);
  } else {
    header('Location: login.php');
  }
?>
