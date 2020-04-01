<?php
include 'dbconect.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `user`");
    $stmt->execute();
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo'<option value="">Sélectionner un utilisateur</option>';
while ($don=$stmt->fetch()){
    echo '<option value="'.$don['id'].'">'.$don['user'].'</option>';
}
?>