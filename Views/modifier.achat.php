
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
          <p class="display-4 titre">Modifier Achat<span class="badge badge-secondary">Modifier</span></p>
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
            <label for="NumAchat" class="form-label">Date Achat</label>
            <input type="date" class="form-control" id="DateAchat" name="DateAchat"  required>
          </div>
          <div class="col-md-6">
            <label for="HeureAchat" class="form-label">Heure Achat</label>
            <input type="text" class="form-control" id="heureAchat" name="HeureAchat"  required>
          </div>
          <div class="col-md-6">
            <label for="CodeMP" class="form-label">Mode de Paiement</label>
            <select class="form-select" id="CodeMP" name="CodeMP" required>
            <?php
            $modeP = \Models\ModePaiement::showAll("CodeMP");
            foreach($modeP as $Mp):
              extract($Mp);
            ?>
              <option value="<?php echo $CodeMP?>"><?php echo $MP?></option>
            <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="idCom" class="form-label">Commercial</label>
            <select class="form-select" id="idCom" name="idCom" required>
              <?php
              $coms = \Models\Commercial::showAll("idCom");
              foreach($coms as $com):
                extract($com);
              ?>
              <option value="<?php echo $idCom?>"><?php echo $Commercial?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="NumShop" class="form-label">Shop</label>
            <select class="form-select" id="NumShop" name="NumShop" required>
              <?php
              $shops = \Models\Shop::showAll("NumShop");
              foreach($shops as $shop):
                extract($shop);
              ?>
              <option value="<?php echo $NumShop?>"><?php echo $Shop?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-12">
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
  \Controllers\Achat::update($_POST);
  // print_r($_POST);
}
?>