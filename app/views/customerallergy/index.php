<!-- Navbar -->
<?php require APPROOT . '/views/includes/navbar.php' ?>

<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">


        <!-- Score Table -->
        <h3 class="text-align-center col-12-lg">Overview allergies</h3>
        <table class="table table-striped">
            <tbody>
                <?= $data['rows'] ?>
            </tbody>
        </table>
        <br>
    </div>
</div>