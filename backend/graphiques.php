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


$patientId = 5;

$sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$patientId."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$sensorId = $pre->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM mesure WHERE id_capteur = '".$sensorId[0]['id_capteur']."' AND date_heure LIKE '2021%' "; //METTRE date('Y') dedans
$pre = $pdo->prepare($sql);
$pre->execute();
$cardiacValuesPlotYear = $pre->fetchAll(PDO::FETCH_ASSOC);

//var_dump($cardiacValuesPlotYear);
//$counting = 0;
//$numberValJanuary = 0;
//$totalJanuary= 0;

//$m

$numberValMonth = array_fill(1, 12, 0);
$totalMonth = array_fill(1, 12, 0);
foreach($cardiacValuesPlotYear as $cardiacValuesPlotYearScroll){
    echo $cardiacValuesPlotYearScroll['date_heure'];
    $mot = '2021-11';

    foreach(range(1, 12) as $i){
        $month = sprintf("%02d", $i);

        if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-'.$i.'-') == true){ //rempl par la fct date
            $numberValMonth[$i]++;
            $totalMonth[$i] = $cardiacValuesPlotYearScroll['valeur'] + $totalMonth;
        }

    }

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-01-') == true){ //rempl par la fct date
    //    $numberValJanuary++;
    //    $totalJanuary = $cardiacValuesPlotYearScroll['valeur'] + $totalJanuary;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-02-') == true){ //rempl par la fct date
    //    $numberValFebruary++;
    //    $totalFebruary = $cardiacValuesPlotYearScroll['valeur'] + $totalFebruary;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-03-') == true){ //rempl par la fct date
    //    $numberValMarch++;
    //    $totalMarch = $cardiacValuesPlotYearScroll['valeur'] + $totalMarch;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-04-') == true){ //rempl par la fct date
    //    $numberValApril++;
    //    $totalApril = $cardiacValuesPlotYearScroll['valeur'] + $totalApril;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-05-') == true){ //rempl par la fct date
    //    $numberValMay++;
    //    $totalMay = $cardiacValuesPlotYearScroll['valeur'] + $totalMay;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-06-') == true){ //rempl par la fct date
    //    $numberValJune++;
    //    $totalJune = $cardiacValuesPlotYearScroll['valeur'] + $totalJune;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-07-') == true){ //rempl par la fct date
    //    $numberValJuly++;
    //    $totalJuly = $cardiacValuesPlotYearScroll['valeur'] + $totalJuly;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-08-') == true){ //rempl par la fct date
    //    $numberValAugust++;
    //    $totalAugust = $cardiacValuesPlotYearScroll['valeur'] + $totalAugust;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-09-') == true){ //rempl par la fct date
    //    $numberValSeptember++;
    //    $totalSeptember = $cardiacValuesPlotYearScroll['valeur'] + $totalSeptember;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-10-') == true){ //rempl par la fct date
    //    $numberValOctober++;
    //    $totalOctober = $cardiacValuesPlotYearScroll['valeur'] + $totalOctober;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-11-') == true){ //rempl par la fct date
    //    $numberValNovember++;
    //    $totalNovember = $cardiacValuesPlotYearScroll['valeur'] + $totalNovember;
    //}

    //if(strstr($cardiacValuesPlotYearScroll['date_heure'], '2021-12-') == true){ //rempl par la fct date
    //    $numberValDecember++;
    //    $totalDecember = $cardiacValuesPlotYearScroll['valeur'] + $totalDecember;
    //}
    
}

//$finalTotalJanuary = $totalJanuary/$numberValJanuary;
//$finalTotalFebruary = $totalFebruary/$numberValFebruary;
//$finalTotalMarch = $totalMarch/$numberValMarch;
//$finalTotalFebruary = $totalFebruary/$numberValFebruary;


//$months = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
//$yearDataToPlot = [
//    "Janvier" => $finalTotalJanuary,
//    "Février" = 
//    ];






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

                //foreach($cardiacValuesPlot as $dataToPlot){
                //    //var_dump($row);
                //    //echo "['".$row['heure']."',".$row['battement']."],";
                //    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                //    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                //        if($dataToPlotDateTime['month'] == $maxMonthCardiacValuesPlotFinal){
                //            $dataToPlot['date_heure'] = date('d, H:i:s' ,strtotime($dataToPlot['date_heure']));
                //            echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                //        }
        
                //    }
                //}

                ////// TRI PAR AN ////

                $dataToPlotPauseDate = NULL;
                $dataToPlotPauseValue = NULL;
                $dataMean = NULL;

                foreach($cardiacValuesPlot as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                        $dataToPlot['date_heure'] = date('d/m' ,strtotime($dataToPlot['date_heure']));

                        if($dataToPlotPauseDate == $dataToPlot['date_heure']){

                            $dataToPlotPauseValue = ($dataToPlot['valeur'] + $dataToPlotPauseValue)/2;
                            $dataMean = array('valeur' => ($dataToPlotPauseValue + $dataMean));
                
                        }

                        echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";

                        
        
                    }


                }

                
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

