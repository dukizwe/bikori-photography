<?php
session_start();
$bdd= new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root', '');
if(isset($_POST['get_data'])) {
    $start = intval($_POST['start']);
    $limit = intval($_POST['limit']);
    $photos = $bdd->query("SELECT * FROM images ORDER BY id DESC LIMIT $start, $limit");
    if($photos->rowCount() > 0) {
        $response = "";
        while($photo = $photos->fetch()) {
        $response .= "
        <div class='image'>
            <img src='images/gallery/".$photo['img']."' class='img'>
        </div>
        ";  
        }
        die($response);
    } else {
        die("postsEnd");
    }
}