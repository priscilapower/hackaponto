$(document).ready(function(){
    $.get("chart-expressions-value", function(dataChart){

        var ochart = $('#chart-expressions-value');

        var expressionsChart = new Chart(ochart, {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';

                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }

                            content += '<span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
            data: {
                labels: dataChart.label,
                datasets: [{
                    label: 'Performance',
                    data: dataChart.data
                }]
            }
        });

        ochart.data('chart', expressionsChart);
    });

});
