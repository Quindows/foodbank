<?= require(APPROOT . '/views/includes/Navbar.php');?>
<div class="grid">
    <div class="col-2-lg"></div>
    <div class="col-8-lg card shadow">
        <h1 class="color-green">Wijzig product</h1>
            <form class="grid" action="<?= URLROOT; ?>leverancier/productWijzigen/<?= $data['id'] ?>" method="post" class="formcolumn">
                <h3 class="col-6-lg">Optiepakket:</h3>
                <input class="col-6-lg" id="datum" name="datum" type="date">
                <button class="col-6-lg button-grey" type="sumbit">Wijzigen HoudbaarheidsDatum</button>
                <div class="col-6-lg align-left">
                    <a class="button-blue" href="/leverancier/index">terug</a> 
                    <a class="button-blue" href="/landingpages/index">home</a>
                </div>
            </form>
        <p><?= $data['notification'] ?></p>
        <div class="col-2-lg"></div>
    </div>

</div>








<?php require(APPROOT . '/views/includes/Footer.php');?>