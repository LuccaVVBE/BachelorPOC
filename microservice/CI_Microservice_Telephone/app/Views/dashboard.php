<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bap dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <h5>Welcome, <?php $session = session(); echo $session->get('username'); ?></h5>
                        <a href="logout" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if(isset($telephone) && !empty($telephone)){ ?>
    <div class="container">
        <div class="row mt-4 justify-content-center">
        <?php foreach ($telephone as $key => $number){ ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Telephone Number: <?= $number->number; ?></div>
                    <div class="card-body">
                        <a href="usage?number=<?= $number->id; ?>" class="btn btn-primary">View Usage</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>