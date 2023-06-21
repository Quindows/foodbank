<!-- Navbar -->
<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <h3 class="text-align-center col-6-lg">Overview of families with allergies</h3>
    <form class="container col-6-lg" action="<?= URLROOT; ?>/reservering/index" method="post">
        <input class="mr-3" type="date" name="date" id="date" value="">
        <input class="btn-primary" type="submit" value="Tonen">
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