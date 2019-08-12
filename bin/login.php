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
      die;
    }

    $message = "login failed";

  } else if (isset($_GET["logout"])) {
    $cf->logout();
  }
  
  $template->create([
      'message' => $message,
      'image' => $cf->getRandomBackground()
  ]);
?>
