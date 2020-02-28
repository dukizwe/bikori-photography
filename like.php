<?php
session_start();
$bdd= new PDO('mysql:host=127.0.0.1;dbname=bikori', 'root', '');
if(isset($_SESSION['username'])) {
    date_default_timezone_set('Africa/Bujumbura');
    $user = $bdd->prepare('SELECT * FROM members WHERE username = ?');
    $user->execute([$_SESSION['username']]);
    $user = $user->fetch();
    if(isset($_POST['target_post']) && isset($_POST['action'])) {
        if($_POST['action'] == 1) {// si on a voulu aimé


            //check du target_post qu'il n'est pas encore aimait par la session
            $checkpost = $bdd->prepare('SELECT * FROM likes WHERE user = ? AND post = ?');
            $checkpost->execute([$user['id'], $_POST['target_post']]);
            $checkpost = $checkpost->rowCount();

            //on cherhce le nbre de likes sur target_post
            $postlikes = $bdd->prepare('SELECT * FROM images WHERE id = ?');
            $postlikes->execute([$_POST['target_post']]);
            $postlikes = $postlikes->fetch();
            if($checkpost === 0) { //si le target_post post n'etait pas encore aimé par la session, on l'insere
            $addlike = $bdd->prepare('INSERT INTO likes(user,post,created_at) VALUES(?,?,?)');
            $addlike->execute([$user['id'], $_POST['target_post'], date('Y-m-d H:i:s')]);

            //et apres l'insertion, on inclumente  aussi le nbre de likes
            $postlikes_count = $postlikes['likes'] + 1;
            $updatelikes = $bdd->prepare('UPDATE images SET likes = ? WHERE id = ? ');
            $updatelikes->execute([$postlikes_count, $_POST['target_post']]);
            } else { //sinon, on supprime le like
                $deletelike = $bdd->prepare('DELETE FROM likes WHERE user = ? AND post = ?');
                $deletelike->execute([$user['id'], $_POST['target_post']]);
                
                //on declumente le compteur
                if($postlikes['likes'] > 0) {
                    $postlikes_count = $postlikes['likes'] - 1;
                }
                $updatelikes = $bdd->prepare('UPDATE images SET likes = ? WHERE id = ? ');
                $updatelikes->execute([$postlikes_count, $_POST['target_post']]);
            }
            $req = $bdd->prepare('SELECT likes FROM images WHERE id = ?');
            $req->execute([$_POST['target_post']]);
            header('Content-type: application/json');
            die(json_encode($req->fetch(PDO::FETCH_ASSOC)));

        } elseif($_POST['action'] == 2) {//si on a voulu ajouter aux favoris
            
            //check du target_post qu'il n'est pas encore ajoutait par la session
            $checkpost = $bdd->prepare('SELECT * FROM hearts WHERE user = ? AND post = ?');
            $checkpost->execute([$user['id'], $_POST['target_post']]);
            $checkpost = $checkpost->rowCount();

            //on cherhce le nbre de hearts sur target_post
            $posthearts = $bdd->prepare('SELECT * FROM images where id = ?');
            $posthearts->execute([$_POST['target_post']]);
            $posthearts = $posthearts->fetch();
            if($checkpost === 0) { //si le target_post post n'etait pas encore ajoutes par la session, on l'insere
                $addheart = $bdd->prepare('INSERT INTO hearts(user,post,created_at) VALUES(?,?,?)');
                $addheart->execute([$user['id'], $_POST['target_post'], date('Y-m-d H:i:s')]);

                //et apres l'insertion, on inclumente aussi le nbre de hearts
                $posthearts_count = $posthearts['hearts'] + 1;
                $updatehearts = $bdd->prepare('UPDATE images SET hearts = ? WHERE id = ? ');
                $updatehearts->execute([$posthearts_count, $_POST['target_post']]);
            } else { //sinon, on supprime le heart
                $deleteheart = $bdd->prepare('DELETE FROM hearts where user = ? and post = ?');
                $deleteheart->execute([$user['id'], $_POST['target_post']]);
                
                //on déclumente le compteur
                if($posthearts['hearts'] > 0) {
                    $posthearts_count = $posthearts['hearts'] - 1;
                }
                $updatehearts = $bdd->prepare('UPDATE images SET hearts = ? WHERE id = ? ');
                $updatehearts->execute([$posthearts_count, $_POST['target_post']]);
            }
            $req = $bdd->prepare('SELECT hearts FROM images where id = ?');
            $req->execute([$_POST['target_post']]);
            header('Content-type: application/json');
            die(json_encode($req->fetch(PDO::FETCH_ASSOC)));
        } else {
            # code...
        }
    }
}