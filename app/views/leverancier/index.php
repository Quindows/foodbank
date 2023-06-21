<?= require(APPROOT . '/views/includes/Navbar.php');?>
<div class="grid shadow">
    <div class="col-12-lg space-between p-3">
        <h1 class="color-green">Overzicht leverancieren</h1>
        <div class="LeverancierFilter">
            <form action="<?= URLROOT; ?>leverancier/index" method="post">
                <select name="type" id="type">
                    <option value="1">Selecteer Leveranciertype</option>
                    <option value="Bedrijf">Bedrijf</option>
                    <option value="Instelling">Instelling</option>
                    <option value="Overheid">Overheid</option>
                    <option value="Particulier">Particulier</option>
                    <option value="Donor">Donor</option>
                </select>
                <button class="button" type="submit">Toon leveranciers</button>
            </form>
        </div>
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
    <div class="col-12-lg align-left">
        <a class="button-blue" href="/landingpages/index">home</a>
    </div>
</div>
<?php require(APPROOT . '/views/includes/Footer.php');?>