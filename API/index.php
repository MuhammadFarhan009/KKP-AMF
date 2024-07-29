<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Halaman semua data</title>
    <link href="./src/output.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: #4b5563;
            padding: 10px 20px;
            color: white;
            text-align: center;
        }

        nav h1 {
            margin: 0;
            font-size: 24px;
            color: white;
            font-weight: bold;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            background-color: white;
            margin: 20px auto; 
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            background-color: white;
        }

        th {
            background-color: #e5e7eb;
        }

        th.table-title {
            text-align: center; 
            color: #000; 
        }

        .table-title {
            font-weight: bold;
            font-size: 18px;
            color: black; 
        }

        .table-title a {
            color: black; 
            text-decoration: none;
        }

        .table-title a:hover {
            color: #1d4ed8;
        }

        .table-title a:active {
            color: #1d4ed8;
        }

        .table-subname {
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            text-align: center; 
            color: #000; 
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination a {
            color: black;
            text-decoration: none;
            margin: 0 5px;
            padding: 8px 16px;
            border: 1px solid #ddd;
            background-color: white;
            display: inline-block;
        }

        .pagination a:hover {
            background-color: #ddd;
        }

        .pagination span {
            padding: 8px 16px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <nav>
        <h1>Dataset BPS Aceh</h1>
    </nav>

    <?php
    $pages = isset($_GET["page"]) ? $_GET["page"] : 1;

    $url = "https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/1100/key/e437040ac2bc6886742a0bfab5a46355/page/$pages";

    $curl = curl_init(); // Initialize cURL
    curl_setopt($curl, CURLOPT_URL, $url); // Set URL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl); // Execute cURL
    curl_close($curl); // Close cURL

    $response = json_decode($response, TRUE);

    $page = $response["data"][0]["page"];
    $totalPage = $response["data"][0]["pages"];

    $count = count($response["data"][1]);
    $array = [];
    $subName = [];
    $varId = [];
    for ($i=0; $i < $count ; $i++) { 
        $title = $response["data"][1][$i]["title"];
        $sub = $response["data"][1][$i]["sub_name"];
        $varIds = $response["data"][1][$i]["var_id"];
        array_push($array, $title);
        array_push($subName, $sub);
        array_push($varId, $varIds);
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
    
    <div class="pagination">
        <?php
        if ($page > 1) {
            echo "<a href='?page=".($page-1)."'>Previous</a> ";
        }

        if ($totalPage <= 5) {
            for ($i = 1; $i <= $totalPage; $i++) {
                echo "<a href='?page=".$i."'>".$i."</a> ";
            }
        } else {
            if ($page > 3) {
                echo "<a href='?page=1'>1</a> ";
                echo "<span>...</span>";
            }

            for ($i = max(1, $page-2); $i <= min($totalPage, $page+2); $i++) {
                echo "<a href='?page=".$i."'>".$i."</a> ";
            }

            if ($page < $totalPage - 2) {
                echo "<span>...</span>";
                echo "<a href='?page=".$totalPage."'>".$totalPage."</a> ";
            }
        }

        if ($page < $totalPage) {
            echo "<a href='?page=".($page+1)."'>Next</a>";
        }
        ?>
    </div>
</body>
</html>
