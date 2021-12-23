<?php include 'header.php'; ?>






<div style="padding: 80px; margin-right:20px;" >

            <canvas id="myChart" width="100" height="100"></canvas>
        </div>

<script>
        var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['januar','feb','mart','aprl','mei','juni','jly'],
                    
                    datasets: [{
                            label: 'Yes',
                         data: [50,22,33,44,55,66],
                            backgroundColor:"#dd4b39",
                    },{
                        label: 'No',
                         data: [1,2,3,4,5,6,7],
                            backgroundColor:'#4d90fe',
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });

        </script>





