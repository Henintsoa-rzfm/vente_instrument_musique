<?php include "layout/header.php"?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Modele d'instrument</p>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Supprimer Modele<span class="badge badge-secondary">Supprimer</span></p>
        </div>
      </div>
        <!--Eto aho-  -->
        <form class="row g-3 needs-validation" novalidate action="" method="POST">
        <h4>Sélectionnez l'identifiant du modèle à Supprimer</h4>
          <div class="col-md-6">
            <label for="idModele" class="form-label">Modele</label>
            <select class="form-select" id="validationCustom04" name="idModele" required>
              <?php
                $idI = \Models\ModeleI::showAll("idModele");
                foreach($idI as $id):
                extract($id);
              ?>
              <option value="<?php echo $idModele?>"><?php echo $Modele?></option>
              <?php endforeach?>
            </select>
          </div><br>
          <div class="col-6">
            <button class="btn btn-danger" name="supprimer" type="submit">Supprimer</button>
          </div>
        </form>
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
if(isset($_POST['supprimer']))
\Controllers\ModeleI::delete($_POST['idModele']);

?>