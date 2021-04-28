<?php
    require_once 'connec.php';

    $pdo = new \PDO(DSN, USER, PASS);

    //$query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
    //$statement = $pdo->exec($query);
    
    //Présentation table AVANT modification


    //2 - Insérer une nouvelle bride en base

    //$query = "INSERT INTO bride (name, payment) 
    //VALUES (:name, :payment);";

    //$statement = $connection->prepare($query);

    //$statement->bindValue(':name', $title, PDO::PARAM_STR);
    //$statement->bindValue(':payment', $author, PDO::PARAM_STR);

    //$nbLine = $statement->execute();


    
    //Retrieve from FORM
    $firstname = trim($_POST['firstname']); // get the data from a form
    $lastname = trim($_POST['lastname']); // get the data from a form
    
    $data = array_map('trim', $_POST); //

    $firstname = htmlentities($data['firstname']);
    $lastname = htmlentities($data['lastname']);

    //requetes préparées
    $query = "INSERT INTO friend (firstname, lastname)
        VALUES (:firstname, :lastname);";
    
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    //$statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
    $statement->execute();

    $friends = $statement->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    $friends = $statement->fetchAll();
    foreach($friends as $friend) 
        {
            echo $friend['firstname'] . ' ' . $friend['lastname']. "<br>";
        }

?>