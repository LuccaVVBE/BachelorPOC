<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Bap telephone number usage</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Time Called</h5>
                        <p class="card-text">Total time called: <?php if($totalMinutes > 60){
                            echo round($totalMinutes/60, 2).' hours';
                        } else {
                            echo $totalMinutes.' minutes';
                        
                        } ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Messages</h5>
                        <p class="card-text">Total messages: <?= $totalMessages?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Used</h5>
                        <p class="card-text">Total data used: <?php if($totalData>1024){
                            echo round($totalData/1024, 2).' GB';
                        } else {
                            echo $totalData.' MB';
                        } ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Call Log</h3>
                <p>Call logs found: <?= count($callLogs); ?></p>
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Duration/Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($callLogs as $key => $callLog): ?>
                                <tr>
                                    <td><?= $callLog['call_date']; ?></td>
                                    <td><?= $callLog['from_number']; ?></td>
                                    <td><?= $callLog['to_number']; ?></td>
                                    <td><?= $callLog['duration']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>