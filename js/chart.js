var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Bahay Kubo', 'Wmsu Boracay', 'Repair'],
    datasets: [{
      label: 'Amount of Funds',
      data: [10000000, 2000000, 30000000],
      backgroundColor: [
        'rgba(255, 99, 132, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(255, 206, 86, 0.7)'
      ],
      borderColor: '#fff',
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    title: {
      display: true,
      text: 'Funds Allocation'
    },
    legend: {
      position: 'bottom'
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
          var label = data.labels[tooltipItem.index] || '';
          if (label) {
            label += ': ';
          }
          label += '$' + tooltipItem.yLabel.toLocaleString();
          return label;
        }
      }
    },
    plugins: {
      datalabels: {
        color: '#fff',
        formatter: function(value, context) {
          return '$' + value.toLocaleString();
        }
      }
    }
  }
});
