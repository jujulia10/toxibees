<?php 

function display_string ($string, $len) {

	$string = stripslashes($string);

	if(strlen($string) > $len) return substr($string, 0, $len).'(...)'; else return $string;

}

//==== Redirect... Try PHP header redirect, then Java redirect, then try http redirect.:

function redirect($url){

    if (!headers_sent()){    //If headers not sent yet... then do php redirect

        header('Location: '.$url); exit;

    }else{                    //If headers are sent... do java redirect... if java disabled, do html redirect.

        echo '<script type="text/javascript">';

        echo 'window.location.href="'.$url.'";';

        echo '</script>';

        echo '<noscript>';

        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';

        echo '</noscript>'; exit;

    }

}//==== End -- Redirect

//afficher texte avec le nombre maximal de ligne et le nombre de charartères maximal par ligne

function textwrap($text, $max_nb_char_by_line, $max_nb_line){

  //ajouter un saut de ligne à nombre de charactères maximal par ligne.

  $text = wordwrap(trim($text), $max_nb_char_by_line, "\n");

  //séparer le text par saut de ligne

  $arr_txt = explode("\n", $text);



  //afficher le texte jus qu'au nombre maximal par ligne.

  $i=0;

  foreach($arr_txt as $txt){

    if ($i<$max_nb_line){

      $newtext .= $txt."\n";

      $i++;

    }

    else break;

  }

  return nl2br($newtext);

}

function email_OK ($email) {

    $test_mail=eregi('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)+$',$email);

    if ($test_mail) {

        list ($login, $domaine) = split ("@", $email,2);

        if (checkdnsrr ($domaine, "MX")) {

            return TRUE;

        }

        else {

            return FALSE;

        }

    }

    else {

        return FALSE;

    }

}



function thumbnail($img_file, $img_max_width, $img_max_height, $prefix) {

  

  //echo $img_file;

  //echo '-<br>';

  $file = realpath($img_file); // Chemin canonique absolu de l'image

  //echo '--<br>';

  $dir = dirname($img_file).'/'; // Chemin du dossier contenant l'image

  $img_infos = getimagesize($img_file); // Récupération des infos de l'image

  $img_width = $img_infos[0]; // Largeur de l'image

  $img_height = $img_infos[1]; // Hauteur de l'image

  $img_type = $img_infos[2]; // Type de l'image

  //echo '<pre>';print_r($img_infos);echo '</pre>';

  

  // Détermination des dimensions de l'image

  if ($img_max_width > $img_width) {

    $img_max_width = $img_width; // Largeur de la vignette

  }

  

  if ($img_max_height > $img_height) {

    $img_max_height = $img_height; // Hauteur de la vignette

  }

  // Facteur largeur par hauteur des dimensions max de la vignette

  $img_thumb_fact_width_height = $img_max_width / $img_max_height;

  // Facteur largeur par hauteur de l'original

  $img_fact_width_height = $img_width / $img_height;

  

  // Détermination des dimensions de la vignette

  if ($img_thumb_fact_width_height < $img_fact_width_height) {

    $img_thumb_width  = $img_max_width; // Largeur de la vignette

    $img_thumb_height = $img_thumb_width / $img_fact_width_height; // Hauteur

  } else {

    $img_thumb_height = $img_max_height;  // Hauteur de la vignette

    $img_thumb_width  = $img_thumb_height * $img_fact_width_height; // Largeur

  }

  

  

  // Sélection des variables selon l'extension de l'image

  switch ($img_type) {

    case 1:

      // Création d'une nouvelle image png à partir d'un image gif

      $img = imagecreatefromgif($file);

      $img_ext = '.gif'; // Extension de l'image

      break;

    case 2:

      // Création d'une nouvelle image jpeg à partir du fichier

      $img = imagecreatefromjpeg($file);

      $img_ext = '.jpg'; // Extension de l'image

      break;

    case 3:

      // Création d'une nouvelle image png à partir du fichier

      $img = imagecreatefrompng($file);

      $img_ext = '.png';  // Extension de l'image

  }

  // Création de la vignette

  $img_thumb = imagecreatetruecolor($img_thumb_width, $img_thumb_height);

   // Insertion de l'image de base redimensionnée

  imagecopyresized($img_thumb, $img, 0, 0, 0, 0, $img_thumb_width,

                                                 $img_thumb_height,

                                                 $img_width,

                                                 $img_height);

$file_name = basename($img_file, $img_ext); //Nom du fichier sans son extension

// Chemin complet du fichier de la vignette

  $img_thumb_name = $dir.$prefix.$file_name.$img_ext;

  

  // Sélection de la vignette créée

  switch($img_type){

    case 1:

      imagegif($img_thumb, $img_thumb_name); // Enregistrement d'une image gif

    case 2:

    // Enregistrement d'une image jpeg avec une compression de 75 par défaut

      imagejpeg($img_thumb, $img_thumb_name);

      break;

    case 3:

      imagepng($img_thumb, $img_thumb_name); // Enregistrement d'une image png

  }



  return $img_thumb_name; // Chemin de la vignette

}

?>

