<?php
session_start();
?>
<?php require 'header.php'; ?>
<div class="about-container">
    <div class="about-title">All about bikori photographer</div>
    <div class="about-content">
        <div class="carousel-images">
            <img src="images/1.jpg">
        </div>
        <div class="user-description">
            <div class="full-name">Full name<span>Bikorimana BestBoy</span></div>
            <div class="photograph-name">Photograph name<span>Bikori Pro</span></div>
            <div class="country">Country<span>Burundi</span></div>
            <div class="region">Region<span>Ruyigi</span></div>
            <div class="age">Age<span><?= date('Y')-2000 ?></span></div>
            <div class="photograph-begin">Photograph year biginning<span>2019</span></div>
        </div>
    </div>
</div>
<script src="scripts/header.js"></script>
</body>
</html>