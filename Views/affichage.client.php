<?php
require_once "libraries/Autoloader.php";
$listeclients = \Models\Client::find($_GET);
include "layout/header.php";
?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="../img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Clients</p>
      <div class="bouton1">
        <form action="" method="GET">
          <button type="submit" value="ajout.client" name="page" class="btn btn-primary btn-lg">Ajouter</button>
          <button type="submit" class="btn btn-secondary btn-lg" name="page" value="recherche.client">Rechercher</button><br><br>
          <button class="btn btn-success btn-lg" name="page" value="modifier.client" type="submit">Modifier</button>
          <button class="btn btn-danger btn-lg" name="page" value="supprimer.client" type="submit">Supprimer</button>
        </form>
      </div>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Résultat de la recherche des Clients<span class="badge badge-secondary">ITT</span></p>
        </div>
      </div>
        <table class="table table-success table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Reference Client</th>
              <th scope="col">Client</th>
              <th scope="col">Adresse</th>
              <th scope="col">Province</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach($listeclients as $client) :
              extract($client);
            ?>
            <tr>
              <th scope="row"><a href="#" class="lien"><?php echo $RefClt?></a></th>
              <td><a href="#" class="lien"><?php echo $Client?></a></td>
              <td><a href="#" class="lien"><?php echo $Adresse?></a></td>
              <td><a href="#" class="lien"><?php echo $idProvince?></a></td>
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