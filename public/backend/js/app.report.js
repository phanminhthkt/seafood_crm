//Report top product
if($("#top-product-chart").exists()){
    const ctx = document.getElementById('top-product-chart').getContext('2d');
    // console.log(report.date);
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:report.name.split(','),
            datasets: [
                {
                    label: 'Doanh thu',
                    data: report.revenue.split(','),
                    backgroundColor: 'rgba(59,175,218,0.5)',
                    borderColor: 'rgba(59,175,218,1)',
                    borderWidth: 1,
                },
                
            ],
        },
        responsive: true,
        plugins: [ChartDataLabels],
        options: {

            indexAxis: 'y',
            plugins: {
              // Change options for ALL labels of THIS CHART
              datalabels: {
                color: '#004e6b',
                anchor : 'end',
                align  : 'end',
                padding:{left:'10'}, 
                font: {
                    family:'open',
                    // weight: 'bold',
                    size: 12,
                },   
                formatter: function(value, context) {
                  return  number_format(value);
                }
              }
            },
            scales: {
                x:  {
                    min: 0,
                    ticks: {
                        callback: function (value) {
                            return number_format(value)+' đ';
                        }
                    }
                }
            },
        },
    });
    $(".nav-link-ajax").click(function(){
        var href = $(this).attr('data-href');
        $('#pre-loader').show();    
        window.location = href;
    })
}

//Report revenue
if($("#revenue-chart-date").exists()){
    const ctx_date = document.getElementById('revenue-chart-date').getContext('2d');
    // console.log(report.date);
    var chart = new Chart(ctx_date, {
        type: 'line',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [
                {
                    label: 'Doanh thu tháng',
                    data: report.total_year.split(','),
                    backgroundColor: '#fff',
                    borderColor: 'rgba(59,175,218,1)',
                    borderWidth: 3,
                },
            ],
        },
        responsive: true,
        plugins: [ChartDataLabels],
        options: {
            plugins: {
              // Change options for ALL labels of THIS CHART
              datalabels: {
                color: '#004e6b',
                anchor : 'end',
                align  : 'end',
                padding:{left:'10'}, 
                font: {
                    family:'open',
                    // weight: 'bold',
                    size: 12,
                },   
                formatter: function(value, context) {
                  return  number_format(value);
                }
              }
            },
            scales: {
                y:  {
                    min: 0,
                    ticks: {
                        callback: function (value) {
                            return number_format(value)+' đ';
                        }
                    }
                }
            },
        },
    });
}
if($("#revenue-chart-day").exists()){
    const ctx_day = document.getElementById('revenue-chart-day').getContext('2d');
    // console.log(report.date);
    var chart = new Chart(ctx_day, {
        type: 'line',
        data: {
            labels: report.total_month.number.split(','),
            datasets: [
                {
                    label: 'Doanh thu ngày',
                    data: report.total_month.reveue.split(','),
                    backgroundColor: '#fff',
                    borderColor: 'rgba(59,175,218,1)',
                    borderWidth: 3,
                },
            ],
        },
        responsive: true,
        plugins: [ChartDataLabels],
        options: {
            plugins: {
              // Change options for ALL labels of THIS CHART
              datalabels: {
                color: '#004e6b',
                anchor : 'end',
                align  : 'end',
                padding:{left:'10'}, 
                font: {
                    family:'open',
                    // weight: 'bold',
                    size: 12,
                },   
                formatter: function(value, context) {
                  return  number_format(value);
                }
              }
            },
            scales: {
                y:  {
                    min: 0,
                    ticks: {
                        callback: function (value) {
                            return number_format(value)+' đ';
                        }
                    }
                }
            },
        },
    });
}

