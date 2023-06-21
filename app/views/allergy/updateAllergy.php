<!-- Navbar -->
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<div class="grid">
    <div class="container fd-c col-12-lg ai-fs">

        <!-- Score Form-->
        <form action="" method="POST">
            <input class="mb-2" type="text" name="name" value="<?= $data["row"]->Name; ?>" required>
            <br>
            <input class="mb-2" type="hidden" name="id" value="<?= $data["row"]->Id; ?>">
            <br>
            <input class="btn-outlined-green" type="submit" value="Change">
        </form>
    </div>
</div>