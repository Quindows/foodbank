<?php require APPROOT . '/views/includes/navbar.php';?>
<div class="grid">
    <!-- Page Title -->
    <h3 class="col-12-lg"><?= $data['title'] ?></h3>

    <!-- Update Customer Form -->
    <form action="" method="POST">
        <label for="">FamilyName:</label>
        <input class="mb-2" type="text" name="FamilyName" value="<?= $data["row"]->FamilyName; ?>" required>
        <label for="">Address:</label>
        <input class="mb-2" type="text" name="Address" value="<?= $data["row"]->Address; ?>" required>
        <label for="">Email:</label>
        <input class="mb-2" type="text" name="Email" value="<?= $data["row"]->Email; ?>" required>
        <label for="">Phonenumber:</label>
        <input class="mb-2" type="text" name="Phonenumber" value="<?= $data["row"]->Phonenumber; ?>" required>
        <label for="">Amount of adults:</label>
        <input class="mb-2" type="text" name="AmountOfAdults" value="<?= $data["row"]->AmountOfAdults; ?>">
        <label for="">Amounts of kids:</label>
        <input class="mb-2" type="text" name="AmountOfKids" value="<?= $data["row"]->AmountOfKids; ?>">
        <label for="">Amount of babies:</label>
        <input class="mb-2" type="text" name="AmountOfBabies" value="<?= $data["row"]->AmountOfBabies; ?>">
        <label for="">Extra wish:</label>
        <input class="mb-2" type="text" name="ExtraWish" value="<?= $data["row"]->ExtraWish; ?>">

        <input class="mb-2" type="hidden" name="Id" value="<?= $data["row"]->Id; ?>">
        <br>
        <input type="Submit" value="Change">
    </form>
</div>