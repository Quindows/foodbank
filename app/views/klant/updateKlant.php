<!-- Navbar -->
<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">
        <!-- Page Title -->
        <h3><?= $data['title'] ?></h3>

        <table class="table table-striped">
            <!-- Klant Form-->
            <form action="" method="POST">
                <input class="mb-2" type="text" name="voornaam" value="<?= $data["row"]->Voornaam; ?>" required>
                <br>
                <input class="mb-2" type="text" name="tussenvoegsel" value="<?= $data["row"]->Tussenvoegsel; ?>" required>
                <br>
                <input class="mb-2" type="text" name="achternaam" value="<?= $data["row"]->Achternaam; ?>" required>
                <br>
                <input class="mb-2" type="date" name="geboortedatum" value="<?= $data["row"]->Geboortedatum; ?>" required>
                <br>
                <select name="typepersoon" id="type">
                    <option value="Manager" <?php if ($data['row']->TypePersoon == 'Manager') : ?> selected="selected" <?php endif ?>>Manager</option>
                    <option value="Medewerker" <?php if ($data['row']->TypePersoon == 'Medewerker') : ?> selected="selected" <?php endif ?>>Medewerker</option>
                    <option value="Vrijwilliger" <?php if ($data['row']->TypePersoon == 'Vrijwilliger') : ?> selected="selected" <?php endif ?>>Vrijwilliger</option>
                    <option value="Klant" <?php if ($data['row']->TypePersoon == 'Klant') : ?> selected="selected" <?php endif ?>>Klant</option>
                </select>
                <br>
                <select name="isvertegenwoordiger" id="type">
                    <option value='0' <?php if ($data['row']->IsVertegenwoordiger == '0') : ?> selected="selected" <?php endif ?>>Nee</option>
                    <option value='1' <?php if ($data['row']->IsVertegenwoordiger == '1') : ?> selected="selected" <?php endif ?>>Ja</option>
                </select>
                <br>
                <input class="mb-2" type="text" name="straat" value="<?= $data["row"]->Straat; ?>" required>
                <br>
                <input class="mb-2" type="number" name="huisnummer" value="<?= $data["row"]->Huisnummer; ?>" min="0" max="9999" required>
                <br>
                <input class="mb-2" type="text" name="toevoeging" value="<?= $data["row"]->Toevoeging; ?>" required>
                <br>
                <input class="mb-2" type="text" name="postcode" value="<?= $data["row"]->Postcode; ?>" required>
                <br>
                <input class="mb-2" type="text" name="woonplaats" value="<?= $data["row"]->Woonplaats; ?>" required>
                <br>
                <input class="mb-2" type="text" name="email" value="<?= $data["row"]->Email; ?>" required>
                <br>
                <input class="mb-2" type="text" name="mobiel" value="<?= $data["row"]->Mobiel; ?>" required>
                <br>
                <input class="mb-2" type="hidden" name="perId" value="<?= $data["row"]->PerId; ?>">
                <input class="mb-2" type="hidden" name="conId" value="<?= $data["row"]->ConId; ?>">
                <br>
                <input class="btn-outlined-green" type="submit" value="Wijzigen">


            </form>
        </table>
    </div>
</div>