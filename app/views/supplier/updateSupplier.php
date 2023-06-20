<?= require(APPROOT . '/views/includes/Navbar.php');
var_dump($data) ?>

<body>
    <div class="grid">
        <div class="container fd-c col-12-lg ai-fs">
            <form action="" method="post">
                <table>


                    <tbody>
                        <tr>
                            <td>
                                <label for="companyName">Company name: </label>
                                <input type="text" name="companyName" id="companyName" placeholder="<?= $data['row']->CompanyName; ?>" value="<?= $data['row']->CompanyName; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="address">Address: </label>
                                <input type="text" name="address" id="address" placeholder="<?= $data['row']->Address; ?>" value="<?= $data['row']->Address; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="contactName">Name contact person: </label>
                                <input type="text" name="contactName" id="contactName" placeholder="<?= $data['row']->Name; ?>" value="<?= $data['row']->Name; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email: </label>
                                <input type="text" name="email" id="email" placeholder="<?= $data['row']->Email; ?>" value="<?= $data['row']->Email; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phoneNumber">Phone number: </label>
                                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="<?= $data['row']->Phonenumber; ?>" value="<?= $data['row']->Phonenumber; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="<?= $data['row']->Id; ?>">
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