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
                <select name="type" id="type">
                    <option value="Manager">Manager</option>
                    <option value="Medewerker">Medewerker</option>
                    <option value="Vrijwilliger">Vrijwilliger</option>
                    <option value="Klant">Klant</option>
                </select>
                <br>
                <select name="type" id="type">
                    <option value="0">Nee</option>
                    <option value="1">Ja</option>
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
                <input class="mb-2" type="hidden" name="id" value="<?= $data["row"]->GezId; ?>">
                <input class="mb-2" type="hidden" name="id" value="<?= $data["row"]->ConId; ?>">
                <input class="mb-2" type="hidden" name="id" value="<?= $data["row"]->CpgId; ?>">
                <input class="mb-2" type="hidden" name="id" value="<?= $data["row"]->CpgGezId; ?>">
                <input class="mb-2" type="hidden" name="id" value="<?= $data["row"]->CpgConId; ?>">
                <br>
                <input class="btn-outlined-green" type="submit" value="Wijzigen">


            </form>
            </table>
    </div>
</div>