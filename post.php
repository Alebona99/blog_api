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



if (isset($_REQUEST) && $_REQUEST['post_id']) {

    // Sanitize
    $id_post = filter_var( $_REQUEST['post_id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM `Post`WHERE post_id=".$id_post;
    $result = mysqli_query($link, $query);
      
    
    while($row = mysqli_fetch_array($result)){
        $post_id = $row['post_id'];
        $author = $row['author_post'];
        $description_post = $row['description_post'];
        $data_ora_post = $rowrow['data_ora_post'];
        
        $dati[] = array('post_id'=>$post_id, 'author' =>$author, 'description_post'=>$description_post,'data_ora_post'=>$data_ora_post);
        echo $jsonformat = json_encode($dati);

    }
        
        
    
}


else{
$query_post = "SELECT * FROM `Post`ORDER BY data_ora_post ASC";
$result =mysqli_query($link, $query_post);
    
while($row = mysqli_fetch_array($result)){
    $post_id = $row['post_id'];
    $author_post = $row['author_post'];
    $description_post = $row['description_post'];
    $data_ora_post = $row['data_ora_post'];
    
    $dati[] = array('post_id'=>$post_id, 'author_post' =>$author_post, 'description_post'=>$description_post, 'data_ora_post'=>$data_ora_post);

    }
}  
echo $jsonformat = json_encode($dati);
    
    
mysqli_close($link);

?>