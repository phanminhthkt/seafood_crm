$(document).ready(function(){
    if($("#sparkline_total").exists()){
    	$("#sparkline_total").sparkline([report.total.handoverProject, report.total.nohandoverProject, report.total.cancelProject], {
            type: "pie",
            width: "165",
            height: "165",
            sliceColors: ["#f58091", "#8b82d9", "#565d66"]
        })
    }
})
//report

//Report date
if($("#myChart").exists()){
    const ctx = document.getElementById('myChart').getContext('2d');
    // console.log(report.date);
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Số dự án',
                data: report.date.split(','),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true,   // minimum value will be 0.
                        min: 0,
                        max: 15,
                        stepSize: 3 // 1 - 2 - 3 ...
                    }
                }]
            }
        }
    });
}