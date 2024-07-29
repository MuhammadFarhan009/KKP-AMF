<!DOCTYPE html>
<html>
<head>
  <title>Fill Table with PHP</title>
</head>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
<body>

<?php
// Find API URL
$url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/422/key/e437040ac2bc6886742a0bfab5a46355/';

$curl = curl_init();  // Initialize cURL
curl_setopt($curl, CURLOPT_URL, $url);  // Set URL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($curl);  // Execute cURL
curl_close($curl);  // Close cURL

$response = json_decode($response, TRUE);
$jumlahBaris = count($response['turvar']) * count($response['vervar']) * count($response['tahun']) * count($response['turtahun']);
$jumlahTurvar = count($response['turvar']);
$jumlahVervar = count($response['vervar']);
$jumlahTahun = count($response['tahun']);
$jumlahTurTahun = count($response['turtahun']);

// Initialize the main array to hold data
$dataArray = array();

for ($i = 0; $i < $jumlahVervar; $i++) {
    for ($j = 0; $j < $jumlahTahun; $j++) {
        for ($k = 0; $k < $jumlahTurTahun; $k++) {
            for ($l=0; $l < $jumlahTurvar; $l++) { 
                # code...
                // Create an associative array for the current entry
                $id_data = $response["vervar"][$i]["val"] .
                           $response["var"][0]["val"] .
                           $response['turvar'][$l]['val'] .
                           $response['tahun'][$j]['val'] .
                           $response['turtahun'][$k]['val'];

                //Push Data to Array    
                $dataEntry = array(
                'namaDaerah' => $response['vervar'][$i]['label'], //Looping to to find Nama 
                'tahun' => $response['tahun'][$j]['label'], 
                'bulan' => $response['turtahun'][$k]['label'], 
                'turvar' => $response["turvar"][$l]["label"],
                'nilai' => isset($response["datacontent"][$id_data]) ?
                $response["datacontent"][$id_data] : "-"

            );

            // Add the entry to the main array
            $dataArray[] = $dataEntry;
            }
            
        }
    }
}

// Print the resulting array
// print_r($dataArray);
?>



<h2>Data Table</h2>

<table>
    <thead>
        <tr>
            <th>Nama Daerah</th>
            <th>Tahun</th>
            <th>Bulan</th>
            <th>Turvar</th>
            <th>nilai</th>
        </tr>
    </thead>
    <tbody>
        <!-- Looping to retrive data in Array -->
        <?php foreach ($dataArray as $dataEntry): ?>
            <tr>
                <td><?php echo ($dataEntry['namaDaerah']); ?></td>
                <td><?php echo htmlspecialchars($dataEntry['tahun']); ?></td>
                <td><?php echo htmlspecialchars($dataEntry['bulan']); ?></td>
                <td><?php echo htmlspecialchars($dataEntry['turvar']); ?></td>
                <td><?php echo htmlspecialchars($dataEntry['nilai']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
