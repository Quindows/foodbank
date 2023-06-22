<?= require(APPROOT . '/views/includes/Navbar.php');?>
<div class="grid">
    <div class="col-2-lg"></div>
    <div class="col-8-lg card shadow">
        <h1 class="color-green">Wijzig product</h1>
            <form class="grid" action="<?= URLROOT; ?>leverancier/productWijzigen/<?= $data['id'] ?>" method="post" class="formcolumn">
                <h3 class="col-6-lg">Optiepakket:</h3>
                <input class="col-6-lg" id="datum" name="datum" type="date">
                <?= $data['notification'] ?>
                <div class="col-12-lg display-f jc-sb ai-c">
                    <button class="col-6-lg btn-grey-light-6 standard-font text-white" type="sumbit">Wijzigen HoudbaarheidsDatum</button>
                    <div>                        
                        <a class="btn-primary text-white" href="/leverancier/index">terug</a> 
                        <a class="btn-primary text-white" href="/landingpages/index">home</a>
                    </div>
                </div>
            </form>
        <div class="col-2-lg"></div>
    </div>

</div>








<?php require(APPROOT . '/views/includes/Footer.php');?>