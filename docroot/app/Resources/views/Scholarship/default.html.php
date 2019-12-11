<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pendaftaran CSR</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="css/font-awesome/all.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/pendaftaran-csr.css">
    </head>
    
    <body>
        <section id="stepper-csr-1">
            <h1 class="mb-5">Form Pendaftaran CSR</h1>
            <?php require_once('include/step-1.php')?>
        </section>

        <section id="stepper-csr-2" class="hide">
            <h1 class="mb-5">Form Pendaftaran CSR</h1>
            <?php require_once('include/step-2.php')?>
        </section>

        <section id="stepper-csr-3" class="hide">
            <h1 class="mb-5">Form Pendaftaran CSR</h1>
            <?php require_once('include/step-3.php')?>
        </section>
        
        <section id="stepper-csr-4" class="hide">
            <h1 class="mb-5">Form Pendaftaran CSR</h1>
            <?php require_once('include/step-4.php')?>
        </section>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

        <script src="js/pendaftaranCSR.js"></script>
        <script src="js/formStep1.js"></script>
        <script src="js/formStep2.js"></script>
        <script src="js/formStep3.js"></script>
        <script src="js/formStep4.js"></script>
    </body>
</html>