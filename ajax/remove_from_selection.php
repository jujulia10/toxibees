<?php    
    session_start();
    if(isset($_POST['id_article']) && !empty($_POST['id_article'])){
        $id = intval($_POST['id_article']);
        if(isset($_SESSION['selection_substances'][$id])){
            unset($_SESSION['selection_substances'][$id]);
        }
        $response['state'] = "success";
        $response['message'] = "La substance a bien été retiré de la sélection";    
    }else{
        $response['state'] = "error";
        $response['message'] = "Mauvais paramètre transmis.";
    }

    echo json_encode($response);
    die();
?>