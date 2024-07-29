<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Halaman semua data</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .table-title {
            font-weight: bold;
            font-size: 18px;
        }

        .table-subname {
            font-weight: bold;
            font-size: 18px;
            text-align: right;
        }

        .table-link {
            color: blue;
            text-decoration: underline;
        }
    </style>
    <link href="./src/output.css" rel="stylesheet">

</head>
<body>
    <?php

    $pages = isset($_GET["page"]) ? $_GET["page"] : 1;

    $url = "https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/1100/key/e437040ac2bc6886742a0bfab5a46355/page/$pages";


    $curl = curl_init(); // Initialize cURL
    curl_setopt($curl, CURLOPT_URL, $url); // Set URL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl); // Execute cURL
    curl_close($curl); // Close cURL

    $response = json_decode($response, TRUE);

    // echo count($response["data"][1])

    $page = $response["data"][0]["page"];
    $totalPage = $response["data"][0]["pages"];

    // echo "$page $totalPage";
    
    $count = count($response["data"][1]);
    $array = [];
    $subName = [];
    $varId = [];
    for ($i=0; $i < $count ; $i++) { 
        $title = $response["data"][1][$i]["title"];
        $sub = $response["data"][1][$i]["sub_name"];
        $varIds = $response["data"][1][$i]["var_id"];
        array_push($array, $title );
        array_push($subName, $sub);
        array_push($varId, $varIds);
        // array_push());
    }


    ?>
<table border="1">
    <thead>
        <tr>
            <th class="table-title">Judul Tabel</th>
            <th class="table-subname">Sub Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array as $index => $tumbalItem): ?>
            <tr>
                <td class="table-title"> 
                    <a href="test.php?variable=<?php echo urlencode($varId[$index]); ?>" class="table-link"><?php echo $tumbalItem; ?></a>
                </td>
                <td class="table-subname">
                    <?php if (isset($subName[$index])): ?>
                        <?php echo $subName[$index]; ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>




<?php
$totalPage = $response["data"][0]["pages"];
for ($i=1; $i < $totalPage ; $i++) { 
    echo "<a href='?page=".$i."'>[".$i."]</a>";
}
?>


    
</body>
</html>