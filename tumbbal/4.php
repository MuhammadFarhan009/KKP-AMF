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
    ],
    "turvar" => [
        ["label" => "Characteristic 1"],
        ["label" => "Characteristic 2"]
    ]
];

$jumlahkarakteristik = count($response["turvar"]);
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
            <th rowspan="5"><?php echo $response["labelvervar"]; ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo $jumlahkarakteristik * $jumlahtahun * $jumlahturtahun; ?>">
                <?php echo $response["var"][0]["label"]; ?>
            </th>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < $jumlahkarakteristik; $i++) {
                echo "<th colspan='" . $jumlahtahun * $jumlahturtahun . "'>" . $response["turvar"][$i]["label"] . "</th>";
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < $jumlahkarakteristik; $i++) {
                for ($j = 0; $j < $jumlahtahun; $j++) {
                    echo "<th colspan='" . $jumlahturtahun . "'>" . $response["tahun"][$j]["label"] . "</th>";
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < $jumlahkarakteristik; $i++) {
                for ($j = 0; $j < $jumlahtahun; $j++) {
                    for ($k = 0; $k < $jumlahturtahun; $k++) {
                        echo "<th>" . $response["turtahun"][$k]["label"] . "</th>";
                    }
                }
            }
            ?>
        </tr>
    </table>
</body>
</html>
