<H3>Homepage voedselbank maaskantje</H3>
<?= require(APPROOT . '/views/includes/Navbar.php'); ?>
<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">
        <div class="grid-item" style="margin-left: 53rem;">
            <form action="<?= URLROOT; ?>/voedselpakket/index" method="post">
                <select id="Eetwens" name="Eetwens" style="margin-right: 1rem;">
                    <option value="" selected>Selecteer Eetwens</option>
                    <option value="Omnivoor">Omnivoor</option>
                    <option value="Vegetarisch">Vegetarisch</option>
                    <option value="Veganistisch">Veganistisch</option>
                    <option value="GeenVarken">GeenVarken</option>
                    <input type="submit" class="text-white btn-grey" value="Toon Gezinnen">
                </select>
            </form>
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