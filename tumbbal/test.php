<!DOCTYPE html>
<html>
<head>
    <title>Contoh Penggunaan WebAPI</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <link href="./src/output.css" rel="stylesheet"> -->

</head>
<body class="bg">
    <?php
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_GET['variable'])) {
        $variable = $_GET['variable'];
        $url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/$variable/key/e437040ac2bc6886742a0bfab5a46355/";
        // echo $variable; // Outputs: Hello, World!
    }

    $curl = curl_init(); // Initialize cURL
    curl_setopt($curl, CURLOPT_URL, $url); // Set URL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl); // Execute cURL
    curl_close($curl); // Close cURL

    $response = json_decode($response, TRUE); // Decode JSON to Array



    if (!$response) {
        echo "Failed to fetch or decode JSON.";
        exit;
    }

    $idvariabel = $response["var"][0]["val"];
    $jumlahbaris = count($response["vervar"]);
    $jumlahkarakteristik = count($response["turvar"]);
    $jumlahtahun = count($response["tahun"]);
    $jumlahturtahun = count($response["turtahun"]);

    

    $title = $response["var"][0]["label"];
    echo "<h1>" . $title . "</h1>";

    echo "<table border='1'><thead>";

    if ($jumlahturtahun == 1 && $jumlahkarakteristik == 1) {
        // No year descendants and no characteristics
        echo "<tr><th rowspan='3'>" . $response["labelvervar"] . "</th></tr>";
        echo "<tr><th colspan='" . $jumlahtahun . "'>" . $response["var"][0]["label"] . "</th></tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahtahun; $i++) {
            echo "<th>" . $response["tahun"][$i]["label"] . "</th>";
        }
        echo "</tr>";
    } else if ($jumlahturtahun > 1 && $jumlahkarakteristik == 1) {
        // Year descendants and no characteristics
        echo "<tr><th rowspan='4'>" . $response["labelvervar"] . "</th></tr>";
        echo "<tr><th colspan='" . $jumlahtahun * $jumlahturtahun . "'>" . $response["var"][0]["label"] . "</th></tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahtahun; $i++) {
            echo "<th colspan='" . $jumlahturtahun . "'>" . $response["tahun"][$i]["label"] . "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahtahun; $i++) {
            for ($j = 0; $j < $jumlahturtahun; $j++) {
                echo "<th>" . $response["turtahun"][$j]["label"] . "</th>";
            }
        }
        echo "</tr>";
    } else if ($jumlahturtahun == 1 && $jumlahkarakteristik > 1) {
        // No year descendants and has characteristics
        echo "<tr><th rowspan='4'>" . $response["labelvervar"] . "</th></tr>";
        echo "<tr><th colspan='" . $jumlahkarakteristik * $jumlahtahun . "'>" . $response["var"][0]["label"] . "</th></tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahkarakteristik; $i++) {
            echo "<th colspan='" . $jumlahtahun . "'>" . $response["turvar"][$i]["label"] . "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahkarakteristik; $i++) {
            for ($j = 0; $j < $jumlahtahun; $j++) {
                echo "<th>" . $response["tahun"][$j]["label"] . "</th>";
            }
        }
        echo "</tr>";
    } else if ($jumlahturtahun > 1 && $jumlahkarakteristik > 1) {
        // Year descendants and has characteristics
        echo "<tr><th rowspan='5'>" . $response["labelvervar"] . "</th></tr>";
        echo "<tr><th colspan='" . $jumlahkarakteristik * $jumlahtahun * $jumlahturtahun . "'>" . $response["var"][0]["label"] . "</th></tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahkarakteristik; $i++) {
            echo "<th colspan='" . $jumlahtahun * $jumlahturtahun . "'>" . $response["turvar"][$i]["label"] . "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahkarakteristik; $i++) {
            for ($j = 0; $j < $jumlahtahun; $j++) {
                echo "<th colspan='" . $jumlahturtahun . "'>" . $response["tahun"][$j]["label"] . "</th>";
            }
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 0; $i < $jumlahkarakteristik; $i++) {
            for ($j = 0; $j < $jumlahtahun; $j++) {
                for ($k = 0; $k < $jumlahturtahun; $k++) {
                    echo "<th>" . $response["turtahun"][$k]["label"] . "</th>";
                }
            }
        }
        echo "</tr>";
    }
    echo "</thead><tbody>";

    for ($i = 0; $i < $jumlahbaris; $i++) {
        echo "<tr>";
        echo "<td>" . $response["vervar"][$i]["label"] . "</td>";

        for ($j = 0; $j < $jumlahkarakteristik; $j++) {
            for ($k = 0; $k < $jumlahtahun; $k++) {
                for ($l = 0; $l < $jumlahturtahun; $l++) {
                    $id_data = $response["vervar"][$i]["val"] .
                               $idvariabel .
                               $response["turvar"][$j]["val"] .
                               $response["tahun"][$k]["val"] .
                               $response["turtahun"][$l]["val"];
                    $data = isset($response["datacontent"][$id_data]) ? $response["datacontent"][$id_data] : "-";
                    echo "<td>" . $data . "</td>";
                }
            }
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>
<button class="btn btn-secondary">Two</button>


    <script>
        $(document).ready(function(){
            console.log("jQuery is working!");
        });

    </script>

<button onclick="downloadTable()">Download Table</button>

<script>
     function downloadTable() {
        var variable = "<?php echo $variable; ?>";
        var title = "<?php echo $title; ?>";
        
        
        var url = 'download.php?variable=' + variable + '&title=' + title;
        
        window.location.href = url;
    }
</script>
</body>
</html>
