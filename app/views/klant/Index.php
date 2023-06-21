<!-- Navbar -->
<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">
        <!-- Page Title -->
        <h3><?= $data['title'] ?></h3>

        <form class="container" action="<?= URLROOT; ?>klant/index" method="post">
            <select name="type" id="type">
                <option value="1">Selecteer Postcode</option>
                <option value="5271TH">5271TH</option>
                <option value="5271ZE">5271ZE</option>
                <option value="5271TJ">5271TJ</option>
                <option value="5271ZH">5271ZH</option>
            </select>
            <button class="col-3 ml-2 btn-outlined-grey" type="submit">Toon klanten</button>

        </form>
        <!-- Score Table -->
        <table class="table table-striped">
            <thead>
                <th>Naam Gezin</th>
                <th>vertegenwoordiger</th>
                <th>E-maildres</th>
                <th>Mobiel</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>Klant Details</th>
            </thead>
            <tbody>
                <?= $data['rows'] ?>
            </tbody>
        </table>
    </div>
</div>