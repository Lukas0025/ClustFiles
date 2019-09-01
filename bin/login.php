<?php
  include "dist/cf.php";
  include "dist/templates.php";
  
  $cf = new clusterFiles();
  $template = new template(!$cf->noUsers() ? "login" : "cradmin");
  
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
    if ($cf->noUsers()) {
      $cf->addUser($_POST["cradmin"], $_POST["pass"], true, [
                'quota' => 0
      ]);
      
      $cf->login($_POST["cradmin"], $_POST["pass"]);
      
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
