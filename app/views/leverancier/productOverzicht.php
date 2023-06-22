<?= require(APPROOT . '/views/includes/Navbar.php');?>

<div class="grid shadow">
    <h1 class="color-green col-12-lg">Overzicht producten</h1>
    <table class="table col-1-lg">
        <tr><td><strong>Naam:</strong></td><td><?= $data['leverancierData']->Naam ?></td></tr>
        <tr><td><strong>Leveranciersnummer:</strong></td><td><?= $data['leverancierData']->LeveranciersNummer ?></td></tr>
        <tr><td><strong>LeveranciersType:</strong></td><td><?= $data['leverancierData']->LeveranciersType ?></td></tr>
    </table>

    <table class="table col-12-lg">
        <thead>
            <th>Naam</th>
            <th>Soort allergie</th>
            <th>Barcode</th>
            <th>Houdbaarheidsdatum</th>
            <th>Wijzig product</th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>
    <div class="col-7-lg"></div>
    <div class="col-5-lg align-left">
        <a class="btn-primary text-white" href="/leverancier/index">terug</a> 
        <a class="btn-primary text-white" href="/landingpages/index">home</a>
    </div>
</div>

<?php require(APPROOT . '/views/includes/Footer.php');?>