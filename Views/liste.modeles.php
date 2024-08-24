<?php
require_once "libraries/Autoloader.php";
\Models\Model::connecter();
$listesmodeles = \Models\ModeleI::showAll();
include "layout/header.php";
?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="../img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Modele d'Instrument</p>
      <div class="bouton1">
        <form action="" method="GET">
          <button type="submit" name="page" value="ajout.modeleI" class="btn btn-primary btn-lg">Ajouter</button>
          <button type="submit" name="page" value="recherche.modele" class="btn btn-secondary btn-lg">Rechercher</button><br><br>
          <button class="btn btn-success btn-lg" name="page" value="modifier.modele" type="submit">Modifier</button>
          <button class="btn btn-danger btn-lg" name="page" value="supprimer.modele" type="submit">Supprimer</button>
        
        </form>
      </div>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Liste des Modeles<span class="badge badge-secondary">ITT</span></p>
        </div>
      </div>
        <table class="table table-success table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">idModele</th>
              <th scope="col">Modele</th>
              <th scope="col">Taille</th>
              <th scope="col">PrixUnitaire</th>
              <th scope="col">Instrument</th>
            </tr>
          </thead>
          <tbody>
              <?php
                foreach($listesmodeles as $modeles):
                extract($modeles);
              ?>
            <tr>
              <th scope="row"><a href="#" class="lien"><?php echo $idModele?></a></th>
              <td><a href="#" class="lien"><?php echo $Modele?></a></td>
              <td><a href="#" class="lien"><?php echo $Taille?></a></td>
              <td><a href="#" class="lien"><?php echo $PrixUnitaire?></a></td>
              <td><a href="#" class="lien"><?php echo $instrument?></a></td>
              <form action="" method="GET">            
            </tr>
              <?php endforeach?>
          </tbody>
        </table> 
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="spinner-grow anim text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <div class="spinner-grow anim text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> 
  </div>
    </section>
    <?php include "layout/footer.php"?>