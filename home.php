<?php
session_start();
$bdd = new PDO('mysql:hostname=127.0.0.1;dbaname=bikori', 'root', ''); 
?>
<?php require 'header.php'; ?>
  <div class="home-container">
    <main>
      <div class="site-title">
        <h4>Bikori Photography</h4>
      </div>
      <p class="small-site-description">
        To me, photography is an art of observation. I’ve found it has little to do with the things you see and everything to do with the way you see them.
      </p>
      <div class="direct-user-action">
        <div class="user-select-activity">
          <a href="activity.php"><img src="images/activity.png">My Activity</a>
        </div>
        <div class="user-select-gallery">
          <a href="gallery.php"><img src="images/gallery.png">My Full Gallery</a>
        </div>
      </div>
    </main>
  </div>
  <script src="scripts/header.js"></script>
  </body>
</html>