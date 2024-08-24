<?php
require_once "libraries/Autoloader.php";
\Models\Model::connecter();
$listesAcheter = \Models\Acheter::showAll();
include "layout/header.php";
?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="../img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Ventes</p>
      <div class="bouton1">
        <form action="" method="GET">
          <button type="submit" name="page" value="ajout.Acheter" class="btn btn-primary btn-lg">Ajouter</button>
          <button type="submit" name="page" value="recherche.acheter" class="btn btn-secondary btn-lg">Rechercher</button><br><br>
          <button class="btn btn-success btn-lg" name="page" value="modifier.acheter" type="submit">Modifier</button>
        </form>
      </div>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Liste des Ventes<span class="badge badge-secondary">ITT</span></p>
        </div>
      </div>
        <table class="table table-success table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Numero Achat</th>
              <th scope="col">Client</th>
              <th scope="col">Modele</th>
              <th scope="col">Quantite</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                foreach($listesAcheter as $acheter):
                extract($acheter);
              ?>
              <th scope="row"><a href="#" class="lien"><?php echo $numachat?></a></th>
              <td><a href="#" class="lien"><?php echo $client?></a></td>
              <td><a href="#" class="lien"><?php echo $idmodele?></a></td>
              <td><a href="#" class="lien"><?php echo $quantite?></a></td>

            </tr>
            <?php endforeach;?>
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