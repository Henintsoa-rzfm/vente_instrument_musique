<?php
require_once "libraries/Autoloader.php";
\Models\Model::connecter();
$listesTelephone = \Models\Telephone::showAll();
include "layout/header.php";
?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="../img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Telephone</p>
      <div class="bouton1">
        <form action="" method="GET">
          <button type="submit"  value="ajout.telephone" name="page" class="btn btn-primary btn-lg">Ajouter</button>
          <button class="btn btn-success btn-lg" name="page" value="modifier.telephone" type="submit">Modifier</button><br><br>
            <button class="btn btn-danger btn-lg" name="page" value="supprimer.telephone" type="submit">Supprimer</button>
        </form>
      </div>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Liste des Telephones<span class="badge badge-secondary">ITT</span></p>
        </div>
      </div>
        <table class="table table-success table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Telephone</th>
              <th scope="col">Client</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($listesTelephone as $telephone):
            extract($telephone);
          ?>
            <tr>
              <th scope="row"><a href="#" class="lien"><?php echo $telclt?></a></th>
              <td><a href="#" class="lien"><?php echo $client?></a></td>
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
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
<?php include "layout/footer.php"?>