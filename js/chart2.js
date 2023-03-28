const labels = Utils.months({count: 7});
const data = {
  labels: labels,
  datasets: [{
    axis: 'y',
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};


// var ctx = document.getElementById('myChart').getContext('2d');
//     var myChart = new Chart(ctx, {
//       type: 'horizontalBar',
//       data: {
//         labels: ['College of Agriculture', 'College of Architecture', 'College of Islamic Studies', 'College of Computing Studies', 
//         'College of Criminal Justice Education', 'College of Engineering', 'College of Forestry and Environmental Studies'
//       ,'College of Home Economics', 'College of Law', 'College of Liberal Arts', 'College of Nursing', 'College of Public Administration and Development Studies',
//       'College of Sports Science and Physical Education', 'College of Science and Mathematics', 'College of Social Work and Community Development', 'College of Teacher Education'],
//         datasets: [{
//           label: 'Collected',
//           data: [500000100, 520000000, 53000000, 54000000, 55000000, 56000000, 57000000, 
//             500000140, 5000010030, 50000120, 500000010, 500001100, 50000009, 50000008, 
//             500001050, 5001600, 500170000],
//           backgroundColor: 'rgba(255, 99, 132, 0.7)',
//           borderWidth: 0,
//           barThickness: 20,
//           maxBarThickness: 25
//         }]
//       },
//       options: {
//         title: {
//           display: true,
//           text: 'College Collections'
//         },
//         legend: {
//           display: false
//         },
//         responsive: true,
//         maintainAspectRatio: false,
//         scales: {
//           xAxes: [{
//             ticks: {
//               beginAtZero: true,
//               callback: function(value, index, values) {
//                 return '$' + value.toLocaleString();
//               }
//             },
//             scaleLabel: {
//               display: true,
//               labelString: 'Amount Collected'
//             }
//           }],
//           yAxes: [{
//             ticks: {
//               beginAtZero: true
//             },
//             gridLines: {
//               display: false
//             }
//           }]
//         },
//         tooltips: {
//           callbacks: {
//             label: function(tooltipItem, data) {
//               return '$' + tooltipItem.xLabel.toLocaleString();
//             }
//           }
//         }
//       }
//     });