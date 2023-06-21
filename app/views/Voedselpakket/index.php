<H3>Homepage voedselbank maaskantje</H3>
<?= require(APPROOT . '/views/includes/Navbar.php'); ?>
<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">
        <table class="table table-striped">
            <thead>
                <th>Naam</th>
                <th>Omschrijving</th>
                <th>Volwassenen</th>
                <th>Kinderen</th>
                <th>Baby's</th>
                <th>Vertegenwoordiger</th>
                <th>VoedselPakket Details</th>
            </thead>
            <tbody>
                <?= $data['rows']; ?>
            </tbody>
            <!-- <a class="btn-grey" href="../supplier/createSupplier">Add supplier</a> -->
        </table>
    </div>
</div>

<?= var_dump($data['naam']); ?>
<?php require(APPROOT . '/views/includes/Footer.php'); ?>