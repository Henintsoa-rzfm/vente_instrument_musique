<?php 
include "layout/header.php";
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
          <p class="display-4 titre">Supprimer Client<span class="badge badge-secondary">Supprimer</span></p>
        </div>
      </div>
        <!--Eto aho-  -->
        <form class="row g-3 needs-validation" action="" method="POST">
        <h4>Sélectionnez le client à Supprimer</h4>
          <div class="col-md-6">
            <label for="RefClt" class="form-label">Client</label>
            <select class="form-select" name="RefClt" required>
              <?php 
                $acheteur = \Models\Client::showAll('RefClt');
                foreach($acheteur as $cli):
                extract($cli);
              ?>
              <option value="<?php echo $RefClt?>"><?php echo $client;?></option>
              <?php endforeach;?>
            </select>
          </div><br><br>
          <div class="col-6">
            <button class="btn btn-danger" name="Supprimer" type="submit">Supprimer</button>
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
if(isset($_POST['Supprimer'])){
    \Controllers\Client::delete($_POST['RefClt']);
    // print_r($_POST);
}
      
  ?>