<?= require(APPROOT . '/views/includes/Navbar.php');?>
<div class="grid shadow">
    <h1 class="color-green col-7-lg">Overzicht leverancieren</h1>
    <div class="LeverancierFilter col-5-lg">
        <form action="<?= URLROOT; ?>leverancier/index" method="post">
            <select name="type" id="type" class="p-1 brd-radius">
                <option value="1">Selecteer Leveranciertype</option>
                <option value="Bedrijf">Bedrijf</option>
                <option value="Instelling">Instelling</option>
                <option value="Overheid">Overheid</option>
                <option value="Particulier">Particulier</option>
                <option value="Donor">Donor</option>
            </select>
            <button class="btn-grey text-white standard-font" type="submit">Toon leveranciers</button>
        </form>
    </div>
    <table class="table col-12-lg">
        <thead>
            <th>Naam</th>
            <th>Contact persoon</th>
            <th>Email</th>
            <th>Mobiel</th>
            <th>Leverancier nummer</th>
            <th>Leverancier type</th>
            <th>Product details</th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>
    <div class="col-10-lg"></div>
    <div class="col-2-lg">
        <a class="btn-primary text-white" href="/landingpages/index">home</a>
    </div>
</div>
<?php require(APPROOT . '/views/includes/Footer.php');?>