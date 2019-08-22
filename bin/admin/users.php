<?php
  include "../dist/cf.php";
  include "../dist/templates.php";
  include "dist/blocks.php";
	
  $template = new template("admin/base");
  $cf = new clusterFiles();
  $blocks = new blocks();
  
  $user = $cf->getLoginedUser();
  /*
    TODO: check user is admin else die
  */

  $names = $cf->getUsersNames();


  $template->create([
        "user" => $user["name"],
        "content" => $blocks->usersTable($names),
        "title" => "Users"
  ]);
?>
