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
          <p class="display-4 titre">Modifier Modele<span class="badge badge-secondary">Modifier</span></p>
        </div>
      </div>
        <!--Eto aho-  -->
        <form class="row g-3 needs-validation" novalidate action="" method="POST">
        <h4>Sélectionnez l'identifiant du modèle à Modifier</h4>
        <div class="col-md-6">
            <label for="idModele" class="form-label">idModele</label>
            <select class="form-select" id="modele" name="idModele" required>
              <?php
                  $mods = \Models\ModeleI::showAll("idModele");
                  foreach($mods as $mod):
                    extract($mod);
                ?>              
                <option value="<?php echo $idModele?>"><?php echo $idModele?></option>
              <?php endforeach;?>
            </select>
        </div>  
        <div class="col-md-6">
            <label for="Modele" class="form-label">Modele</label>
            <input type="text" class="form-control" id="modele" name="Modele" required>
          </div>
          <div class="col-md-6">
            <label for="Taille" class="form-label">Taille</label>
            <select class="form-select" id="taille" name="Taille" required>
              <?php 
                $a = \Models\ModeleI::showAll('Taille');
                foreach($a as $e):
                extract($e);
              ?>
              <option value="<?php echo $Taille?>"><?php echo $Taille?></option>
              <?php endforeach?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="PrixUnitaire" class="form-label">PrixUnitaire</label>
            <input type="text" class="form-control" id="PrixUnitaire" name="PrixUnitaire"  required>
          </div>
          <div class="col-md-6">
            <label for="idInstrument" class="form-label">Instrument</label>
            <select class="form-select" id="validationCustom04" name="idInstrument" required>
              <?php
                $idI = \Models\Instrument::showAll("idInstrument");
                foreach($idI as $id):
                extract($id);
              ?>
              <option value="<?php echo $idInstrument?>"><?php echo $Instrument?></option>
              <?php endforeach?>
            </select>
          </div><br>
          <div class="col-6">
            <button class="btn btn-primary" name="Modifier" type="submit">Modifier</button>
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
if(isset($_POST['Modifier']))
\Controllers\ModeleI::update($_POST);

?>