<?= require(APPROOT . '/views/includes/Navbar.php'); ?>

<body>
    <div class="grid">
        <div class="container fd-c col-12-lg ai-fs">
            <form action="" method="post">
                <table>

                    <tbody>
                        <tr>
                            <td>
                                <label for="companyName">Company name: </label>
                                <input type="text" name="companyName" id="companyName" placeholder="Company name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="address">Address: </label>
                                <input type="text" name="address" id="address" placeholder="Address" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="contactName">Name contact person: </label>
                                <input type="text" name="contactName" id="contactName" placeholder="Contact name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email: </label>
                                <input type="text" name="email" id="email" placeholder="Email" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phoneNumber">Phone number: </label>
                                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone number" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="<?= $data['row']->id; ?>">
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