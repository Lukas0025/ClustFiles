<?php
  include "dist/cf.php";
  include "dist/templates.php";
  
  $cf = new clusterFiles();
  $template = new template($cf->isUser("admin") ? "login" : "cradmin");
  
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
  } else if (isset($_POST["cradmin"])) {
    if (!$cf->isUser("admin")) {
      $cf->addUser("admin", $_POST["pass"], true);
      $cf->login("admin", $_POST["pass"]);
      
      header('Location: index.php');
      die;
    }

    $message = "admin is exist";
  }
  
  $template->create([
      'message' => $message,
      'image' => $cf->getRandomBackground()
  ]);
?>
