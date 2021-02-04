<?php
    $dsn = 'mysql:dbname=colyseum;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try {
        // connexion a la db 
        $dbh = new PDO($dsn, $user, $password);
         //gestion des erreurs
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    };

//récupère tout les clients sql
    try{
        $query = $dbh->query('SELECT * FROM `clients` ORDER BY `lastName`'); 
        $colyseum = $query->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo 'La requete à échoué';
    };
    //récupere les clients qui possède une carte sql
    try{
        $queryCard = $dbh->query('SELECT * FROM `clients` WHERE `card` = 1 ORDER BY `id`');
        $colyseumCard = $queryCard->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo 'La requete à échoué';
    };
 //récupere les clients qui ne possède pas de carte sql
    try{
        $queryNoCard = $dbh->query('SELECT * FROM `clients` WHERE `card` = 0 ORDER BY `id`');
        $colyseumNoCard = $queryNoCard->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo 'La requete à échoué';
    };
// récupere les type de spectale sql
    try{
        $typeSpectacle = $dbh->query('SELECT * FROM `showtypes` ORDER BY `type`');  
        $colyseumTypeSpectacle = $typeSpectacle->fetchAll(PDO::FETCH_OBJ);   
    }catch(PDOException $e){
        echo 'La requete à échoué';
    };
    //recupere les 20 premiers clients
    try{
        $twentyFirstClients =  $dbh->query('SELECT * FROM `clients` LIMIT 20 ');
        $colyseumTwentyFirstClients =  $twentyFirstClients->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo 'La requete à échoué';
    };
    //Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M"
    try{
        $nameClientsM=  $dbh->query('SELECT * FROM `clients` WHERE `lastName` LIKE \'M%\' ORDER BY `lastName`' );
        $colyseumNameClientsM =  $nameClientsM->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo 'La requete à échoué';
    };

    try{
        $colyseumShows =  $dbh->query('SELECT `title`,`performer`,`date`,`startTime` FROM `shows`  ORDER BY `title`' );
        $allShows =  $colyseumShows->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo 'La requete à échoué';
    };

    require 'views/templates/header.php';
?>
<h1 class="col-12"> Exercice 1 Afficher tous les clients</h1>
        <div class=" m-auto">
            <h4>Clients avec carte</h4>
        </div>

        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Lastname</th>
                <th scope="col">Firstname</th> 
                <th scope="col">Birthdate</th>
                <th scope="col">Card</th>
                <th scope="col">CardNumber</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($colyseumCard as $clients): ?>
                <tr>
                    <td><?= $clients->id ?></td>
                    <td><?= $clients->lastName ?></td>
                    <td><?= $clients->firstName ?></td>   
                    <td><?= $clients->birthDate ?></td>
                    <td><?= $clients->card?></td>
                    <td><?= $clients->cardNumber ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <div class=" m-auto">
            <h4>Clients sans carte</h4>
        </div>

        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Lastname</th>
                <th scope="col">Firstname</th> 
                <th scope="col">Birthdate</th>
                <th scope="col">Card</th>
                <th scope="col">CardNumber</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($colyseumNoCard as $clients): ?>     
                <tr>
                <td><?= $clients->id ?></td>
                <td><?= $clients->lastName ?></td>
                <td><?= $clients->firstName ?></td>   
                <td><?= $clients->birthDate ?></td>
                <td><?= $clients->card?></td>
                <td><?= $clients->cardNumber ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <h1 class="col-12">Exercice 2 Afficher tous les types de spectacles possibles</h1>

            <div class=" m-auto">
                <h4>Types de spectacles</h4>   
            </div>
            <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Types de spectacles</th>           
                    </tr>
                </thead>
                <tbody>
                <?php foreach($colyseumTypeSpectacle as $type): ?>
                    <tr>
                        <td><?= $type->id ?></td>
                        <td><?= $type->type ?></td>   
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>

        <h1 class="col-12">Exercice 3  Afficher les 20 premiers clients</h1>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Firstname</th> 
                        <th scope="col">Birthdate</th>
                        <th scope="col">Card</th>
                        <th scope="col">CardNumber</th>           
                    </tr>
                </thead>
                <tbody>
                <?php foreach($colyseumTwentyFirstClients as $clients): ?>
                    <tr>
                        <td><?= $clients->id ?></td>
                        <td><?= $clients->lastName ?></td>
                        <td><?= $clients->firstName ?></td>   
                        <td><?= $clients->birthDate ?></td>
                        <td><?= $clients->card?></td>
                        <td><?= $clients->cardNumber ?></td>  
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>

            <h1>Exercice 5 Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M"</h1>

            <?php foreach($colyseumNameClientsM as $clients):?>
                    <div class="col-12"><strong>Nom :</strong><span><?= $clients->lastName ?></span></div>
                
                    <div class="col-12"><strong>Prénom :</strong><span><?= $clients->firstName ?></span></div>
                    <br>
                    <?php endforeach ?>

                    <h1>Exercice 6 Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure.
                     Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure</h1>

                     <?php foreach($allShows as $show): ?>
                      <span class="col-12"><strong><?= $show->title ?></strong>  par <strong><?= $show->performer ?></strong> , le <strong><?= $show->date ?></strong> à <strong><?= $show->startTime ?></strong>.</span>
            <?php endforeach ?>


   
<?php  require 'views/templates/footer.php'; ?>