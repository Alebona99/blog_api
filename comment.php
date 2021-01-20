<?php

require_once(__DIR__.'/vendor/autoload.php');
use Monolog\Logger;


$logger = new Logger ('test_db');

$link = mysqli_connect('172.23.0.2', 'root', 'rootpassword');

if (!$link){
    $logger->warning('This is a log error');
    echo "Error: impossibile connettersi al db";
    echo "Debugging errno".mysqli_connect_errno().PHP_EOL;
    echo "Debugging error". mysqli_connect_error().PHP_EOL;
    exit;
}

$db_selected = mysqli_select_db($link,'blog');
if (!$db_selected){
  $logger->warning('Il Db selezionato non esiste');
  $logger->error("Errore nella selezione del db".mysqli_error($link));
}

$logger->info("Connessione al db riuscita".mysqli_get_host_info($link));


if (isset($_REQUEST) && $_REQUEST['post_id'] ) {

    // Sanitize
    $id_post = filter_var( $_REQUEST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    


    $query = "SELECT * FROM `Comment`WHERE post_ref=".$id_post;
    $result = mysqli_query($link, $query);
    
    
    
        while($row =mysqli_fetch_array($result)){
        $comment_id = $row['comment_id'];
        $post_ref = $row['post_ref'];
        $author_comment = $row['author_comment'];
        $date = $row['data_ora_comment'];
        $descr_comment = $row['description_comment'];
        
        $dati[] = array("comment_id"=>$comment_id,"post_ref" =>$post_ref,"author_comment"=>$author_comment,"date"=>$date,"descr_comment"=>$descr_comment);
        
    }
        
    
}

else{
    $dati = "Non hai inserito l'id o il post non esiste";
}

echo $jsonformat = json_encode($dati);


mysqli_close($link);
?>