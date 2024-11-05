"use strict";

var ctx = document.getElementById("humidityChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    datasets: [{
      label: 'Statistics',
      data: [50, 67, 90, 100, 78, 98, 79],
      borderWidth: 2,
      backgroundColor: '#BFFA01',
      borderColor: '#BFFA01',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#cccccc', // Warna gridlines
          lineWidth: 1.5,   // Ketebalan gridlines
          borderDash: [5, 5] // Membuat garis putus-putus dengan pola 5 pixel
        },
        ticks: {
          beginAtZero: true,
          stepSize: 100
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#e0e0e0', // Warna gridlines di sumbu x
          lineWidth: 1.5,   // Ketebalan gridlines di sumbu x
          borderDash: [5, 5], // Membuat garis putus-putus
          display: true
        },
        ticks: {
          display: true
        }
      }]
    }
  }
});


var ctx = document.getElementById("temperatureChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    datasets: [{
      label: 'Statistics',
      data: [30, 34, 28, 25, 32, 31, 21],
      borderWidth: 2,
      backgroundColor: '#BFFA01',
      borderColor: '#BFFA01',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#cccccc', // Warna gridlines
          lineWidth: 1.5,   // Ketebalan gridlines
          borderDash: [5, 5] // Membuat garis putus-putus dengan pola 5 pixel
        },
        ticks: {
          beginAtZero: true,
          stepSize: 100
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#e0e0e0', // Warna gridlines di sumbu x
          lineWidth: 1.5,   // Ketebalan gridlines di sumbu x
          borderDash: [5, 5], // Membuat garis putus-putus
          display: true
        },
        ticks: {
          display: true
        }
      }]
    }
  }
});
