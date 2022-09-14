<html>

<?php
    include("header.php");
?>

<body>
    <!-- navbar -->
    <?php include("navbar.php"); ?>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-6 rounded-2 bg-dark shadow p-5">
                <h3 class="mb-5 text-bg-dark">Please fill the form:</h3>
                <form action="addCustomer.php" method="POST">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="FirstName" class="form-label text-bg-dark">First Name</label>
                            <input type="text" class="form-control" name="FirstName" id="FirstName">
                        </div>
                        <div class="mb-3">
                            <label for="LastName" class="form-label text-bg-dark">Last Name</label>
                            <input type="text" class="form-control" name="LastName" id="LastName">
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label text-bg-dark">Email</label>
                            <input type="email" class="form-control" name="Email" id="Email">
                        </div>
                        <div class="mb-3">
                            <label for="Phone" class="form-label text-bg-dark">Phone number</label>
                            <input type="number" class="form-control" name="Phone" id="Phone">
                        </div>
                        <div class="mb-3">
                            <label for="Comments" class="form-label text-bg-dark">Comments</label>
                            <input type="text" class="form-control" name="Comments" id="Comments">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label text-bg-dark">Photo</label>
                            <input class="form-control" type="file" name="Photo" id="Photo"> 
                        
                        <!-- <img src="photos/<?= $photopath ?>"> -->

                        </div>
                        <button class="btn btn-light mt-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>