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

    if (isset($_GET['delname'])) {
        $cf->delUser($_GET['delname']);
    }

    $template->create([
        "user" => $user["name"],
        "content" => $blocks->card("ClustFiles users", $blocks->usersTable($cf), "<a class='btn btn-success btn-sm' href='adduser.php'><i class='fa fa-plus'></i> Add</a>"),
        "title" => "Users"
    ]);
?>
