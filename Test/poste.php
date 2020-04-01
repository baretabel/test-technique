<?php
$date=htmlentities($_GET['date']);
$heure=htmlentities($_GET['heure']);
$user=htmlentities($_GET['user']);
$poste=htmlentities($_GET['poste']);
include 'dbconect.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `attribution`(`id_user`, `date`, `id_horaire`, `id_poste`) VALUES ('$user','$date','$heure','$poste')";
    $conn->exec($sql);
    echo "Poste attribué";
    }
catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }

$conn = null;
?>