<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root', '');
date_default_timezone_set('Africa/Bujumbura');
$errors = [];
if(isset($_POST['sendmsg'])) {
    if(!empty($_POST['name'])) {
        if(strlen($_POST['name']) >= 2) {
            if(strlen($_POST['name']) <= 30) {
            } else {
                $errors[] = "your full name is too long";
            }
        } else {
            # code...
            $errors[] = "your full name is too short";
        }
    } else {
        # code...
        $errors[] = "you must fill your full name";
    }
    if (!empty($_POST['message'])) {
        # code...
    } else {
        # code...
        $errors[] = "you must fill your message";
    }
    if(count($errors) === 0) {
        $full_name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $add_message = $bdd->prepare('INSERT INTO contact(full_name,email,msg,created_at) VALUES(?,?,?,?)');
        $add_message->execute([$full_name, $email, $message, date('Y-m-d H:i:s')]);
    }
}

?>
<?php require 'header.php'; ?>
<!-- modal errors -->
<?php if(!empty($errors)): //on affiche la modale, si il ya des erreurs?>
    <div class="modal-errors">
    <div class="modal-content">
        <div class="modal-title">
        Error<?php echo (count($errors) > 1) ? 's': ''; ?>!
        </div><hr>
        <div class="error-description">
        <?php
        // on affiche un tiret si les erreurs sont nombreux 
        $tiret = (count($errors) > 1) ? '- ' : null;?>
        <?php foreach($errors as $error) {
            echo $tiret.$error.'<br>';
        } ?>
        </div><hr>
        <div class="thanks">try correcting errors</div><hr>
        <div class="modal-yes">
        Got it
        </div>
    </div>
    </div>
<?php endif ?>

<?php if(isset($_POST['sendmsg']) && count($errors) === 0): ?>
<div class="modal-passchecker">
    <div class="modal-passchecker-content">
        <div class="modal-passchecker-title">
        Succes
        </div><hr>
        <div class="passchecker-description">
        thank you for submitting your message
        </div><hr>
        <a href="home.php" class="modal-next">Got it</a>
    </div>
</div>
<?php endif ?>
<div class="contact-container">
    <div class="contact-content">
        <div class="contact-title">Contact Us</div>
        <form method="POST">
            <div class="inputs">
                <input type="text" name="name" placeholder="full name" class="form-control">
                <input type="email" name="email" placeholder="email (optional)" class="email">
            </div>
            <textarea placeholder="your message" class="message" name="message"></textarea><br>
            <input type="submit" name="sendmsg" value="Send" class="send-msg">
        </form>
    </div>
    <div class="follow-us-content">
        <div class="follow-us-title">Follow Us</div>
        <div class="follow-us-links">
            <a class="card email-card" href="mailto:bbikorimana@gmail.com">
                <i class="card-icon far fa-envelope"></i><br>
                <span>bbikorimana@gmail.com</span>
            </a>
            <a class="card phone-card" href="#">
                <i class="card-icon fas fa-phone"></i><br>
                <span>+257 69 702 960</span>
            </a>
            <a class="card location-card" href="#">
                <i class="card-icon fas fa-map-marker-alt"></i><br>
                <span>Bujumbura,BURUNDI</span>
            </a>
            <a class="card facebook-card" href="https://web.facebook.com/profile.php?id=100006082668932" target="_blank">
                <i class="card-icon fab fa-facebook-square"></i><br>
                <span>Bikorimana BestBoy</span>
            </a>
            <a class="card instagram-card" href="#">
                <i class="card-icon fab fa-instagram"></i><br>
                <span>bikoriii</span>
            </a>
            <a class="card twitter-card" href="#">
                <i class="card-icon fab fa-twitter"></i><br>
                <span>bikoriii</span>
            </a>
        </div>
    </div>
</div>
<script src="scripts/header.js"></script>
<script src="scripts/contact.js"></script>
</body>
</html>