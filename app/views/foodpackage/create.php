<?= require(APPROOT . '/views/includes/Navbar.php');?>

<div >
    <h1>Create foodpackage</h1>

    <p></p>
    <form action="<?= URLROOT; ?>foodpackage/create"  method="post" id="CreateForm">
    <p><?= $data['notification'] ?></p>
        <label for="Family">Choose a lastname:</label>
        <select id="Family" name="Family">
            <option value=1>Bruijn</option>
            <option value=2>Tas</option>
            <option value=3>Blume</option>
            <option value=4>Nijholt</option>
            <option value=5>Lee</option>
        </select>

        <label for="Allergy">Choose a allergy:</label>
        <select name="Allergy" id="Allergy">
            <option value=1>Gluten</option>
            <option value=2>Peanut</option>
            <option value=3>Shellfish</option>
            <option value=4>Hazelnuts</option>
            <option value=5>Lactose</option>
        </select>

        <label for="Product">Choose a product:</label>
        <select name="Product" id="Product">
            <option value=1>Cheese toast</option>
            <option value=2>Apple</option>
            <option value=3>Cereal</option>
            <option value=4>Meat stew</option>
            <option value=5>Spaghetti</option>
            <option value=6>Roasted eggplant</option>
            <option value=7>Drum sticks</option>
            <option value=8>Rissoto</option>
            <option value=9>Lasagne</option>

        </select>

        <button type="submit" class="btn btn-warning w-100 p-3 mt-5">Create</button>
    </form>

</div>



<?php require(APPROOT . '/views/includes/Footer.php');?>