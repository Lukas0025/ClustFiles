<?php
  include "dist/cf.php";
  include "dist/templates.php";
	
  $template = new template("login");
  $cf = new clusterFiles();
  
  $message = "";

  if (isset($_POST["name"])) {
    //try login
    if ($cf->login($_POST["name"], $_POST["pass"])) {
        header('Location: index.php');
    }

    $message = "login failed :(";
  }
  
  $template->create([
      'message' => $message
  ]);
?>
