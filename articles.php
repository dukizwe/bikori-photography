<?php
session_start();
$bdd= new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    a {
        background: #f2f2f2;
        padding: 5px;
        cursor: pointer;
    }
    .loading {
        display: none;
    }
    </style>
</head>
<body>
    <?php
    $articles = $bdd->query('SELECT * FROM images');
    while ($article = $articles->fetch()) {
        $count_post = $bdd->prepare('SELECT id FROM likes where post = ?');
        $count_post->execute([$article['id']]);
        $count_post = $count_post->rowCount();
        ?>
    <div>
        <div class="article">
            <?= $article['person'] ?>
            <div class="loading">loading...</div>
            <a href="#" class="like" data-user_id="<?= $_SESSION['username'] ?>" data-post_id="<?= $article['id']?>">like</a>
            <span class="likes_count"><?= $count_post ?></span>
        </div><br>
    </div>
    <?php }
    ?>
    <script>
        $(function() {
            $('a').click(like)
            function like(e) {
                e.preventDefault();
                var $this = $(this)
                $this.prev().css('display', 'inline-block')
                $this.css('display', 'none')
                $.post('addlike.php', {
                    post_id :$this.attr('data-post_id'),
                    user: $this.attr('data-user_id')
                }).done(function(data, textStatus, jqXHR) {
                    $this.next().text(data.likes)
                    $this.prev().css('display', 'none')
                    $this.css('display', 'inline')
                }).fail(function(jqXHR, textStatus, errorThrown) {

                })
            }
        })
    </script>
</body>
</html>