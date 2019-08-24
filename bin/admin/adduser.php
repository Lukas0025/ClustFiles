<?php
    include "../dist/cf.php";
    include "../dist/templates.php";

    $baseTemplate = new template("admin/base");
    $profile = new template("admin/addprofile");

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
        $ok = $cf->addUser(
            $_POST['name'],
            $_POST['password'] == '' ? NULL : $_POST['password'],
            isset($_POST['isadmin']),
            [
                'fullname' => $_POST['fullname'],
                'quota' => intval($_POST['quota']),
                'email' => $_POST['email']
            ]
        );

        if (!$ok) {
            $message = "adding user failed";
        } else {
            header('Location: users.php');
        }
    }

    $userInfo = $profile->createToVar([
        'message' => $message
    ]);

    $baseTemplate->create([
        "user" => $user["name"],
        "content" => $userInfo,
        "title" => "Add user"
    ]);
?>
