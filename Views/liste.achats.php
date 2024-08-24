<?php
require_once "libraries/Autoloader.php";
\Models\Model::connecter();
$listesAchats = \Models\Achat::showAll();
include "layout/header.php";
?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="../img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Achats</p>
      <div class="bouton1">
        <form action="" method="GET">
          <button type="submit" name="page" value="ajout.achat" class="btn btn-primary btn-lg">Ajouter</button>
          <button type="submit" class="btn btn-secondary btn-lg" name="page" value="recherche.achat">Rechercher</button><br><br>
          <button class="btn btn-success btn-lg" name="page" value="modifier.achat" type="submit">Modifier</button>
          <button class="btn btn-danger btn-lg" name="page" value="supprimer.achat" type="submit">Supprimer</button>
        </form>
      </div>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Liste des Achats<span class="badge badge-secondary">ITT</span></p>
        </div>
      </div>
        <table class="table table-success table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Numero Achat</th>
              <th scope="col">Date Achat</th>
              <th scope="col">Heure Achat</th>
              <th scope="col">Shop</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach($listesAchats as $achat):
              extract($achat);
            ?>
            <tr>
              <th scope="row"><a class="lien" href="#"><?php echo $NumAchat?></a></th>
              <td><a class="lien" href="#"><?php echo $DateAchat?></a></td>
              <td><a class="lien" href="#"><?php echo $HeureAchat?></a></td>
              <td><a class="lien" href="#"><?php echo $shop?></a></td>
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