<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <!-- Page Title -->
    <h3 class="col-12-lg"><?= $data['title'] ?></h3>

    <!-- Add Customer Form -->
    <form action="" method="POST">
        <label for="">FamilyName:</label>
        <input class="mb-2" type="text" name="FamilyName" placeholder="Enter your FamilyName" required>
        <label for="">Address:</label>
        <input class="mb-2" type="text" name="Address" placeholder="Enter your address" required>
        <label for="">Email:</label>
        <input class="mb-2" type="email" name="Email" placeholder="Enter your email" required>
        <label for="">Phonenumber:</label>
        <input class="mb-2" type="text" name="Phonenumber" placeholder="Enter your phonenumber" required>
        <label for="">Amount of adults:</label>
        <input class="mb-2" type="number" name="AmountOfAdults" placeholder="Enter the amount of adults in you family" required>
        <label for="">Amounts of kids:</label>
        <input class="mb-2" type="number" name="AmountOfKids" placeholder="Enter the amount of kids in you family" required>
        <label for="">Amount of babies:</label>
        <input class="mb-2" type="number" name="AmountOfBabies" placeholder="Enter the amount of babies in you family" required>
        <label for="">Extra wish:</label>
        <input class="mb-2" type="text" name="ExtraWish" placeholder="Enter some Extra Wishes">
        <br>
        <input class="btn-outlined-green" type="submit" value="Add Customer" placeholder>
    </form>
    <pclass="col-12-lg"><?= $data['notification'] ?></p>
</div>