<?php
/**
 * Created by PhpStorm.
 * User: arash
 * Date: 9/23/17
 * Time: 7:38 PM
 */

require __DIR__ . '/../vendor/autoload.php';

use duncan3dc\Laravel\BladeInstance;

$blade = new BladeInstance("views", "view-cache");

$bladeName = $_SERVER["REQUEST_URI"];
$bladeName = str_replace("/", "", $bladeName);

$errors = new \App\Models\ErrorMessages();

if (strlen($bladeName) != 0)
    echo $blade->render($bladeName, ['errors'=> $errors]);
else {
    echo "<h1>Project views</h1>";
    echo "<h1>==========</h1>";
    echo "<ul>";
    foreach (scandir('views') as $fileName) {
        if(strpos($fileName, '.blade.php') !== false && strpos($fileName, '_') !== 0){
            $viewName = str_replace(".blade.php", "", $fileName);
            echo "<li><a href='/${viewName}'>${viewName}</a></li>";
        }
    }
    echo "</ul>";
}