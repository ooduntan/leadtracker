require(['Chart.js-master/dist/Chart.js'], function(Chart){
    var ctx = document.getElementById("barChart-vertical");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
    var ctx = document.getElementById("barChart-horizontal");
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: ["green", "purple", "Yellow"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
    var pieData = {
          labels: [
          "Purple", 
          "Green", 
          "Orange", 
          "Yellow"
          ],
          datasets: [
            {
              data: [20, 40, 10, 30],
              backgroundColor: [
                 "#878BB6", 
                 "#4ACAB4", 
                 "#FF8153", 
                 "#FFEA88"
              ]
          }]
    };
        var ctx = document.getElementById("myData").getContext("2d");
        var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: pieData
        });
    var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
});

$('.category').on('change', function (e) {
  var visitorId = $(this).attr('visitor-id');
  var categoryId = $(this).val();

  window.location.href = '/visitor/'+visitorId+'/category/'+categoryId+'/classify';
})

$('.website').on('change', function (e) {
  var websiteId = $(this).val();
  console.log(websiteId);
  window.location.href = '/website/'+websiteId+'/visitors';
})