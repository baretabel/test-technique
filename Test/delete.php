<?php
$id = htmlentities($_GET['id']);
include 'dbconect.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `attribution` WHERE id=$id";
    $conn->exec($sql);
    $req = $conn->prepare("SELECT * FROM `attribution`");
    $req->execute();
    while ($donnee=$req->fetch()){
        $user= $donnee['id_user'];
        $poste= $donnee['id_poste'];
        $horaire= $donnee['id_horaire'];
        $req1 = $conn->prepare("SELECT * FROM `user` WHERE `id`='$user'");
        $req1->execute();
        $don1=$req1->fetch();
        $req2 = $conn->prepare("SELECT * FROM `poste` WHERE `id`='$poste'");
        $req2->execute();
        $don2=$req2->fetch();
        $req3 = $conn->prepare("SELECT * FROM `horaire` WHERE `id`='$horaire'");
        $req3->execute();
        $don3=$req3->fetch();
        echo "<tr><td>".$don1['user']."</td><td>".$donnee['date']."</td><td>".$don3['horaire']."</td><td>".$don2['poste']."</td><td onclick=\"sup(".$donnee['id'].")\"><svg xmlns=\"http://www.w3.org/2000/svg\" x=\"0px\" y=\"0px\" width=\"26\" height=\"26\" viewBox=\"0 0 172 172\"style=\" fill:#000000;\"><g fill=\"none\" fill-rule=\"nonzero\" stroke=\"none\" stroke-width=\"1\" stroke-linecap=\"butt\" stroke-linejoin=\"miter\" stroke-miterlimit=\"10\" stroke-dasharray=\"\" stroke-dashoffset=\"0\" font-family=\"none\" font-weight=\"none\" font-size=\"none\" text-anchor=\"none\" style=\"mix-blend-mode: normal\"><path d=\"M0,172v-172h172v172z\" fill=\"none\"></path><g fill=\"#e74c3c\"><path d=\"M143.78125,129.93029l-13.8768,13.85096c-2.53246,2.55829 -6.66707,2.55829 -9.22536,0l-34.67909,-34.65324l-34.65324,34.65324c-2.55829,2.55829 -6.71875,2.55829 -9.25121,0l-13.8768,-13.85096c-2.55829,-2.55829 -2.55829,-6.69291 0,-9.2512l34.65324,-34.67909l-34.65324,-34.65324c-2.53245,-2.58413 -2.53245,-6.74459 0,-9.25121l13.8768,-13.8768c2.53246,-2.55829 6.69291,-2.55829 9.25121,0l34.65324,34.67909l34.67909,-34.67909c2.55829,-2.55829 6.71875,-2.55829 9.22536,0l13.8768,13.85096c2.55829,2.55829 2.55829,6.71875 0.02584,9.27704l-34.67908,34.65324l34.65324,34.67909c2.55829,2.55829 2.55829,6.6929 0,9.2512z\"></path></g></g></svg></td></tr>";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>