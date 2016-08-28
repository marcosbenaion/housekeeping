<?php

echo "Hello Rod";

$hostname = 'localhost';
$username = 'pi_select';
$password = '123456';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=smarthome",
                               $username, $password);

    /*** The SQL SELECT statement ***/

    $sth = $dbh->prepare("
       SELECT *
       FROM `sistema` 
    ");
    $sth->execute();

    /* Fetch all of the remaining rows in the result set */
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    /*** close the database connection ***/
    $dbh = null;
    
}
catch(PDOException $e)
    {
        echo $e->getMessage();
    }

$json_data = json_encode($result); 

?>

