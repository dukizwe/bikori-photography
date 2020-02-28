<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root', '');
date_default_timezone_set('Africa/Bujumbura');
$get_current_id = $bdd->query('SELECT id FROM images ORDER BY id DESC');
$current_id = $get_current_id->fetch();
if(isset($current_id['id'])) {
    $current_id['id'] += 1;
} else {
    $current_id['id'] = 1;
}
if(isset($_POST['sendimage']) && !empty($_POST['name'])) {
    $extensions = ['jpeg', 'jpg', 'png', 'gif'];
    $extension = strtolower(substr(strrchr($_FILES['image']['name'],'.'),1));
    if(in_array($extension, $extensions)) {
        $image = $current_id['id'].".".$extension;
        $path = "images/gallery/".$image;
        $response = move_uploaded_file($_FILES['image']['tmp_name'], $path);
        if($response) {
            $add_photo = $bdd->prepare('INSERT INTO images(person,img,created_at, likes, hearts) VALUES(?,?,?,?,?)');
            $add_photo->execute([$_POST['name'], $image, date('Y-m-d H:i:s'), "0", "0"]);
        }
    }
}
session_start();
require 'header.php'; ?>
    <div class="new-photo-container">
        <div class="new-photo-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="new-photo">
                    <input type="file" name="image" id="image">
                    <label for="image" class="image-label">Choose file</label>
                </div>
                <div class="image-target-name">
                    <input type="text" id="name" name="name" placeholder="image target name">
                </div>
                <divn class="sending">
                    <input type="submit" name="sendimage" value="Send Image">
                </div>
            </form>
        </div>
    </div>
    <script src="scripts/header.js"></script>
</body>
</html>