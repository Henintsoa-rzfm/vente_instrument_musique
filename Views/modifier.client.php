<?php 
include "layout/header.php";
// $ma =\Models\Client::find($_GET);
// extract($ma);
?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Clients</p>
      
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Modifier Client<span class="badge badge-secondary">Modifier</span></p>
        </div>
      </div>
        <!--Eto aho-  -->
        <form class="row g-3 needs-validation" action="" method="POST">
        <h4>Sélectionnez la Réference du client à Modifier</h4>
          <div class="col-md-6">
            <label for="RefClt" class="form-label">Reference</label>
            <select class="form-select" name="RefClt" required>
              <?php 
                $acheteur = \Models\Client::showAll('RefClt');
                foreach($acheteur as $cli):
                extract($cli);
              ?>
              <option value="<?php echo $RefClt?>"><?php echo $RefClt;?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="Client" class="form-label">Client</label>
            <input type="text" class="form-control" id="client" name="Client"  required>
          </div>
          <div class="col-md-6">
            <label for="Adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="Adresse" required>
          </div>
          <div class="col-md-6">
            <label for="idProvince" class="form-label">Province</label>
            <select class="form-select" name="idProvince" required>
              <?php 
                $acheteur = \Models\Province::showAll('idProvince');
                foreach($acheteur as $cli):
                extract($cli);
              ?>
              <option value="<?php echo $idProvince?>"><?php echo $Province;?></option>
              <?php endforeach;?>
            </select>
          </div>
          
          <div class="col-6">
            <button class="btn btn-primary" name="Modifier" type="submit">Modifier</button>
          </div>
        </form>

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
    <?php
    if(isset($_POST['Modifier'])){
    \Controllers\Client::update($_POST);
    }
    if(isset($_POST['Supprimer'])){
      \Controllers\Client::delete($_POST['RefClt']);
      }
  ?>