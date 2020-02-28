<?php
session_start();
require 'header.php'; ?>
    <div class="new-photo-container">
        <div class="new-photo-content">
            <form method="POST">
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