<?php
$nom=htmlentities($_GET['nom']);
$pnom=htmlentities($_GET['pnom']);
$user=$pnom.' '.$nom;
include 'dbconect.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO user (user) VALUES ('$user')";
    $conn->exec($sql);
    echo "Utilisateur Ajouter";
    }
catch(PDOException $e)
    {
    echo "échec";
    }

$conn = null;
?>