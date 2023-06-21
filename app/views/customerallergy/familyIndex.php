<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <h3 class="col-12-lg">Overview of families with allergies</h3>
    <br>
    <p class="col-12-lg">Gezinsnaam: &nbsp; <?= $data['Gezinsnaam'] ?></p>
    <p class="col-12-lg">Omschrijving: &nbsp; <?= $data['Omschrijving'] ?></p>
    <p class="col-12-lg">Totaal aantal personen: &nbsp; <?= $data['TotaalAantalPersonen'] ?></p>

    <div class="container fd-c col-12-lg ai-fs">
        <!-- Family Table -->
        <table class="table table-striped">
            <thead>
                <th>Naam</th>
                <th>Type persoon</th>
                <th>Gezinsrol</th>
                <th>Allergie</th>
                <th>Wijzig allergie</th>
            </thead>
            <tbody>
                <?= $data['rows'] ?>
            </tbody>
        </table>
        <br>
    </div>
</div>