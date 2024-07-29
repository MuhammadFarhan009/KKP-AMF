<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes buat ubah data</title>
    <style src="./src/output.css"></style>
</head>
<body class=" bg-white">
    <p>tes aja dulu </p>
    <?php
        $url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/68/key/e437040ac2bc6886742a0bfab5a46355/";

        $curl = curl_init(); // Initialize cURL
        curl_setopt($curl, CURLOPT_URL, $url); // Set URL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl); // Execute cURL
        curl_close($curl); // Close cURL

        $response = json_decode($response, TRUE);

        $idvariabel = $response["var"][0]["val"];
        $jumlahbaris = count($response["vervar"]);
        $jumlahkarakteristik = count($response["turvar"]);
        $jumlahtahun = count($response["tahun"]);
        $jumlahturtahun = count($response["turtahun"]);
        $title = $response["var"][0]["label"];
        
        echo "<table border='1'><thead>";

        if ($jumlahturtahun == 1 && $jumlahkarakteristik == 1) {
            // No year descendants and no characteristics
            echo "<tr><th rowspan='3'>" . $response["labelvervar"] . "</th></tr> ";
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
        echo "</table>";
        
        echo ""; // Add space between tables
        
        echo "tolol";

        echo "<table border='2'><thead>";

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


    echo "<br><br>";
    echo "tes table baru <br><br>";
    echo "</thead><tbody>";
        for ($i = 0; $i < $jumlahbaris; $i++) {
            echo "<tr>";
            // echo "<td>" . $response["vervar"][$i]["label"] . "</td>";
    
            for ($j = 0; $j < $jumlahkarakteristik; $j++) {
                for ($k = 0; $k < $jumlahtahun; $k++) {
                    for ($l = 0; $l < $jumlahturtahun; $l++) {
                        $id_data = $response["vervar"][$i]["val"] .
                                   $idvariabel .
                                   $response["turvar"][$j]["val"] .
                                   $response["tahun"][$k]["val"] .
                                   $response["turtahun"][$l]["val"];
                        $data = isset($response["datacontent"][$id_data]) ? $response["datacontent"][$id_data] : "null";
                        echo "<td>" .$data . "<br>" . "</td>";
                    }
                }
            }
            echo "</tr>";
        }
        echo "</tbody></table>";

        ?>
    

    
</body>
</html>
