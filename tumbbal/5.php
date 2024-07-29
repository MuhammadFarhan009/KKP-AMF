<!DOCTYPE html>
<html>
<head>
  <title>Fill Table with PHP</title>
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
  // $jumlahTurvar = count($response['turvar']);
  // $jumlahVarVal = $response['var'][0]['val'];
  $jumlahVervar = count($response['vervar']);
  // echo $jumlahVervar;
  $jumlahTahun = count($response['tahun']);
  $jumlahTurTahun = count($response['turtahun']);

  
  echo "<table border='1' style='border-collapse: collapse;'>";

  
  // echo "$jumlahBaris <br>";
  for ($i = 0; $i < $jumlahBaris; $i++) {
  echo "<tr>";
            
    

    // echo " $i<br><br> ";
    
    for ($j=0; $j < $jumlahVervar ; $j++) { 
      // echo " $j<br> ";
      $namaKabupaten = $response['vervar'][$j]['label'];
      echo "$namaKabupaten ";
      // echo "<td>$namaKabupaten</td>";

      // echo "$j<br><br>";
    }
    // echo $j;
    for ($k = 0; $k < $jumlahTahun; $k++) {
      $tahun = $response['tahun'][$k]['label'];
      echo "$tahun ";
      // echo "<td>$tahun</td>";
      // echo $k;
    }

    for ($l=0; $l < $jumlahTurTahun ; $l++) {
      $bulan = $response['turtahun'][$l]['label'];
      echo "$bulan ";
      // echo "<td>$bulan</td>";
      # code...
    }
  echo "</tr>";

    // echo $j;
    // echo $j;
}
echo "</table>";

?>


<table border="1">
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
    // Example data array
    $data = [
      ['kodeProvinsi' => 0, 'namaProvinsi' => 'Provinsi A', 'namaDaerah' => 'Daerah A', 'tahun' => 2023, 'bulan' => 'Januari', 'nilai' => 100],
      ['kodeProvinsi' => 1, 'namaProvinsi' => 'Provinsi B', 'namaDaerah' => 'Daerah B', 'tahun' => 2023, 'bulan' => 'Februari', 'nilai' => 90],
      // Add more data as needed
    ];

    // foreach ($data as $row) {
    //     echo "<tr>";
    //     echo "<td>{$row['kodeProvinsi']}</td>";
    //     echo "<td>{$row['namaProvinsi']}</td>";
    //     echo "<td>{$row['namaDaerah']}</td>";
    //     echo "<td>{$row['tahun']}</td>";
    //     echo "<td>{$row['bulan']}</td>";
    //     echo "<td>{$row['nilai']}</td>";
    //     echo "</tr>";
    // }
    // ?>
  </tbody>
</table>

</body>
</html>
