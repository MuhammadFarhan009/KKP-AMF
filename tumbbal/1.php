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
    ]
];

$jumlahtahun = count($response["tahun"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Table</title>
</head>
<body>
    <table border="1">
        <tr>
            <th rowspan="3"><?php echo $response["labelvervar"]; ?></th>
        </tr>
        <tr>
            <th colspan="<?php echo $jumlahtahun; ?>"><?php echo $response["var"][0]["label"]; ?></th>
        </tr>
        <tr>
            <?php
            for ($i = 0; $i < $jumlahtahun; $i++) {
                echo "<th>" . $response["tahun"][$i]["label"] . "</th>";
            }
            ?>
        </tr>
    </table>
</body>
</html>
