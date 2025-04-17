
<?php

	include_once('config.php');


	$sql = "SELECT * FROM races";
	$selectraces = $pdo->prepare($sql);
	$selectraces->execute();
	$races_data = $selectraces->fetchAll();

	include_once 'header.php';

	$query = $pdo->query("SELECT * FROM races ORDER BY race_date ASC");
    $races = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>F1 Races</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

    .table-dark th,
    .table-dark td {
      vertical-align: middle;
    }
	.modal-header,
    .modal-title,
    .modal-body {
    color: black !important;
}


body {
            background-color: #1a1a40;
            margin: 0;
        }

        .leader {
          background-color: white;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-radius: 6px 6px 0 0;
        }
        .leader .pos {
            font-weight: bold;
            margin-right: 10px;
        }
        .leader .name {
            flex: 1;
        }
        .leader .team {
            opacity: 0.7;
        }
        .leader .points {
          background:rgb(6, 6, 6);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
        }
        .leader:hover{
          background-color:rgb(214, 128, 35);
        }
        .driver {
            background-color: white;
            color:black;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }
        .driver:last-child {
            border-radius: 0 0 6px 6px;
            margin-bottom: 50px;
        }
        .driver .pos {
            font-weight: bold;
            margin-right: 10px;
        }
        .driver .name {
            flex: 1;
        }
        .driver .team {
            opacity: 0.7;
        }
        .driver .points {
            background:rgb(6, 6, 6);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
        }
        .driver:hover{
          background-color:rgb(38, 77, 218);
        }
       

  </style>
</head>
<body>

<section class="py-5" style="background: linear-gradient(to bottom, #0d0d2b, #1a1a40); color: white;">
  <div class="container text-center">
    <h1 class="mb-5 fw-bold display-5">🏁 Driver Standings</h1>
    <div class="row justify-content-center align-items-end">
      
      <?php
        $drivers = [
          [
            'rank' => 1,
            'name' => 'Lando NORRIS',
            'country' => 'UK',
            'flag' => 'uk.png',
            'team' => 'McLaren',
            'team_logo' => 'mclaren_logo.png',
            'team_color' => '#FF8000',
            'points' => 62,
            'img' => 'lando.png',
          ],
          [
            'rank' => 2,
            'name' => 'Max VERSTAPPEN',
            'country' => 'Netherlands',
            'flag' => 'netherlands.png',
            'team' => 'Red Bull Racing',
            'team_logo' => 'redbull_logo.png',
            'team_color' => '#005AFF',
            'points' => 61,
            'img' => 'max.png',
          ],
          [
            'rank' => 3,
            'name' => 'Oscar PIASTRI',
            'country' => 'Australia',
            'flag' => 'australia.png',
            'team' => 'McLaren',
            'team_logo' => 'mclaren_logo.png',
            'team_color' => '#FF8000',
            'points' => 49,
            'img' => 'oscar.png',
          ]
        ];
      ?>

      <?php foreach ($drivers as $driver): ?>
        <div class="col-md-4 mb-4">
          <div class="card border-0 bg-transparent text-white shadow-lg" style="transition: transform 0.3s;">
          <img src="images/<?= $driver['img'] ?>" class="img-fluid rounded-top" alt="<?= $driver['name'] ?>">
            <div class="p-3" style="background-color: <?= $driver['team_color'] ?>; border-radius: 0 0 0.5rem 0.5rem;">
              <div class="d-flex align-items-center justify-content-between">
                <div class="text-start">
                  <h5 class="mb-1">
                    <img src="images/<?= $driver['flag'] ?>" width="24" class="me-1" alt="<?= $driver['country'] ?>">
                    <?= $driver['name'] ?>
                  </h5>
                  <small><?= $driver['team'] ?></small>
                </div>
                <div class="text-end">
                  <img src="images/<?=$driver['team_logo'] ?>" width="36" alt="team">
                  <div><strong><?= $driver['points'] ?> PTS</strong></div>
                  <span class="badge bg-dark">#<?= $driver['rank'] ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>
<div class="container">
    <?php
    $drivers = [
        ["position" => 1, "name" => "Lando NORRIS", "team" => "McLaren", "points" => 62],
        ["position" => 2, "name" => "Max VERSTAPPEN", "team" => "Red Bull Racing", "points" => 61],
        ["position" => 3, "name" => "Oscar PIASTRI", "team" => "McLaren", "points" => 49],
        ["position" => 4, "name" => "George RUSSELL", "team" => "Mercedes", "points" => 45],
        ["position" => 5, "name" => "Kimi ANTONELLI", "team" => "Mercedes", "points" => 30],
        ["position" => 6, "name" => "Charles LECLERC", "team" => "Ferrari", "points" => 20],
    ];

    foreach ($drivers as $index => $driver) {
        $class = $index === 0 ? 'leader' : 'driver';
        echo "<div class='$class'>";
        echo "<div class='pos'>{$driver['position']}</div>";
        echo "<div class='name'>{$driver['name']} <span class='team'>{$driver['team']}</span></div>";
        echo "<div class='points'>{$driver['points']} PTS</div>";
        echo "</div>";
    }
    ?>
</div>


<div class="row row-cols-1 row-cols-md-3 g-4">
  <?php foreach ($races as $race): ?>
    <div class="col">
      <div class="card h-100 shadow-sm">
        <!-- Placeholder image for track - Replace with actual track image if available -->
        <img src="images/<?= $race['track_image'] ?? 'placeholder.png'; ?>" class="card-img-top" alt="<?= htmlspecialchars($race['track']) ?>" style="height: 200px; object-fit: cover;">
        
        <div class="card-body">
          <h5 class="card-title">Round <?= htmlspecialchars($race['round_number']) ?>: <?= htmlspecialchars($race['country']) ?></h5>
          <p class="card-text mb-1"><strong>City:</strong> <?= htmlspecialchars($race['city']) ?></p>
          <p class="card-text mb-1"><strong>Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($race['race_date']))) ?></p>
          <p class="card-text mb-2"><strong>Track:</strong> <?= htmlspecialchars($race['track']) ?></p>
          
          <div class="d-flex justify-content-between">
  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?= $race['id'] ?>">View</button>
  <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#reserveModal<?= $race['id'] ?>">Reserve</button>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal<?= $race['id'] ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $race['id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel<?= $race['id'] ?>">Race Info: <?= $race['country'] ?> - <?= $race['track'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Round:</strong> <?= $race['round_number'] ?></p>
        <p><strong>City:</strong> <?= $race['city'] ?></p>
        <p><strong>Date:</strong> <?= $race['race_date'] ?></p>
        <p><strong>Track:</strong> <?= $race['track'] ?></p>
      </div>
    </div>
  </div>
</div>

<!-- Reserve Modal -->
<div class="modal fade" id="reserveModal<?= $race['id'] ?>" tabindex="-1" aria-labelledby="reserveModalLabel<?= $race['id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="reserve.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="reserveModalLabel<?= $race['id'] ?>">Reserve Ticket - <?= $race['country'] ?> (<?= $race['race_date'] ?>)</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="race_id" value="<?= $race['id'] ?>">
          <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label for="seats" class="form-label">Seats</label>
            <input type="number" class="form-control" name="seats" required min="1">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Confirm Reservation</button>
        </div>
      </form>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php
 include_once 'footer.php';
?>
