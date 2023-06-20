<?php require APPROOT . '/views/includes/navbar.php' ?>
<div class="grid">
    
    <div class="ai-c col-12-lg">
        <!-- Page Title -->
        <h3><?= $data['title'] ?></h3>
        
            <!-- Customer Table -->
            <table class="table table-striped">
                <thead>
                    <th>FamilyName</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phonenumber</th>
                    <th>AmountOfAdults</th>
                    <th>AmountOfKids</th>
                    <th>AmountOfBabies</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?= $data['rows'] ?>
                </tbody>
            </table>
        </div>
        <br>
        <!-- Button to create form -->
        <div class="col-12-lg">
            <a class="btn-grey" href="/customer/addCustomer">Add Customer</a>
        </div>
</div>