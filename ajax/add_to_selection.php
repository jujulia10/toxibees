<?php   
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();
    if(isset($_POST['id_article']) && !empty($_POST['id_article'])){
        
        if(!isset($_SESSION['selection_substances'])){
            $_SESSION['selection_substances'] = [];
        }
        
        if(count($_SESSION['selection_substances']) < 7){      
            $_SESSION['selection_substances'][intval($_POST['id_article'])] = intval($_POST['id_article']);
            $response['state'] = "success";
            $response['message'] = "La substance a bien été ajouté à votre sélection";    
        }else{
            $response['state'] = "danger";
            $response['message'] = "Impossible d'ajouter une nouvelle substance (8 maximum)";
        }
    }else{
        $response['state'] = "danger";
        $response['message'] = "Mauvais paramètre transmis.";
    }
    echo json_encode($response);
    die();
?>