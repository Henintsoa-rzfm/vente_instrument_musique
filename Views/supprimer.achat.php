
<?php include "layout/header.php"?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Achats</p>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Supprimer Achat<span class="badge badge-secondary">Supprimer</span></p>
        </div>
      </div>
        <!--Eto aho-  -->

        <form class="row g-3 needs-validation" novalidate action="" method="POST">
          <h4>Sélectionnez le numéro de l'achat à Supprimer</h4>
        <div class="col-md-6">
            <label for="NumAchat" class="form-label">Numero Achat</label>
            <select class="form-select" id="NumAchat" name="NumAchat" required>
            <?php
            $achat = \Models\Achat::showAll("NumAchat");
            foreach($achat as $ach):
              extract($ach);
            ?>
              <option value="<?php echo $NumAchat?>"><?php echo $NumAchat?></option>
            <?php endforeach;?>
            </select>
        </div> <br>         
          <div class="col-6">
            <button class="btn btn-primary" name="Supprimer" type="submit">Supprimer</button>
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
  \Controllers\Achat::delete($_POST['NumAchat']);
  // print_r($_POST);
}
?>