
<?php
    try{
        $db = new PDO('pgsql:dbname=testdb host=localhost port=5432','office_mac','');
    }catch(PDOException $e){
        echo 'db接続エラー：'. $e->getMessage();
    }

    $stmt = $db->prepare("select * from companies");
    $stmt->execute();
    $companies = $stmt->fetchAll(\PDO::FETCH_OBJ);
    
    foreach($companies as $company){
        $company->name;
        var_dump($company->name.$company->sales);
    
        $stmt = $db->prepare("select * from valentain_sales where company_id = $company->id");
                 $stmt->execute();
                 $sales = $stmt->fetchAll(\PDO::FETCH_OBJ);
                 foreach($sales as $sale){
                    var_dump($sale->sales);
                 }
                }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chart Practice</title>
    
</head>
<body>
    <h1>Chart Example</h1>

    <ol>
        <h2><li>Basic line</li></h2>
        <figure class='highcharts-figure'>
        <div id='container'></div>
        <p class='description'>
            Basic line chartを使ってデータがみやすくなります。
        </p>
        </figure>


        <h2><li>with data labels</li></h2>
        <figure>
            <div id='container2'></div>
            <p>小さなデータの読みやすさと理解を高める</p>
        </figure>

        <h2><li>Stacked area</li></h2>
        <figure>
            <div id='container3'></div>
            <p>全項目のデータの合計を出してくれる</p>
        </figure>

        <h2><li>Basic bar</li></h2>
        <figure> 
            <div id='basicbar'></div>
            <p>体積を可視化</p>
        </figure>
        
        <h2><li>Stacked bar</li></h2>
        <figure> 
            <div id='stackedbar'></div>
            <p>データの合計を比べやすい</p>
        </figure>

        <h2><li>Stacked column chart</li></h2>
        <figure> 
            <div id='stackedColumn'></div>
            <p>量を比べる為のチャート。データの合計を可視化しながら、個別のセクションも可視化する。</p>
        </figure>

        <h2><li>Pie chart</li></h2>
        <figure> 
            <div id='pieChart'></div>
            <p>円グラフ</p>
        </figure>

        <h2><li>Scatter plot</li></h2>
        <figure> 
            <div id='scatterPlot'></div>
            <p>２つのデータの繋がりを可視化するために使われる。このグラフでは、男性の平均体重と身長が女性のそれらより大きいことを明らかにしている。</p>
        </figure>

    </ol>

    <h1>Chart Practice</h1>
    <ol>
        <h2><li>Basic line</li></h2>
        <figure class='highcharts-figure'>
        <div id='basicLine'></div>
        <p class='description'>
            バレンタイン期間における各社の売上推移
        </p>
        </figure>

        <h2><li>valentain</li></h2>
        <figure class='highcharts-figure'>
        <div id='valentain'></div>
        <p class='description'>
            バレンタイン期間における各社の売上推移
        </p>
        </figure>
        
        <h2><li>Stacked area</li></h2>
        <figure class='highcharts-figure'>
        <div id='v-stacked-area'></div>
        <p class='description'>
            バレンタイン期間における各社の売上推移
        </p>
        </figure>
        
        <h2><li>Stacked bar</li></h2>
        <figure class='highcharts-figure'>
        <div id='v-stacked-bar'></div>
        <p class='description'>
            バレンタイン期間における各社の売上推移
        </p>
        </figure>
        
        <h2><li>Stacked column chart</li></h2>
        <figure class='highcharts-figure'>
        <div id='v-stacked-column'></div>
        <p class='description'>
            バレンタイン期間における各社の売上推移
        </p>
        </figure>
        
        <h2><li>Scatter plot</li></h2>
        <figure class='highcharts-figure'>
        <div id='v-stacked-scatter'></div>
        <p class='description'>
            バレンタイン期間における各社の売上推移
        </p>
        </figure>
    </ol>

    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        
        <script type="text/javascript">
            
                Highcharts.chart('valentain', {

                title: {
                    text: 'バレンタイン売上を出してみよう'
                },

                subtitle: {
                    text: 'by akina yamada'
                },

                yAxis: {
                    title: {
                        text: '売上'
                    }
                },

                xAxis: {
                    accessibility: {
                        rangeDescription: 'Range: 2015 to 2020'
                    },
                    categories:[
                        2015,2016,2017,2018,2019,2020
                    ]
                },

                legend: {
                    layout: 'vertical',
                    align: 'left',
                    verticalAlign: 'top',
                    floating: true,
                    borderWidth: 2,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || 'white',
                    shadow: true,
                    x: 150,
                    y: 100
                },

                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                    }
                },
                
                series: [
                    <?php foreach($companies as $company): ?>
                    {
                    name: '<?php echo $company->name; ?>' ,
                    
                    data: [<?php 
                            $stmt = $db->prepare("select * from valentain_sales where company_id = $company->id");
                            $stmt->execute();
                            $sales = $stmt->fetchAll(\PDO::FETCH_OBJ);
                            foreach($sales as $sale):
                            echo $sale->sales; ?>,
                            <?php endforeach; ?>]
                    },
                    <?php endforeach; ?>
                    ],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 1000
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
            

                    Highcharts.chart('v-stacked-area', {
                    chart: {
                        type: 'area'
                    },
                    title: {
                        text: 'バレンタイン売上'
                    },
                    subtitle: {
                        text: 'by akina'
                    },
                    xAxis: {
                        categories: ['2015', '2016', '2017', '2018', '2019', '2000'],
                        tickmarkPlacement: 'on',
                        title: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        title: {
                            text: '売上'
                        },
                        labels: {
                            formatter: function () {
                                return this.value / 1000;
                            }
                        }
                    },
                    tooltip: {
                        split: true,
                        valueSuffix: ' 万円'
                    },
                    plotOptions: {
                        area: {
                            stacking: 'normal',
                            lineColor: '#666666',
                            lineWidth: 1,
                            marker: {
                                lineWidth: 1,
                                lineColor: '#666666'
                            }
                        }
                    },
                    series: [
                        <?php foreach($companies as $company): ?>
                        {
                        name:'<?php echo $company->name; ?>',
                        data: [
                            <?php
                            $stmt = $db->prepare("select * from valentain_sales where company_id = $company->id");
                            $stmt->execute();
                            $sales = $stmt->fetchAll(\PDO::FETCH_OBJ);
                            foreach($sales as $sale):
                            echo $sale->sales; ?>,
                            <?php endforeach; ?>
                        ]
                        },<?php endforeach; ?>],
                    });


                Highcharts.chart('v-stacked-bar', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'バレンタイン売上'
                    },
                    xAxis: {
                        categories: ['2015', '2016', '2017', '2018', '2019','2020']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '売上'
                        }
                    },
                    tooltip: {
                        split: true,
                        valueSuffix: ' 万円'
                    },
                    legend: {
                        reversed: true
                    },
                    plotOptions: {
                        series: {
                            stacking: 'normal'
                        }
                    },
                    series: [
                        <?php foreach($companies as $company): ?>
                        {
                        name: '<?php echo $company->name ?>',
                        
                        data: [
                            <?php 
                            $stmt = $db->prepare("select * from valentain_sales where company_id = $company->id");
                            $stmt->execute();
                            $sales = $stmt->fetchAll(\PDO::FETCH_OBJ);
                            foreach($sales as $sale):
                            echo $sale->sales; ?>,
                            <?php endforeach; ?>]
                   
                    },
                <?php endforeach; ?>]
                });

                Highcharts.chart('v-stacked-column', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Stacked column chart'
                },
                xAxis: {
                    categories: ['2015', '2016', '2017', '2018', '2019','2020']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '売上'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: ( // theme
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || 'gray'
                        }
                    }
                },
                legend: {
                    align: 'left',
                    x: 100,
                    verticalAlign: 'top',
                    y: 35,
                    floating: true,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: true
                },
                
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
                    valueSuffix: ' 万円'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [
                    <?php foreach($companies as $company): ?>
                    {
                    name: '<?php echo($company->name); ?>',
                    data: [
                        <?php 
                            $stmt = $db->prepare("select * from valentain_sales where company_id = $company->id");
                            $stmt->execute();
                            $sales = $stmt->fetchAll(\PDO::FETCH_OBJ);
                            foreach($sales as $sale):
                            echo $sale->sales; ?>,
                            <?php endforeach; ?>
                        ]},
                            <?php endforeach; ?>]
            });


            Highcharts.chart('v-stacked-scatter', {
    chart: {
        type: 'scatter',
        zoomType: 'xy'
    },
    title: {
        text: 'バレンタイン売上'
    },
    subtitle: {
        text: 'scatter plot'
    },
    xAxis: {
        title: {
            enabled: true,
            text: '売上 (万円)'
        },
        startOnTick: true,
        endOnTick: true,
        showLastLabel: true
    },
    yAxis: {
        title: {
            text: '年度'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 100,
        y: 70,
        floating: true,
        backgroundColor: Highcharts.defaultOptions.chart.backgroundColor,
        borderWidth: 1
    },
    plotOptions: {
        scatter: {
            marker: {
                radius: 5,
                states: {
                    hover: {
                        enabled: true,
                        lineColor: 'rgb(100,100,100)'
                    }
                }
            },
            states: {
                hover: {
                    marker: {
                        enabled: false
                    }
                }
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x} 万円, {point.y} 年'
            }
        }
    },
    series: [
        
        <?php foreach($companies as $company): ?>
        {
        name: '<?php echo $company->name; ?>',
        color: 'rgba(223, 83, 83, .5)',
        data: [
            <?php 
                $stmt = $db->prepare("select * from valentain_sales where company_id = $company->id");
                $stmt->execute();
                $sales = $stmt->fetchAll(\PDO::FETCH_OBJ);
                foreach($sales as $sale):
            ?>[
            <?php echo $sale->sales; ?>,<?php echo $sale->year; ?>],
                <?php endforeach; ?>
        ]},
            <?php endforeach; ?>
            
    ]
});


            </script>
    
    <script src='basicLine.js'></script>
</body>
</html>
