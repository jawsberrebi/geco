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
          title: 'Fréquence cardiaque',
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

            $rowNumber = count($cardiacValuesPlot);
            if($rowNumber>0){ 

                ////// TRI PAR AN ////

                foreach($cardiacValuesPlot as $dataToPlot){
                    //var_dump($row);
                    //echo "['".$row['heure']."',".$row['battement']."],";
                    $dataToPlotDateTime = date_parse($dataToPlot['date_heure']);

                    if($dataToPlotDateTime['year'] == $maxYearCardiacValuesPlotFinal){
                        $dataToPlot['date_heure'] = date('d/m' ,strtotime($dataToPlot['date_heure']));

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
          title: 'Niveau sonore',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_sound'));

        chart.draw(data, options);
    }

    function drawChartMonthCardiac() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Fréquence cardiaque'],

          <?php
            $sql = "SELECT * FROM mesure";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($cardiacValuesPlot);
            if($rowNumber>0){ 

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
                    
            }



          ?> 
            
        ]);

        var options = {
          title: 'Fréquence cardiaque',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_cardiac'));

        chart.draw(data, options);
    }

    function drawChartDayCardiac() {
        
        var data = google.visualization.arrayToDataTable([
          ['Durée', 'Fréquence cardiaque'],

          <?php
            $sql = "SELECT * FROM mesure";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $dataPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

            $rowNumber = count($cardiacValuesPlot);
            if($rowNumber>0){ 
                ////// TRI PAR JOUR ////

                foreach($cardiacValuesPlot as $dataToPlot){
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
          title: 'Fréquence cardiaque',
          //curveType: 'function',
          legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_cardiac'));

        chart.draw(data, options);
    }



</script>