<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root','')
?>
<?php
    //gestinnaire auto du navigation
    function gernav ($link,$class, $name) {
        if($_SERVER['SCRIPT_NAME'] == "/bikori/$link") {
            $class = $class.' active';
        } else {
            $class = $class;
        }
        return <<<NAV
        <a href="$link" class="$class">$name</a>
NAV;
    }
    //gestionaire auto des styles
    function gerstyles($link) {
        if($_SERVER['SCRIPT_NAME'] == "/bikori/$link.php") {
            return <<<LINK
            <link rel="stylesheet" href="styles/$link.css">
LINK;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bikori Photographer</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="styles/header.css">
    <?= gerstyles("home"); ?>
    <?= gerstyles("profile"); ?>
    <?= gerstyles("gallery"); ?>
    <?= gerstyles("activity"); ?>
    <?= gerstyles("about"); ?>
    <?= gerstyles("login"); ?>
    <?= gerstyles("register"); ?>
    <?= gerstyles("new-photo") ?>
    <?= gerstyles("new-activity") ?>
    <?= gerstyles("contact") ?>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- goggle font -->
    <link href="https://fonts.googleapis.com/css?family=Supermercado+One&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div class="full-screen"></div>
    <header>
        <div class="logo"><a href="home.php">Bikori Photographer</a></div>
        <nav>
            <?php if(isset($_SESSION['username']) && $_SERVER['SCRIPT_NAME'] != "/bikori/login.php" && $_SERVER['SCRIPT_NAME'] != "/bikori/register.php"){ //si le user est connecte, on affiche son profil
                    echo gerNav('#',"profile", "<i class='far fa-user'></i> Profile<span class='dropdown-caret'></span>"); 
                }
            ?>
            <div class="dropdown-menu">
                <a href="#" class="connected-user">
                    <?= $_SESSION['username'] ?>
                </a><hr>
                <a href="logout.php" class="log-out">Sign out</a>
            </div>
            <?= gerNav('gallery.php','galleryy', 'Gallery') ?>
            <?= gerNav('activity.php','activity', 'Activity') ?>
            <?= gerNav('about.php','about', 'About me') ?>
            <?= gerNav('contact.php','contact', 'Contact') ?>
        </nav>
    </header>