<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes aja</title>
</head>
<body>
    <?php

        $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/2/key/e437040ac2bc6886742a0bfab5a46355/';

        $curl = curl_init();  // Initialize cURL
        curl_setopt($curl, CURLOPT_URL, $url);  // Set URL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);  // Execute cURL
        curl_close($curl);  // Close cURL

        $response = json_decode($response, TRUE);

        $jumlahBaris = count($response['turvar']) * count($response['vervar']) * count($response['tahun']) * count($response['turtahun']);
        $jumlahTurvar = count($response['turvar']);
        $jumlahVarVal = $response['var'][0]['val'];
        $jumlahVervar = count($response['vervar']);
        $jumlahTahun = count($response['tahun']);
        $jumlahTurTahun = count($response['turtahun']);
        // echo "$jumlahBaris <br>";
        // echo "$jumlahTurvar <br>";
        // echo "$jumlahVarVal <br>";
        // echo "$jumlahVervar <br>";
        // echo "$jumlahTahun <br>";
        // echo "$jumlahTurTahun <br>";
        // $data = array();
        // $jumlahBaris = count();

    

        class FormattedItem {
            public $id;
            public $kodeProvinsi;
            public $namaProvinsi;
            public $kodeDaerah;
            public $tahun;
            public $bulan;
            public ?float $nilai;
    
            public function __construct($id,$kodeProvinsi, $namaProvinsi, $kodeDaerah, $tahun, $bulan, ?float $nilai) {
                $this->id = $id;
                $this->kodeProvinsi = $kodeProvinsi;
                $this->namaProvinsi = $namaProvinsi;
                $this->kodeDaerah = $kodeDaerah;
                $this->tahun = $tahun;
                $this->bulan = $bulan;
                $this->nilai = $nilai;
            }
        }

        
    

    ?>

    
    
    <!-- <p>vhcy </p> -->
    <!-- <p><?php $jumlahBaris ?></p> -->
    <table border= '1'>
    <thead>
        <tr>
            <th>Kode Provinsi</th>
            <th>Nama Provinsi</th>
            <th>Nama Daerah</th>
            <th>Tahun</th>
            <th>Bulan</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < $jumlahBaris; $i++) {
            
            echo '<tr>';

            echo "<td> $i </td>";

            echo '<td>Nama Daerah</td>';
            echo '<td>Nama Daerah</td>';
            echo '<td>Tahun</td>';
            echo '<td>Bulan</td>';
            echo '<td>Nilai</td>';
            echo '</tr>';
        }
    ?>

        
            <!-- <td>1</td> -->
          
    </tbody>
</table>
</body>
</html>