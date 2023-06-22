<link rel="stylesheet" href="../../../public/css/style.css">
<div class="grid pt-4">
    <div class="container fd-c col-12-lg ai-fs">
        <div class="grid-item ac-fs display-f">
            <h2 class="text-green" style="text-decoration: underline;">Wijzig voedselpakket status</h2>
        </div>

        <form action="<?= URLROOT; ?>/voedselpakket/wijzigStatus" method="post" style="margin-left : 20rem;">
            <select id="status" name="status" style="margin-right: 1rem;">
                <option value="NietUitgereikt" <?php if ($data['status'] == "NietUitgereikt") : ?> selected="selected" <?php endif ?>>Niet Uitgereikt</option>
                <option value="Uitgereikt" <?php if ($data['status'] == "Uitgereikt") : ?> selected="selected" <?php endif ?>>Uitgereikt</option>
            </select>
            <input class="mb-2" type="hidden" name="id" value="<?= $data['id']; ?>">
            <input type="submit" class="text-white btn-grey" value="Wijzig status voedselpakket">
        </form>


        <a class="btn-blue" href="../index" style="margin-left: 64rem;">Terug</a>
        <a class="btn-blue" href="/landingspages/index" style="margin-left: 64rem;">Home</a>


    </div>
</div>
<?= var_dump($data); ?>
<?php require(APPROOT . '/views/includes/Footer.php'); ?>