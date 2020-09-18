<?php
require_once './../../config/database.php'; 


function filterString($field){
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(empty($field)){
        return false;
    }else{
        return $field;
    }
}

$songError = $artistError = $scaleError  ='';
$song = $artist = $scale ='';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $song = filterString($_POST['song']);
    $artist = filterString($_POST['artist']);
    $scale = filterString($_POST['scale']);


    if(!$song){
        $_SESSION['song_form']['song'] = '';
        $songError = "The song is required";
    }else{
        
        $_SESSION['song_form']['song'] = $song ;
    }

    if(!$artist){
        $_SESSION['song_form']['artist'] ='' ;
        $artistError = "The artist name is required";
    }else{
        $_SESSION['song_form']['artist'] =$artist ;
    }

    if(!$scale){
        $_SESSION['song_form']['scale'] = '';
        $scaleError = "The scale name is required";
    }else{
        $_SESSION['song_form']['scale'] = $scale;
    }



    if(!$songError && !$artistError && !$scaleError){

        $insertMessage = "insert into songs (name, artist_name, scale)".
        "values ('$song','$artist','$scale')";
       
        $mysqli->query($insertMessage);

     
            // session_destroy();
            $_SESSION['success_message'] = "تم اضافة السؤال بنجاح ✅";
            $_SESSION['song_form']='';
            header('Location: addSong.php');
            die();
       
        
    }



}
