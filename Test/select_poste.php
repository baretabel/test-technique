<?php
$date=htmlentities($_GET['date']);
$heure=htmlentities($_GET['heure']);
$user=htmlentities($_GET['user']);
include 'dbconect.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `attribution` WHERE `date` = '$date' AND `id_horaire` = $heure");
    $stmt->execute();
    $stmt1 = $conn->prepare("SELECT * FROM `attribution` WHERE `id_user` = $user AND `date` = '$date' AND `id_horaire` = $heure");
    $stmt1->execute();
    $sql = $conn->prepare("SELECT COUNT(*) AS Num FROM `poste`");
    $sql->execute();
    $donnee=$sql->fetch();
    $num= $donnee['Num'];
    if(isset($stmt1)){
        $y=0;
        while ($donnees=$stmt1->fetch()){
            $y=$y+1;
        }
        if($y==0){
            if(isset($stmt)){
                $x=0;
                $tab=array();
                while ($don=$stmt->fetch()){
                    $x=$x+1;
                    $tab[] = $don['id_poste'];
                }
                var_dump($tab);
                if($x==0){
                    echo'<option value="">Sélectionner un poste</option>';
                    $req = $conn->prepare("SELECT * FROM `poste`"); 
                    $req->execute();
                    while ($data=$req->fetch()){
                        echo '<option value="'.$data['id'].'">'.$data['poste'].'</option>';
                    }
                }else if($x==$num){
                    echo'<option value="">Aucun poste disponible</option>';
                }else{
                    echo'<option value="">Sélectionner un poste</option>';
                    $req = $conn->prepare("SELECT DISTINCT * FROM `poste` WHERE NOT `id` IN (" . implode(',', array_map('intval', $tab)) . ")");
                    $req->execute();
                    while ($data=$req->fetch()){
                        echo '<option value="'.$data['id'].'">'.$data['poste'].'</option>';
                    } 
                }
            }else{
                echo 'non';
            }
        }else if($y==1){
            echo '<option value="">Vous disposer déja d\'un poste</option>'; 
        }
    }  
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

/*while ($don=$stmt->fetch()){
    echo "lol";
    $poste = $don['id_poste'];
    if($poste==null){
        $req = $conn->prepare("SELECT * FROM `poste`"); 
        echo $date;
    }else{
        $req = $conn->prepare("SELECT * FROM `poste` WHERE NOT `id` <=> $poste");
        echo $heure;
    }
    while ($data=$req->fetch()){
        echo '<option value="'.$data['id'].'">'.$data['poste'].'</option>';
    }
}*/
?>