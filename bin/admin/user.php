<?php
    include "../dist/cf.php";
    include "../dist/templates.php";

    $baseTemplate = new template("admin/base");
    $profile = new template("admin/profile");

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

    $message = "";

    if (isset($_POST['fullname'])) {
        $ok = $cf->updateUser(
            $_GET['user'],
            $_POST['password'] == '' ? NULL : $_POST['password'],
            isset($_POST['isadmin']),
            [
                'fullname' => $_POST['fullname'],
                'quota' => intval($_POST['quota']),
                'email' => $_POST['email']
            ]
        );

        if (!$ok)
            $message = "user update failed";
    }

    //get info about user
    $targetUser = $cf->getUser($_GET['user']);
    $userInfo = $profile->createToVar([
        'fullname' => $targetUser['fullname'],
        'username' => $_GET['user'],
        'quota' => $targetUser['quota'],
        'size' => $cf->userSize($_GET['user']),
        'used' => $targetUser['quota'] == 0 ? "INF" : round($cf->userSize($_GET['user']) / $targetUser['quota'] * 100) . '%',
        'email' => $targetUser['email'],
        'isadmin' => $targetUser['admin'] ? "checked='checked'" : "",
        'message' => $message
    ]);

    $baseTemplate->create([
        "user" => $user["name"],
        "content" => $userInfo,
        "title" => "User " . $_GET['user']
    ]);
?>
