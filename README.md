#Creazione API di un Blog

1. installare l'applicativo contenenete php7.4-apache, xdebug, mysql5.7 e phpmyadmin con il comando 'docker-compose up --build' o 'docker-compose up -d'

2. Per poter utilizzare la libreria Monolog di composer installare dal terminale del container composer con i seguenti passi:

2. 1: apt-get update && apt-get install wget
2. 2: wget https://getcomposer.org/download/2.0.8/composer.phar
2. 3: mv composer.phar composer
2. 4: chmod +x composer
2. 5: ./composer
2. 6: mv composer /usr/local/bin
2. 7: composer --version
2. 8: apt-get install zip
2. 9: composer require monolog/monolog
2. Dovete inserire il token che verrà generato da github;

3. Lo script post.php ci ritorna tutti i post del blog pubblicati in ordine cronologico, se viene passato dal browser l'id di un post esso ci ritornerà il suddetto post;
4. Lo script comment.php con l'id del post passato nel browser ci ritornerà i commenti del post con id passato;
5. Lo script author.php ritorna i dettagli dell'autore del Post il cui id è fornito in query string;  