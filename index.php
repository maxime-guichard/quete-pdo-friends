<?php

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";

$statement = $pdo->query($query);

$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($friends);

echo "<ul>";

foreach($friends as $friend) {

    echo '<li>' . $friend['firstname'] . ' ' . $friend['lastname'] . '</li>';
}

echo '</ul>';
?>

<form action="" method="post">
    <div>
        <label for="firstname">Firstname:</label>
        <input type="text" id="firstname" name="firstname" value="Emma"></input>
    </div>
    </br>

    <div>
        <label for="lastname">Lastname:</label>
        <input type="text" id="lastname" name="lastname" value="Gues"></input>
    </div>
    </br>

    <div>
        <button type="submit">Add to list</button>
    </div>


</form>


<?php 

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']); 

$query = "INSERT INTO friend (firstname, lastname) VALUES ($firstname, $lastname)";

$statement = $pdo->prepare($query);

$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);


$statement->execute();


$friends = $statement->fetchAll();
?>