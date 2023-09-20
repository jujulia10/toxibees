<?php
    include('includes/conf_db.inc');
    
if(isset($_POST['id_article']) && !empty($_POST['id_article'])){
        $sql = "DELETE `toxibees_articles`, `toxibees_auteurs_liens`, `toxibees_urls`  FROM `toxibees_articles`
        INNER JOIN `toxibees_urls` ON `id_article` = `toxibees_urls`.`id_objet` 
        INNER JOIN `toxibees_auteurs_liens` ON `id_article` = `toxibees_auteurs_liens`.`id_objet` 
        WHERE `id_article` = ".$_POST['id_article'];
        // echo $sql.'<br>'; die();
        $req = $db->query($sql); 
        
        $errordb=$db->errorInfo();
    
        if($errordb[2]!=''){     
            $response['id_article'] = $_POST['id_article'];
            $response['name'] = $_POST['name'];
            $response['status'] = 'error';
            $response['message'] = 'Erreur SQL !<br>'.$sql.'<br>'.$errordb[2];;
        } else {
            $response['id_article'] = $_POST['id_article'];
            $response['name'] = $_POST['name'];
        }
    
        $select = "SELECT * FROM `toxibees_articles`
        INNER JOIN `toxibees_mots_liens` ON `toxibees_mots_liens`.`id_objet` = `id_article` 
        WHERE `id_article` = ".$_POST['id_article'];
        
        $req = $db->query($select);
        if($req->rowCount() > 0){
            $sql_links = "DELETE `toxibees_articles`, `toxibees_mots_liens` FROM `toxibees_articles`
            INNER JOIN `toxibees_mots_liens` ON `toxibees_mots_liens`.`id_objet` = `id_article` 
            WHERE `id_article` = ".$_POST['id_article'];
            $req = $db->query($sql_links); 
        
            $errordb=$db->errorInfo();
        } 
    
        echo json_encode($response);
    }
?>