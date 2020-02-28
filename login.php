<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root','');
$errors = [];
$pre_username = null;
if(isset($_POST['sendlogin'])) {
    $pre_username = $_POST['username'];
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = strtolower(htmlspecialchars($_POST['username']));
        $password = $_POST['password'];
        if($username == "bikori" && $password == "69702960") {
            $_SESSION['username'] = $username;
            header('location: home.php');
        } else {
            $errors[] = "incorrect username or password";
        }
    } else {
        $errors[] = "you must fill all the fields";
    }
}
?>
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
<?php require 'header.php'; ?>
<div class="login-container">
    <div class="login-content">
        <form action="" method="POST">
            <div class="login-title">
                Sign In
            </div>
            <div>
                <input type="text" name="username" class="username" id="username" value="<?= $pre_username ?>"><br>
                <label for="username">Username</label>
            </div>
            <div>
                <input type="password" name="password" class="password" id="password" ><br>
                <label for="password">Password</label>
            </div>
            <div class="submit">
                <input type="submit" value="Sign In" name="sendlogin" class="send-login">
            </div>
        </form>
        <div class="or-container">
            or
        </div>
        <div class="sign-up-section">
            <div class="sign-up-desc">
                if you don't have an account,
            </div>
            <a href="register.php" class="sign-up-now">
                Sign Up
            </a>
        </div>
    </div>
</div>
<script src="scripts/login.js"></script>
</body>
</html>