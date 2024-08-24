<?php
require_once "libraries/Autoloader.php";
\Models\Model::connecter();
$listesCommercial = \Models\Commercial::showAll();
include "layout/header.php";
?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Commercial</p>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Liste des Vendeurs<span class="badge badge-secondary">ITT</span></p>
        </div>
      </div>
        <table class="table table-success table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">idCommercial</th>
              <th scope="col">Commercial</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($listesCommercial as $Commercials):
              extract($Commercials);
            ?>
            <tr>
              <th scope="row"><a href="#" class="lien"><?php echo $idCom?></a></th>
              <td><a href="#" class="lien"><?php echo $Commercial?></a></td>
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
<?php include "layout/footer.php";?>