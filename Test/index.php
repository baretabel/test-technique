<?php
include 'dbconect.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `user`");
    $stmt->execute();
    $req = $conn->prepare("SELECT * FROM `attribution`");
    $req->execute();   
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="JS/script.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
  
   
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="ajout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Création d'un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">  
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
            </div>
            <div class="form-group"> 
                <label for="pnom">Prénom</label>
                <input type="text" class="form-control" name="pnom" id="pnom" required>
            </div>
            <p id="texte"></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="add" class="btn btn-dark">Ajouter</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="attrib" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attribution de poste</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">  
                <label for="user">Utilisateur</label>
                <select name="user" class="form-control" id="user">
                    <option value="">Sélectionner un utilisateur</option>
                        <?php while ($don=$stmt->fetch()){?>
                            <option value="<?php echo $don['id'] ?>"><?php echo $don['user'] ?></option>
                        <?php } ?>
                </select>
            </div>
            <div class="form-group"> 
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" id="date">
            </div>
            <div class="form-group"> 
                <label for="heure">Plage Horaire</label>
                <select name="heure" class="form-control" id="heure" disabled>
                    <option value="">Sélectionner une plage horaire</option>
                    <option value="1">8h-10h</option>
                    <option value="2">10h-12h</option>
                    <option value="3">14h-16h</option>
                    <option value="4">16h-18h</option>
                </select>
            </div>
            <div class="form-group"> 
                <label for="poste">Poste</label>
                <select  class="form-control" name="poste" id="poste" disabled>
                    <option value="">Sélectionner un poste</option>
                </select>
            </div>
            <p id="text"></p>
      </div>
      <div class="modal-footer">
      
        <button type="button" id="new" class="btn btn-dark">Ajouter</button>
                       
      </div>
    </div>
  </div>
</div>
    

    
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th style="text-align: center" colspan="5">Tableau d'attribution</th>
                </tr>
            </thead>
            <tbody id="tab">
                <?php
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
                ?>
                    <tr>
                        <td><?php echo $don1['user']?></td>
                        <td><?php echo $donnee['date']?></td>
                        <td><?php echo $don3['horaire']?></td>
                        <td><?php echo $don2['poste']?></td>
                        <td onclick="sup(<?php echo $donnee['id']?>)"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="26" height="26" viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#e74c3c"><path d="M143.78125,129.93029l-13.8768,13.85096c-2.53246,2.55829 -6.66707,2.55829 -9.22536,0l-34.67909,-34.65324l-34.65324,34.65324c-2.55829,2.55829 -6.71875,2.55829 -9.25121,0l-13.8768,-13.85096c-2.55829,-2.55829 -2.55829,-6.69291 0,-9.2512l34.65324,-34.67909l-34.65324,-34.65324c-2.53245,-2.58413 -2.53245,-6.74459 0,-9.25121l13.8768,-13.8768c2.53246,-2.55829 6.69291,-2.55829 9.25121,0l34.65324,34.67909l34.67909,-34.67909c2.55829,-2.55829 6.71875,-2.55829 9.22536,0l13.8768,13.85096c2.55829,2.55829 2.55829,6.71875 0.02584,9.27704l-34.67908,34.65324l34.65324,34.67909c2.55829,2.55829 2.55829,6.6929 0,9.2512z"></path></g></g></svg></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="cont">
                    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#ajout">
    Création d'un utilisateur
    </button>
    <button id="mid"></button>
    <button type="button" class="btn btn-dark" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#attrib">
    Attribution de poste
    </button>
    </div>
</body>
</html>