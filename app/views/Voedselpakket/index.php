<link rel="stylesheet" href="../../../public/css/style.css">
<div class="grid pt-4">
    <div class="container fd-c col-12-lg ai-fs">
        <div class="grid-item ac-fs display-f">
            <h2 class="text-green" style="text-decoration: underline;">Overzicht gezinnen met voedselpakketten</h2>

            <form action="<?= URLROOT; ?>/voedselpakket/index" method="post" style="margin-left : 20rem;">
                <select id="Eetwens" name="Eetwens" style="margin-right: 1rem;">
                    <option value="" selected>Selecteer Eetwens</option>
                    <option value="Omnivoor">Omnivoor</option>
                    <option value="Vegetarisch">Vegetarisch</option>
                    <option value="Veganistisch">Veganistisch</option>
                    <option value="GeenVarken">GeenVarken</option>
                </select>
                <input type="submit" class="text-white btn-grey" value="Toon Gezinnen">
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
        </table>
        <a class="btn-blue" href="../landingspages/index" style="margin-left: 64rem;">home</a>

    </div>
</div>

<?php require(APPROOT . '/views/includes/Footer.php'); ?>