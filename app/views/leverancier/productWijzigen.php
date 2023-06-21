<?= require(APPROOT . '/views/includes/Navbar.php');?>

<div class="card">
    <h2>Details optiepakket</h2>
    <div class="row">
        <h3>Optiepakket:</h3>
        <form action="<?= URLROOT; ?>leverancier/productWijzigen/<?= $data['id'] ?>" method="post" class="formcolumn">
            <input id="datum" name="datum "type="date">
            <button type="sumbit">Wijzigen</button>
        </form>
    </div>
    <p><?= $data['notification'] ?></p>
</div>








<?php require(APPROOT . '/views/includes/Footer.php');?>