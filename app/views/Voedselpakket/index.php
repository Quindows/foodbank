<H3>Homepage voedselbank maaskantje</H3>
<?= require(APPROOT . '/views/includes/Navbar.php'); ?>
<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">
        <form action="" method="post">
            <select id="Eetwens" name="Eetwens">
                <option value="" selected>Selecteer Eetwens</option>
                <option value=1>Omnivoor</option>
                <option value=2>Vegetarisch</option>
                <option value=3>Veganistisch</option>
                <option value=4>GeenVarken</option>
            </select>
        </form>

        <div class="col-12-lg">
            <button type="submit" class="text-white btn-grey">Toon Gezinnen</button>
        </div>
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