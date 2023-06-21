<?= require(APPROOT . '/views/includes/Navbar.php');?>
<div>
    <div class="reserveringTitel">
        <form action="<?= URLROOT; ?>leverancier/index" method="post">
            <select name="type" id="type">
                <option value="1">Selecteer Leveranciertype</option>
                <option value="Bedrijf">Bedrijf</option>
                <option value="Instelling">Instelling</option>
                <option value="Overheid">Overheid</option>
                <option value="Particulier">Particulier</option>
                <option value="Donor">Donor</option>
            </select>
            <button type="submit">Toon leveranciers</button>
        </form>
    </div>
    <table>
        <thead>
            <th>Naam</th>
            <th>Contact persoon</th>
            <th>Email</th>
            <th>Mobiel</th>
            <th>Leverancier nummer</th>
            <th>Leverancier type</th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>
</div>
<?php require(APPROOT . '/views/includes/Footer.php');?>