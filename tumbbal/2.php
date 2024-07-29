<?php
$response = [
    "labelvervar" => "Main Label",
    "var" => [
        ["label" => "Variable Label"]
    ],
    "tahun" => [
        ["label" => "Year 1"],
        ["label" => "Year 2"],
        ["label" => "Year 3"]
    ],
    "turtahun" => [
        ["label" => "Sub-Year 1"],
        ["label" => "Sub-Year 2"]
    ]
];

$jumlahtahun = count($response["tahun"]);
$jumlahturtahun = count($response["turtahun"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complex Table</title>
</head>
<body>
    <table border="1">
        <tr>
            <th rowspan="4"><?php echo $response["labelvervar"]; ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo $jumlahtahun * $jumlahturtahun; ?>"><?php echo $response["var"][0]["label"]; ?></th>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < $jumlahtahun; $i++) {
                echo "<th colspan='" . $jumlahturtahun . "'>" . $response["tahun"][$i]["label"] . "</th>";
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < $jumlahtahun; $i++) {
                for ($j = 0; $j < $jumlahturtahun; $j++) {
                    echo "<th>" . $response["turtahun"][$j]["label"] . "</th>";
                }
            }
            ?>
        </tr>
    </table>
</body>
</html>
