<?php
//Connessione al db con Monolog

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
        

        
        $query = "SELECT * FROM `Post` INNER JOIN Author ON author_post=author_id WHERE post_id=".$id_post;
        $result = mysqli_query($link, $query);
        
       
        while($row = mysqli_fetch_array($result)){
            $id_author = $row['author_id'];
            $nome = $row['nome'];
            $cognome = $row['cognome'];
            $email = $row['email'];
            $dati [] = array('id_author'=>$id_author, 'nome' =>$nome, 'cognome'=>$cognome, 'email'=>$email);

            }
        
            
    }
    

echo $jsonformat = json_encode($dati);

mysqli_close($link);

?>