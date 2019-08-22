<?php
  include "../dist/cf.php";
  include "../dist/templates.php";
	
  $template = new template("admin/base");
  $cf = new clusterFiles();
  
  $user = $cf->getLoginedUser();
  if (!is_null($user)) {
    if (!$user["admin"]) {
      die("unauthorized access");
    }
  } else {
    header('Location: /login.php');
    die();
  }


  $template->create([
        "user" => $user["name"],
        "content" => "welcome in administration",
        "title" => "admin panel"
  ]);
?>
