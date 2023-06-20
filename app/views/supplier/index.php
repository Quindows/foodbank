<?= require(APPROOT . '/views/includes/Navbar.php'); ?>
<div>
    <div class="supplierTitel">
        <form action="<?= URLROOT; ?>supplier/index" method="post">
        </form>
    </div>
    <table>
        <thead>
            <th>Company name</th>
            <th>Address</th>
            <th>Name contact person</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Next Delivery</th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>
</div>

<?php require(APPROOT . '/views/includes/Footer.php'); ?>