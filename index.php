<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include "upload.php";

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body class="bg-light">

    <div class="container" style="padding-top:10px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-outline-secondary">
                    <div class="card-body">
                        <h3 class="text-center">Form Upload</h3>
                        <hr />

                        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ownerPassword">Owner Password</label>
                                    <input type="password" class="form-control" name="ownerPassword" id="ownerPassword" required>
                                    <small class="form-text text-danger" id="message"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="userPassword">User Password</label>
                                    <input type="password" class="form-control" name="userPassword" id="userPassword" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="fileToUpload">File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" required>
                                    <label class="custom-file-label" for="fileToUpload">Choose file</label>
                                </div>
                                <small class="form-text text-muted">Only support PDF file</small>
                            </div>

                            <button type="submit" class="btn btn-primary float-right" name="submit">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="padding-top:10px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-outline-secondary">
                    <div class="card-body">
                        <h5>Side Note</h5>
                        <hr />
                        <p>
                            <ol>
                                <li>Install PDFtk Server <a href="https://www.pdflabs.com/tools/pdftk-the-pdf-toolkit/pdftk_server-2.02-win-setup.exe">here</a></li>
                                <li>Add pdftk to Path Environment Variables</li>
                                <li>Restart your computer</li>
                            </ol>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>


    <script>
        // Check owner & user password match
        $('#ownerPassword, #userPassword').on('keyup', function() {
            if ($('#ownerPassword').val() == $('#userPassword').val()) {
                $('#message').html('Please cannot be the same');
            } else {
                $('#message').empty();
            }
        });

        // Add filename to input box
        $('#fileToUpload').on('change', function() {
            // get the file name
            var fileInput = document.getElementById('fileToUpload');
            var fileName = fileInput.files[0].name;
            // replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
</body>

</html>