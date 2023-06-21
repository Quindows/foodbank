<!-- Navbar -->
<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">
        <!-- Page Title -->
        <h3><?= $data['title'] ?></h3>

        <form class="container" action="<?= URLROOT; ?>/score/index" method="post">
            <input class="col-3" type="date" name="date" id="date" value="<?= $data["date"]; ?>">
            <input class="col-3 ml-2 btn-outlined-grey" type="submit" value="Tonen">
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