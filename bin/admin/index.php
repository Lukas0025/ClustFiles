<?php
  include "../dist/cf.php";
  include "../dist/templates.php";
	
  $template = new template("admin/base");
  $cf = new clusterFiles();
  
  $user = $cf->getLoginedUser();
  /*
    TODO: check user is admin else die
  */


  $template->create([
        "user" => $user["name"],
        "content" => "welcome in administration",
        "title" => "admin panel"
  ]);
?>
