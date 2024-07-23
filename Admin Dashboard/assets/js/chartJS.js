
const ctx = document.getElementById('chart-1');

new Chart(ctx, {
  type: 'polarArea',
  data: {
    labels: ['Red', 'Blue', 'Yellow'],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3],
      backgroundColor:[
        "rgba(54, 162, 235, 1)",
        "rgba(255, 99, 132, 1)",
        "rgba(255, 206, 86, 1)",
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive:true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});



const rtx = document.getElementById('chart-2');

new Chart(rtx, {
  type: 'bar',
  data: {
    labels: ['Red', 'Blue', 'Yellow'],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3],
      backgroundColor:[
        "rgba(54, 162, 235, 1)",
        "rgba(255, 99, 132, 1)",
        "rgba(255, 206, 86, 1)",
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive:true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});