<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работа</title>
</head>
<body>
<?php foreach ($data as $countryData): ?>
    <div class="country" data-description="<?= htmlspecialchars($countryData['country']['description']) ?>">
        <?= htmlspecialchars($countryData['country']['name']) ?>
    </div>
    <?php foreach ($countryData['citiesWithoutRegion'] as $city): ?>
        <div class="city" style="margin-left: 20px;" data-description="<?= htmlspecialchars($city['description']) ?>">
            <?= htmlspecialchars($city['name']) ?>
        </div>
    <?php endforeach; ?>
    <?php foreach ($countryData['regions'] as $regionData): ?>
        <div class="region" style="margin-left: 20px;" data-description="<?= htmlspecialchars($regionData['region']['description']) ?>">
            <?= htmlspecialchars($regionData['region']['name']) ?>
        </div>
        <?php foreach ($regionData['cities'] as $city): ?>
            <div class="city" style="margin-left: 40px;" data-description="<?= htmlspecialchars($city['description']) ?>">
                <?= htmlspecialchars($city['name']) ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

</body>
</html>

<script src="../../public/js/city.js"></script>
