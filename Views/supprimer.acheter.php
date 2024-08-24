<!-- A Vérifier -->
<?php include "layout/header.php"?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Opération</p>
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Modifier Vente<span class="badge badge-secondary">Modifier</span></p>
        </div>
      </div>
        <!--Eto aho-  -->
        <form class="row g-3 needs-validation" novalidate action="" method="POST">
          <h4>Sélectionnez le numéro de l'achat à Modifier</h4>
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
          </div>
          <div class="col-md-6">
            <label for="RefClt" class="form-label">Client</label>
            <select class="form-select" id="RefClt" name="RefClt" required>
            <?php
                  $clies = \Models\Client::showAll("RefClt");
                  foreach($clies as $clie):
                    extract($clie);
                ?>              
                <option value="<?php echo $RefClt?>"><?php echo $client?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="idModele" class="form-label">Modele</label>
            <select class="form-select" id="modele" name="idModele" required>
              <?php
                  $mods = \Models\ModeleI::showAll("idModele");
                  foreach($mods as $mod):
                    extract($mod);
                ?>              
                <option value="<?php echo $idModele?>"><?php echo $Modele?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="Quantite" class="form-label">Quantite</label>
            <input type="text" class="form-control" id="quantite" name="Quantite" required>
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
    if(isset($_POST['Supprimer'])){
      \Controllers\Acheter::delete($_POST);
      print_r($_POST);
    }
    ?>