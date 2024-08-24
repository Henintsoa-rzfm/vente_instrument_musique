<?php include "layout/header.php"?>
<section class="container-fluid liste ">
  <div class="row">
    <div class="col-lg-3 bg-dark">
      <img src="img/Logo.jpeg" class="image1 rounded mx-auto d-block" alt="...">
      <p class="letitre">Telephone</p>
      
    </div>
    <div class="col-lg-9"> 
      <div class="card text-center">
        <div class="card-header">
          <p class="display-4 titre">Modifier Telephone<span class="badge badge-secondary">Modifier</span></p>
        </div>
      </div>
        <!--Eto aho-  -->
        <form class="row g-3 needs-validation" novalidate action="" method="POST">
        <h4>Sélectionnez le numéro de téléphone à Modifier</h4>
        <div class="col-md-6">
            <label for="TelClt" class="form-label">Telephone</label>
            <select class="form-select" id="validationCustom04" name="TelClt" required>
            <?php
                  $clies = \Models\Telephone::showAll("TelClt");
                  foreach($clies as $clie):
                    extract($clie);
                ?>              
                <option value="<?php echo $telclt?>"><?php echo $telclt?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="RefClt" class="form-label">Client</label>
            <select class="form-select" id="validationCustom04" name="RefClt" required>
            <?php
                  $clies = \Models\Client::showAll("RefClt");
                  foreach($clies as $clie):
                    extract($clie);
                ?>              
                <option value="<?php echo $RefClt?>"><?php echo $client?></option>
              <?php endforeach;?>
            </select>
          </div>
          
          <div class="col-6">
            <button class="btn btn-primary" name="Modifier" value="" type="submit">Modifier</button>
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
  \Controllers\Telephone::update($_POST);
}
?>