<?= require(APPROOT . '/views/includes/Navbar.php');?>
<div class="grid">
    <h1 class="text-align-center col-12-lg">sdasd</h1>
        
        <table class="table table-striped">
            <thead>
                <th>Family name</th>
                <th>Content</th>
                <th>allergy</th>
                <th>extras</th>
                <th>edit</th>
                <th>delete</th>
            </thead>
            <tbody>
                <?= $data['rows']; ?>
            </tbody>
        </table>
        <a class='btn-outlined-primary' href="/foodpackage/create">Create</a>
</div>

<?php require(APPROOT . '/views/includes/Footer.php');?>