<?php
require_once "config.php";

//$sql = "SELECT * FROM mesure";
//$pre = $pdo->prepare($sql);
//$pre->execute();
//$dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

//$rowNumber = count($dataPlot);

$patientId = 5;

$sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$patientId."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$sensorId = $pre->fetchAll(PDO::FETCH_ASSOC);
var_dump($sensorId);

$sql = "SELECT * FROM mesure WHERE id_capteur = '".$sensorId[0]['id_capteur']."' ";
$pre = $pdo->prepare($sql);
$pre->execute();
$cardiacValuesPlot = $pre->fetchAll(PDO::FETCH_ASSOC);



// Algorythme de tri
foreach($cardiacValuesPlot as $cardiacValuesPlotReach){
    $maxYearCardiacValuesPlotFinal = 0;
    $maxMonthCardiacValuesPlotFinal = 0;
    $maxDayCardiacValuesPlotFinal = 0;
    $dateTimeCardiacValues = date_parse($cardiacValuesPlotReach['date_heure']);
    $maxYearCardiacValuesPlot = $dateTimeCardiacValues['year'];
    $maxMonthCardiacValuesPlot = $dateTimeCardiacValues['month'];
    $maxDayCardiacValuesPlot = $dateTimeCardiacValues['day'];

    if($maxYearCardiacValuesPlot > $maxYearCardiacValuesPlotFinal){
        $maxYearCardiacValuesPlotFinal = $maxYearCardiacValuesPlot;
    }
    if($maxMonthCardiacValuesPlot > $maxMonthCardiacValuesPlotFinal){
        $maxMonthCardiacValuesPlotFinal = $maxMonthCardiacValuesPlot;
    }
    if($maxDayCardiacValuesPlot > $maxDayCardiacValuesPlotFinal){
        $maxDayCardiacValuesPlotFinal = $maxDayCardiacValuesPlot;
    }
}

//foreach($cardiacValuesPlot as $dataToPlot){
//    //var_dump($row);
//    echo "['".$row['heure']."',".$row['battement']."],";
//    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);
//    $countDay = 0;

//    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
//        if($dataToPlotDateTime['month'] == $maxMonthCardiacValuesPlotFinal){
//            //echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
//            if($dataToPlotDateTime['day'] == $maxDayCardiacValuesPlotFinal){
//                //$dataToPlot['date_heure'] = date('H:i:s' ,strtotime($dataToPlot['date_heure']));
//                //echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
//                $countDay = $countDay + 1;
//                $sumDay = $dataToPlot['valeur'] + $moyDay;
//             }
//        }
        
//    }
//}

//$moyDay = $sumDay/$countDay;

//var_dump($cardiacValuesPlot);

//foreach($cardiacValuesPlot as $dataToPlot){
//    //var_dump($row);
//    //echo "['".$row['heure']."',".$row['battement']."],";
//    //var_dump($dataToPlot);
//    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);
//    //var_dump($dataToPlotDateTime['year']);
//    //var_dump($maxDayCardiacValuesPlotFinal);
//    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
        
//        if($dataToPlotDateTime['month'] == $maxMonthCardiacValuesPlotFinal){
//            if($dataToPlotDateTime['day'] == $maxDayCardiacValuesPlotFinal){
//                echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
//            }
//        }
        
//    }


//    //$rowDay = $dataToPlot[]
//    //var_dump($rowDay);       
//    ////echo "['".$row['date_heure']."',".$row['valeur']."],";
//}




//var_dump($rowNumber);

//$resultat = mysqli_query($connexion, "SELECT * FROM frequence" );

//if($resultat){
//    echo "CA MARCHE LETSGOOOO";
//}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Graphique</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Fréquence cardiaque'],

          <?php
            $sql = "SELECT * FROM mesure";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($cardiacValuesPlot);
            if($rowNumber>0){ //mysqli_num_rows($resultat) => initialement cette fonction mais conversion mySQLi -> PDO
                //while($row = $dataPlot){ //mysqli_fetch_array($resultat)
                //    echo "['".$row['heure']."',".$row['battement']."],";
                //}

                //foreach($cardiacValuesPlot as $row){
                //    //var_dump($row);
                //    //echo "['".$row['heure']."',".$row['battement']."],";
                    
                //    echo "['".$row['date_heure']."',".$row['valeur']."],";
                //}

                ////// TRI PAR JOUR ////

                //foreach($cardiacValuesPlot as $dataToPlot){
                //    //var_dump($row);
                //    //echo "['".$row['heure']."',".$row['battement']."],";
                //    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                //    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                //        if($dataToPlotDateTime['month'] == $maxMonthCardiacValuesPlotFinal){
                //            if($dataToPlotDateTime['day'] == $maxDayCardiacValuesPlotFinal){
                //                $dataToPlot['date_heure'] = date('H:i:s' ,strtotime($dataToPlot['date_heure']));
                //                echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                //            }
                //        }
        
                //    }
                //}

                ////// TRI PAR MOIS ////

                foreach($cardiacValuesPlot as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                        if($dataToPlotDateTime['month'] == $maxMonthCardiacValuesPlotFinal){
                            $dataToPlot['date_heure'] = date('d, H:i:s' ,strtotime($dataToPlot['date_heure']));
                            echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                        }
        
                    }
                }

                ////// TRI PAR AN ////

                //foreach($cardiacValuesPlot as $dataToPlot){
                //    //var_dump($row);
                //    //echo "['".$row['heure']."',".$row['battement']."],";
                //    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                //    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                //        $dataToPlot['date_heure'] = date('d/m' ,strtotime($dataToPlot['date_heure']));
                //        echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
        
                //    }
                //}
            }

          ?> 
            
        ]);

        var options = {
          title: 'Fréquence cardiaque',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
</head>


<body>
<div id="curve_chart" style="width: 900px; height: 500px"></div>
</body>
</html>

