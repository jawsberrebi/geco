<meta charset="UTF-8">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChartYearCardiac);
    google.charts.setOnLoadCallback(drawChartMonthCardiac);
    google.charts.setOnLoadCallback(drawChartDayCardiac);
    google.charts.setOnLoadCallback(drawChartYear);
    google.charts.setOnLoadCallback(drawChartMonth);
    google.charts.setOnLoadCallback(drawChartDay);

    function drawChartYearCardiac() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Fréquence cardiaque'],

          <?php
            $sql = "SELECT * FROM mesure";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($cardiacValuesPlot);
            if($rowNumber>0){ 


                foreach($cardiacValuesPlot as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                        $dataToPlot['date_heure'] = date('d/m/y' ,strtotime($dataToPlot['date_heure']));

                        if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                            $dataToPlot['date_heure'] = date('d/m' ,strtotime($dataToPlot['date_heure']));
                            echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
        
                        }

                        
        
                    }


                }

                
            }



          ?> 
            
        ]);

        var options = {
          title: 'Fréquence cardiaque cette année',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_cardiac'));

        chart.draw(data, options);
    }

    function drawChartYearSound() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Niveau sonore'],

          <?php
            $sql = "SELECT * FROM mesure";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($soundValuesPlot);
            if($rowNumber>0){ 

                ////// TRI PAR AN ////

                foreach($soundValuesPlot as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearSoundValuesPlotFinal){
                        $dataToPlot['date_heure'] = date('d/m' ,strtotime($dataToPlot['date_heure']));

                        if($dataToPlotDateTime['year'] == $maxYearSoundValuesPlotFinal){
                            $dataToPlot['date_heure'] = date('d/m' ,strtotime($dataToPlot['date_heure']));
                            echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
        
                        }

                        
        
                    }


                }

                
            }



          ?> 
            
        ]);

        var options = {
          title: 'Niveau sonore cette année',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_sound'));

        chart.draw(data, options);
    }


    function drawChartYearGas() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Concentration en CO2'],

          <?php
            $sql = "SELECT * FROM mesure";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($gasValuesPlot);
            if($rowNumber>0){ 

                ////// TRI PAR AN ////

                foreach($gasValuesPlot as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearGasValuesPlotFinal){
                        $dataToPlot['date_heure'] = date('d/m/y' ,strtotime($dataToPlot['date_heure']));

                        if($dataToPlotDateTime['year'] == $maxYearGasValuesPlotFinal){
                            $dataToPlot['date_heure'] = date('d/m' ,strtotime($dataToPlot['date_heure']));
                            echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
        
                        }

                        
        
                    }


                }

                
            }



          ?> 
            
        ]);

        var options = {
          title: 'Concentration en CO2 cette année',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_gas'));

        chart.draw(data, options);
    }

    function drawChartMonthCardiac() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Fréquence cardiaque'],

          <?php
            $sql = "SELECT * FROM mesure WHERE date_heure LIKE '". date('Y-m') ."%' ";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($cardiacValuesPlotMonth);
            if($rowNumber>0){ 

                ////// TRI PAR MOIS ////

                foreach($cardiacValuesPlotMonth as $dataToPlot){
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
                    
            }



          ?> 
            
        ]);

        var options = {
          title: 'Fréquence cardiaque ce mois-ci',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_cardiac'));

        chart.draw(data, options);
    }


    function drawChartMonthSound() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Niveau sonore'],

          <?php
            $sql = "SELECT * FROM mesure WHERE date_heure LIKE '". date('Y-m') ."%' ";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($soundValuesPlotMonth);
            if($rowNumber>0){ 

                ////// TRI PAR MOIS ////

                foreach($soundValuesPlotMonth as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearSoundValuesPlotFinal){
                        if($dataToPlotDateTime['month'] == $maxMonthSoundValuesPlotFinal){
                            $dataToPlot['date_heure'] = date('d, H:i:s' ,strtotime($dataToPlot['date_heure']));
                            echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                        }
        
                    }
                }
                    
            }



          ?> 
            
        ]);

        var options = {
          title: 'Niveau sonore ce mois-ci',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_sound'));

        chart.draw(data, options);
    }


    function drawChartMonthGas() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Niveau sonore'],

          <?php
            $sql = "SELECT * FROM mesure WHERE date_heure LIKE '". date('Y-m') ."%' ";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($gasValuesPlotMonth);
            if($rowNumber>0){ 

                ////// TRI PAR MOIS ////

                foreach($gasValuesPlotMonth as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearGasValuesPlotFinal){
                        if($dataToPlotDateTime['month'] == $maxMonthGasValuesPlotFinal){
                            $dataToPlot['date_heure'] = date('d, H:i:s' ,strtotime($dataToPlot['date_heure']));
                            echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                        }
        
                    }
                }
                    
            }



          ?> 
            
        ]);

        var options = {
          title: 'Concentratoion en CO2 ce mois-ci',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_gas'));

        chart.draw(data, options);
    }

    function drawChartDayCardiac() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Fréquence cardiaque'],

          <?php

            $rowNumber = count($cardiacValuesPlotDay);

            if($rowNumber>0){ 
                ////// TRI PAR JOUR ////
                    foreach($cardiacValuesPlotDay as $dataToPlot){
                        $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                        if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                            if($dataToPlotDateTime['month'] == $maxMonthCardiacValuesPlotFinal){
                                if($dataToPlotDateTime['day'] == $maxDayCardiacValuesPlotFinal){
                                    $dataToPlot['date_heure'] = date('H:i:s' ,strtotime($dataToPlot['date_heure']));
                                    echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                                }
                            }
        
                        }
                    }
                    
                    
            }




            



          ?> 
            
        ]);

        var options = {
          title: 'Fréquence cardiaque aujourd\'hui',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_cardiac'));

        chart.draw(data, options);
    }


    function drawChartDaySound() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Niveau sonore'],

          <?php
            $sql = "SELECT * FROM mesure WHERE date_heure LIKE '". date('Y-m-d') ."%' ";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($soundValuesPlotDay);
            if($rowNumber>0){ 
                ////// TRI PAR JOUR ////

                foreach($soundValuesPlotDay as $dataToPlot){
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearSoundValuesPlotFinal){
                        if($dataToPlotDateTime['month'] == $maxMonthSoundValuesPlotFinal){
                            if($dataToPlotDateTime['day'] == $maxDaySoundValuesPlotFinal){
                                $dataToPlot['date_heure'] = date('H:i:s' ,strtotime($dataToPlot['date_heure']));
                                echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                            }
                        }
        
                    }
                }
                    
            }



          ?> 
            
        ]);

        var options = {
          title: 'Niveau sonore aujourd\'hui',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_sound'));

        chart.draw(data, options);
    }


    function drawChartDayGas() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Concentration en CO2'],

          <?php
            $sql = "SELECT * FROM mesure WHERE date_heure LIKE '". date('Y-m-d') ."%' ";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($gasValuesPlotDay);
            if($rowNumber>0){ 
                ////// TRI PAR JOUR ////

                foreach($gasValuesPlotDay as $dataToPlot){
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearGasValuesPlotFinal){
                        if($dataToPlotDateTime['month'] == $maxMonthGasValuesPlotFinal){
                            if($dataToPlotDateTime['day'] == $maxDayGasValuesPlotFinal){
                                $dataToPlot['date_heure'] = date('H:i:s' ,strtotime($dataToPlot['date_heure']));
                                echo "['".$dataToPlot['date_heure']."',".$dataToPlot['valeur']."],";
                            }
                        }
        
                    }
                }
                    
            }



          ?> 
            
        ]);

        var options = {
          title: 'Concentration en CO2 aujourd\'hui',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_gas'));

        chart.draw(data, options);
    }

</script>