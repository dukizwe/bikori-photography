<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root','');
date_default_timezone_set('Africa/Bujumbura');
//traitement du formulaire
$refirstName = null;
$relastName = null;
$reusername = null;
$errors = [];
if(isset($_POST['register'])) {
    if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $refirstName = $_POST['firstName'];
        $relastName = $_POST['lastName'];
        $reusername = $_POST['username'];
        //verifiction du firtsname
        if(strlen($_POST['firstName']) >= 2) { //si le nom est supérieur à 1, on vas continuer
           if(strlen($_POST['firstName']) <= 15) { // si le nom est inférieur à 16, on vas continuer 
            } else {
            $errors[] = "your firstname is too long";
           }
        } else {
            $errors[] = "your firstname is too short";
        }
        //verification du lastname
        if(strlen($_POST['lastName']) >= 2) { //si le prenom est supérieur à 1, on vas continuer
            if(strlen($_POST['lastName']) <= 15) { // si le prenom est inférieur à 16, on vas continuer 
             } else {
             $errors[] = "your lastname is too long";
            }
         } else {
             $errors[] = "your lastname is too short";
         }
         //verification du username
         $check_username = $bdd->prepare('SELECT * from members where username = ?');
         $check_username->execute([$_POST['username']]);
         $check_username = $check_username->rowCount();
         if($check_username == 0) { // si le username n'a pas encore utilisé, on continue
            if(strlen($_POST['username']) >= 4) { //si le username est supérieur à 1, on vas continuer
                if(strlen($_POST['username']) <= 15) { // si le username est inférieur à 16, on vas continuer 
                 } else {
                 $errors[] = "your username is too long";
                }
             } else {
                 $errors[] = "your username is too short";
             }
         } else {
             $errors[] = "username already taken";
         }
         //verification du password
         if(strlen($_POST['password']) >= 8) { //si le password est supérieur à 1, on vas continuer
            if(strlen($_POST['password']) <= 30) { // si le password est inférieur à 16, on vas continuer 
             } else {
             $errors[] = "your password is too long";
            }
         } else {
             $errors[] = "your password is too short";
         }
    } else {
        $errors[] = "you must fill all the fields";
    }
    if(empty($errors)) { // si il n'y a aucune erreur, on insere notre membre
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $username = strtolower(htmlspecialchars($_POST['username']));
        $password = sha1($_POST['password']);
        $addmember = $bdd->prepare('INSERT INTO members(firstname,lastname,username,passwords,created_at) VALUES(?,?,?,?,?)');
        $addmember->execute([$firstName,$lastName,$username,$password,date('Y-m-d H:i:s')]);
        $_SESSION['username'] = $username;
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
<?php if(isset($_POST['register']) && count($errors) === 0): ?>
<div class="modal-passchecker">
    <div class="modal-passchecker-content">
        <div class="modal-passchecker-title">
        Succes
        </div><hr>
        <div class="passchecker-description">
        your account has been created
        </div><hr>
        <a href="home.php" class="modal-next">Next</a>
    </div>
</div>
<?php endif ?>
<div class="singup-container">
    <div class="singup-content">
        <form action="" method="POST" class="register-form">
            <div class="singup-title">
                Sign Up
            </div>
            <div>
                <input type="text" name="firstName" class="first-name" id="firstName" value="<?=$refirstName?>" ><br>
                <label for="firstName">First Name</label>
            </div>
            <div>
                <input type="text" name="lastName" class="last-name" id="lastName" value="<?=$relastName?>" ><br>
                <label for="lastName">Last Name</label>
            </div>
            <div>
                <input type="text" name="username" class="username" id="username" value="<?=$reusername?>" ><br>
                <label for="username">Username</label>
            </div>
            <div>
                <input type="password" name="password" class="password" id="password" ><br>
                <label for="password">Password</label>
            </div>
            <div>
            <div class="submit">
                <input type="submit" value="Sign Up" name="register" class="send-singup">
            </div>
        </form>
        <div class="or-container">
            or
        </div>
        <div class="sign-up-section">
            <div class="sign-up-desc">
                if you already have an account,
            </div>
            <a href="login.php" class="sign-up-now">
                Sign In
            </a>
        </div>
    </div>
</div>
<script src="scripts/register.js"></script>
</body>
</html>