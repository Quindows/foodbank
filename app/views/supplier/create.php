<?= require(APPROOT . '/views/includes/Navbar.php'); ?>

<body>
    <div class="grid">
        <div class="container fd-c col-12-lg ai-fs">
            <form action="<?= URLROOT; ?>/order/addOrder" method="post">
                <table>

                    <tbody>
                        <tr>
                            <td>
                                <label for="name">Naam: </label>
                                <input type="text" name="name" id="name" placeholder="Naam" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="productDescription">Product Beschrijving</label>
                                <input type="text" name="productDescription" id="productDescription" placeholder="Beschrijving" required>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Verzenden"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</body>