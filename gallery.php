<?php
session_start();
$bdd= new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root', '');
?>
<?php require 'header.php'; ?>
    <div class="photos-container">
    <div class="gallery">
    
    </div>
    <div class="loader">
        <svg>
            <circle cx="30" cy="30" r="20"></circle>        
        </svg>
    </div>
</div>
<script src="scripts/header.js"></script>
<script src="scripts/gallery.js"></script>
<script></script>
</body>
</html>