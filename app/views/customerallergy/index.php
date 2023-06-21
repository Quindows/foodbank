<!-- Navbar -->
<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <h3 class="text-align-center col-6-lg">Overview of families with allergies</h3>
    <form class="container col-6-lg" action="<?= URLROOT; ?>/customerallergy/index" method="post">
        <select name="value">
            <option name="allergy" value="Gluten">Gluten</option>
            <option name="allergy" value="Pindas">Pindas</option>
            <option name="allergy" value="Schaaldieren">Schaaldieren</option>
            <option name="allergy" value="Hazelnoten">Hazelnoten</option>
            <option name="allergy" value="Lactose">Lactose</option>
            <option name="allergy" value="Soja">Soja</option>
        </select>
        <input class="btn-primary" type="submit" name="btn-sumbit" value="Toon gezinnen">
    </form>

    <div class="container fd-c col-12-lg ai-fs">


        <!-- Family Table -->
        <table class="table table-striped">
            <thead>
                <th>Naam</th>
                <th>Omschrijving</th>
                <th>Volwassenen</th>
                <th>Kinderen</th>
                <th>Babys</th>
                <th>Vertegenwoordiger</th>
                <th>Allergy Details</th>
            </thead>
            <tbody>
                <?= $data['rows'] ?>
            </tbody>
        </table>
        <br>
    </div>
</div>