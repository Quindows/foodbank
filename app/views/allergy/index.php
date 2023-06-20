<?= require(APPROOT . '/views/includes/Navbar.php'); ?>

<table>
    <thead>
        <th>Name</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>
</div>

<?php require(APPROOT . '/views/includes/Footer.php'); ?>