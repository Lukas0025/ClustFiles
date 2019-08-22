<?php
    include "../dist/cf.php";
    include "../dist/templates.php";
    include "dist/blocks.php";
        
    $template = new template("admin/base");
    $cf = new clusterFiles();
    $blocks = new blocks();
    
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
        "content" => $blocks->usersTable($cf),
        "title" => "Users"
    ]);
?>
