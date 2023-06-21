<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <h3 class="col-12-lg">Wijzig Allergie</h3>

    <div class="container fd-c col-12-lg ai-fs">
    <form class="container col-6-lg" action="<?= URLROOT; ?>/customerallergy/FamilyIndex/<?= $data['Id'] ?>" method="post">
        <select name="allergy" id="allergy">
        <option name="allergy" value="1">Selecteer allergie</option>
            <option name="allergy" value="Gluten">Gluten</option>
            <option name="allergy" value="Pindas">Pindas</option>
            <option name="allergy" value="Schaaldieren">Schaaldieren</option>
            <option name="allergy" value="Hazelnoten">Hazelnoten</option>
            <option name="allergy" value="Lactose">Lactose</option>
            <option name="allergy" value="Soja">Soja</option>
        </select>
        <input class="btn-primary" type="submit" name="btn-sumbit" value="Wijzig Allergie">
    </form>
    </div>
</div>