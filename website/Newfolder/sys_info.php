<?php

$hostname = 'localhost';
$username = 'pi_select';
$password = '123456';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=measurements",
                               $username, $password);

    /*** The SQL SELECT statement ***/

    $sth = $dbh->prepare("
       SELECT *
       FROM `system_info` 
       ORDER BY `dtg` DESC
       LIMIT 0,1
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

$bullet_json[0]['title'] = "CPU Load";
$bullet_json[0]['subtitle'] = "System load";
$bullet_json[0]['ranges'] = array(0.75,1.0,2);
$bullet_json[0]['measures'] = array($result[0]['load']);
$bullet_json[0]['markers'] = array(1.1);

$bullet_json[1]['title'] = "Memory Used";
$bullet_json[1]['subtitle'] = "%";
$bullet_json[1]['ranges'] = array(85,95,100);
$bullet_json[1]['measures'] = array($result[0]['ram']);
$bullet_json[1]['markers'] = array(75);

$bullet_json[2]['title'] = "Disk Used";
$bullet_json[2]['subtitle'] = "%";
$bullet_json[2]['ranges'] = array(85,95,100);
$bullet_json[2]['measures'] = array($result[0]['disk']);
$bullet_json[2]['markers'] = array(50);

$bullet_json[3]['title'] = "CPU Temperature";
$bullet_json[3]['subtitle'] = "Degrees C";
$bullet_json[3]['ranges'] = array(40,60,80);
$bullet_json[3]['measures'] = array($result[0]['temperature']);
$bullet_json[3]['markers'] = array(50);

echo json_encode($bullet_json); 

?>

