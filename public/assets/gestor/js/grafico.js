
//cria os gráficos
 var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Jan", "Ferv", "Mar", "Abr", "Mai", "Jun", "Jul","Ago","Set","Out", "Nov","Dez"],
          datasets: [{
		   label: 'Entradas',
            data: entradas,
            lineTension: 0,
            backgroundColor: '#4e9bbf',
            borderColor: '#4e9bbf',
            borderWidth: 1,
            pointBackgroundColor: '#607bd7'
          },
		  {
			label: 'Saídas',
            data: saidas,
            lineTension: 0,
            backgroundColor: '#f39c8e',
            borderColor: '#f39c8e',
            borderWidth: 1,
            pointBackgroundColor: '#607bd7'
          }
		]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: true,
          },
          title: {
			display: true,
            text: "Entrada X Saídas",
          }
        }
      });
 

      var ctx = document.getElementById("myChart2");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Janeiro", "Fervereiro", "Março", "Abril", "Maio", "Junho", "Julho"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 43489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#E34B7A',
            borderWidth: 4,
            pointBackgroundColor: '#E34B7A'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });