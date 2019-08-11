<?php
/**
 *  PHP Local filesystem bridge for angular-filemanager
 *  
 *  @author Jakub Ďuraš <jakub@duras.me>
 *  @version 0.1.0
 */
include 'LocalBridge/Response.php';
include 'LocalBridge/Rest.php';
include 'LocalBridge/Translate.php';
include 'LocalBridge/FileManagerApi.php';
include '../dist/cf.php';

$cf = new ClusterFiles();
$user = $cf->getLoginedUser();

if (!is_null($user)) {
     $fileManagerApi = new AngularFilemanager\LocalBridge\FileManagerApi($cf->getUserPath($user['name']));

     $rest = new AngularFilemanager\LocalBridge\Rest();
     $rest->post([$fileManagerApi, 'postHandler'])
          ->get([$fileManagerApi, 'getHandler'])
          ->handle();
} else {
     echo "access deny";
}