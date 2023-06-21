<link rel="stylesheet" href="../../../public/css/style.css">
<div class="grid pt-4">
    <div class="container fd-c col-12-lg ai-fs">
        <div class="grid-item ac-fs display-f">
            <h2 class="text-green" style="text-decoration: underline;">Overzicht gezinnen met voedselpakketten</h2>

        </div>


        <table class="table table-striped">
            <thead>
                <th>Pakketnummer</th>
                <th>Datum samenstelling</th>
                <th>Datum uitgifte</th>
                <th>Status</th>
                <th>Aantal Producten</th>
                <th>Wijzig Status</th>
            </thead>
            <tbody>
                <?= $data['rows']; ?>
            </tbody>
        </table>
        <a class="btn-blue" href="../index" style="margin-left: 64rem;">Terug</a>
        <a class="btn-blue" href="/landingspages/index" style="margin-left: 64rem;">Home</a>


    </div>
</div>

<!-- <?= var_dump($data); ?> -->
<?php require(APPROOT . '/views/includes/Footer.php'); ?>