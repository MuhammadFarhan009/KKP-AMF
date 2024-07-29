<?php

if (isset($_GET['variable'])) {
    $variable = $_GET['variable'];
    $api_url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/$variable/key/e437040ac2bc6886742a0bfab5a46355/";
    // $url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/$variable/key/e437040ac2bc6886742a0bfab5a46355/";
    // echo $variable; // Outputs: Hello, World!
}


$response = file_get_contents($api_url);
$data = json_decode($response, true);

$idvariabel = $data["var"][0]["val"];
$jumlahbaris = count($data["vervar"]);
$jumlahkarakteristik = count($data["turvar"]);
$jumlahtahun = count($data["tahun"]);
$jumlahturtahun = count($data["turtahun"]);

if( isset($_GET['title'])){
    $title = $_GET['title'];
    $filename = $title . ".csv";
    header('Content-Type: text/csv');
    
    header('Content-Disposition: attachment;filename="' . $filename . '"');
}
    

$output = fopen('php://output', 'w');
if (isset($_GET['variable'])) {
    $variable = $_GET['variable'];
    $url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/$variable/key/e437040ac2bc6886742a0bfab5a46355/";
    // echo $variable; // Outputs: Hello, World!
}

// Generate the header rows
if ($jumlahturtahun == 1 && $jumlahkarakteristik == 1) {
    fputcsv($output, [$data["labelvervar"]]);
    fputcsv($output, [$data["var"][0]["label"]]);
    $header = [];
    foreach ($data["tahun"] as $tahun) {
        $header[] = $tahun["label"];
    }
    fputcsv($output, $header);
} else if ($jumlahturtahun > 1 && $jumlahkarakteristik == 1) {
    fputcsv($output, [$data["labelvervar"]]);
    fputcsv($output, [$data["var"][0]["label"]]);
    $header1 = [];
    foreach ($data["tahun"] as $tahun) {
        $header1[] = $tahun["label"];
    }
    fputcsv($output, $header1);
    $header2 = [];
    foreach ($data["tahun"] as $tahun) {
        foreach ($data["turtahun"] as $turtahun) {
            $header2[] = $turtahun["label"];
        }
    }
    fputcsv($output, $header2);
} else if ($jumlahturtahun == 1 && $jumlahkarakteristik > 1) {
    fputcsv($output, [$data["labelvervar"]]);
    fputcsv($output, [$data["var"][0]["label"]]);
    $header1 = [];
    foreach ($data["turvar"] as $turvar) {
        $header1[] = $turvar["label"];
    }
    fputcsv($output, $header1);
    $header2 = [];
    foreach ($data["turvar"] as $turvar) {
        foreach ($data["tahun"] as $tahun) {
            $header2[] = $tahun["label"];
        }
    }
    fputcsv($output, $header2);
} else if ($jumlahturtahun > 1 && $jumlahkarakteristik > 1) {
    fputcsv($output, [$data["labelvervar"]]);
    fputcsv($output, [$data["var"][0]["label"]]);
    $header1 = [];
    foreach ($data["turvar"] as $turvar) {
        $header1[] = $turvar["label"];
    }
    fputcsv($output, $header1);
    $header2 = [];
    foreach ($data["turvar"] as $turvar) {
        foreach ($data["tahun"] as $tahun) {
            $header2[] = $tahun["label"];
        }
    }
    fputcsv($output, $header2);
    $header3 = [];
    foreach ($data["turvar"] as $turvar) {
        foreach ($data["tahun"] as $tahun) {
            foreach ($data["turtahun"] as $turtahun) {
                $header3[] = $turtahun["label"];
            }
        }
    }
    fputcsv($output, $header3);
}

// Generate the data rows
for ($i = 0; $i < $jumlahbaris; $i++) {
    $row = [$data["vervar"][$i]["label"]];
    for ($j = 0; $j < $jumlahkarakteristik; $j++) {
        for ($k = 0; $k < $jumlahtahun; $k++) {
            for ($l = 0; $l < $jumlahturtahun; $l++) {
                $id_data = $data["vervar"][$i]["val"] .
                           $idvariabel .
                           $data["turvar"][$j]["val"] .
                           $data["tahun"][$k]["val"] .
                           $data["turtahun"][$l]["val"];
                $data_value = isset($data["datacontent"][$id_data]) ? $data["datacontent"][$id_data] : "-";
                $row[] = $data_value;
            }
        }
    }
    fputcsv($output, $row);
}

fclose($output);
exit();
