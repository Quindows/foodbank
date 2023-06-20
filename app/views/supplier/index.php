<?= require(APPROOT . '/views/includes/Navbar.php'); ?>
<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">
        <table class="table table-striped">
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
            <a class="btn-grey" href="../supplier/createSupplier">Add supplier</a>
        </table>
    </div>
</div>

<?php require(APPROOT . '/views/includes/Footer.php'); ?>