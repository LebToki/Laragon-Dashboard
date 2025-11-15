    // =========================== Default Line Chart Start ===============================
    var options = {
        series: [{
            name: "This month",
            data: [0, 48, 20, 24, 6, 33, 30, 48, 35, 18, 20, 5]
        }],
        chart: {
            height: 264,
            type: 'line',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            colors: ['#487FFF'],
            width: 4
        },
        markers: {
            size: 0,
            strokeWidth: 3,
            hover: {
                size: 8
            }
        },
        tooltip: {
            enabled: true,
            x: {
                show: true,
            },
            y: {
                show: false,
            },
            z: {
                show: false,
            }
        },
        grid: {
            row: {
                colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
            borderColor: '#D1D5DB',
            strokeDashArray: 3,
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return "$" + value + "k";
                },
                style: {
                    fontSize: "14px"
                }
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            tooltip: {
                enabled: false
            },
            labels: {
                formatter: function (value) {
                    return value;
                },
                style: {
                    fontSize: "14px"
                }
            },
            axisBorder: {
                show: false
            },
            // crosshairs: {
            //     show: true,
            //     width: 20,
            //     stroke: {
            //         width: 0
            //     },
            //     fill: {
            //         type: 'solid',
            //         color: '#487FFF40',
            //         // gradient: {
            //         //   colorFrom: '#D8E3F0',
            //         //   // colorTo: '#BED1E6',
            //         //   stops: [0, 100],
            //         //   opacityFrom: 0.4,
            //         //   opacityTo: 0.5,
            //         // },
            //     }
            // }
        }
    };

    var chart = new ApexCharts(document.querySelector("#defaultLineChart"), options);
    chart.render();
  // =========================== Default Line Chart End ===============================

  // =========================== Zoom able Line Chart End ===============================
  function createChartTwo(chartId, chartColor) {
    
    var options = {
      series: [
          {
            name: 'This Day',
            data: [12, 18, 12, 48, 18, 30, 18, 15, 88, 40, 65, 24, 48],
          },
      ],
      chart: {
          type: 'area',
          width: '100%',
          height: 264,
          sparkline: {
            enabled: false // Remove whitespace
          },
          toolbar: {
              show: false
          },
          padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
          }
      },
      dataLabels: {
          enabled: false
      },
      stroke: {
          curve: 'straight',
          width: 4,
          colors: [chartColor],
          lineCap: 'round'
      },
      grid: {
          show: true,
          borderColor: '#D1D5DB',
          strokeDashArray: 3,
          position: 'back',
          xaxis: {
              lines: {
                  show: false
              }
          },   
          yaxis: {
              lines: {
                  show: true
              }
          },  
          row: {
              colors: undefined,
              opacity: 0.5
          },  
          column: {
              colors: undefined,
              opacity: 0.5
          },  
          padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
          },  
      },
      fill: {
          type: 'gradient',
          colors: [chartColor], // Set the starting color (top color) here
          gradient: {
              shade: 'light', // Gradient shading type
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: [`${chartColor}00`], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: .6, // Starting opacity
              opacityTo: 0.3,  // Ending opacity
              stops: [0, 100],
          },
      },
      // Customize the circle marker color on hover
      markers: {
        colors: [chartColor],
        strokeWidth: 3,
        size: 0,
        hover: {
          size: 10
        }
      },
        xaxis: {
            labels: {
                show: false
            },
            categories: [`Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`],
            tooltip: {
                enabled: false,
            },
            tooltip: {
                enabled: false
            },
            labels: {
                formatter: function (value) {
                return value;
                },
                style: {
                fontSize: "14px"
                }
            },
        },
        yaxis: {
                labels: {
                    formatter: function (value) {
                    return "$" + value + "k";
                    },
                    style: {
                    fontSize: "14px"
                    }
                },
        },
      tooltip: {
          x: {
              format: 'dd/MM/yy HH:mm'
          },
      },
    };

    var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
    chart.render();
  }
  createChartTwo('zoomAbleLineChart', '#487fff');
  // =========================== Zoom able Line Chart End ===============================

  // =========================== Line Chart With Data labels Start ===============================
    var options = {
          series: [{
            name: "Desktops",
            data: [5, 25, 35, 15, 21, 15, 35, 35, 51]
        }],
        chart: {
            height: 264,
            type: 'line',
            colors: '#000',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            },
        },
        colors: ['#487FFF'],  // Set the color of the series
        dataLabels: {
          enabled: true
        },
        stroke: {
          curve: 'straight',
          width: 4,
          color: "#000"
        },
        markers: {
            size: 0,
            strokeWidth: 3,
            hover: {
                size: 8
            }
        },
        grid: {
            show: true,
            borderColor: '#D1D5DB',
            strokeDashArray: 3,
          row: {
            colors: ['#f3f3f3', 'transparent'],
            opacity: 0,
          },
        },
        // Customize the circle marker color on hover
        markers: {
            colors: '#487FFF',
            strokeWidth: 3,
            size: 0,
            hover: {
                size: 10
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            lines: {
                show: false
            }
        },
        yaxis: {
                labels: {
                    formatter: function (value) {
                        return "$" + value + "k";
                    },
                    style: {
                        fontSize: "14px"
                    }
                },
        },
    };

    var chart = new ApexCharts(document.querySelector("#lineDataLabel"), options);
    chart.render();
  // =========================== Line Chart With Data labels End ===============================

  // =========================== Double Line Chart Start ===============================
  function createLineChart(chartId, chartColor) {
    var options = {
      series: [
          {
            name: 'This Day',
            data: [8, 15, 9, 20, 10, 33, 13, 22, 8, 17, 10, 15],
          },
          {
            name: 'Example',
                data: [8, 24, 18, 40, 18, 48, 22, 38, 18, 30, 20, 28],
            },
      ],
      chart: {
          type: 'line',
          width: '100%',
          height: 264,
          sparkline: {
            enabled: false // Remove whitespace
          },
          toolbar: {
              show: false
          },
          padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
          }
      },
      colors: ['#487FFF', '#FF9F29'],  // Set the color of the series
      dataLabels: {
          enabled: false
      },
      stroke: {
          curve: 'smooth',
          width: 4,
          colors: ["#FF9F29", chartColor],
          lineCap: 'round',
      },
      grid: {
          show: true,
          borderColor: '#D1D5DB',
          strokeDashArray: 3,
          position: 'back',
          xaxis: {
              lines: {
                  show: false
              }
          },   
          yaxis: {
              lines: {
                  show: true
              }
          },  
          row: {
              colors: undefined,
              opacity: 0.5
          },  
          column: {
              colors: undefined,
              opacity: 0.5
          },  
          padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0
          },  
      },
      // Customize the circle marker color on hover
      markers: {
        colors: ["#FF9F29", chartColor],
        strokeWidth: 3,
        size: 0,
        hover: {
          size: 10
        }
      },
        xaxis: {
            labels: {
                show: false
            },
            categories: [`Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`],
            tooltip: {
                enabled: false,        
            },
            labels: {
                formatter: function (value) {
                    return value;
                },
                style: {
                    fontSize: "14px"
                }
            },
        },
        yaxis: {
                labels: {
                    formatter: function (value) {
                        return "$" + value + "k";
                    },
                    style: {
                        fontSize: "14px"
                    }
                },
        },
        tooltip: {
          x: {
              format: 'dd/MM/yy HH:mm'
          },
        },
        legend: {
            show: false
        }
    };

    var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
    chart.render();
  }
  createLineChart('doubleLineChart', '#487fff');
  // =========================== Double Line Chart End ===============================

  
  // =========================== Step Line Chart Start ===============================
    var options = {
        series: [{
          data: [16, 25, 38, 50, 32, 20, 42, 18, 4, 25, 12, 12],
          name: "Example",
        }],
        chart: {
          type: 'line',
          height: 270,
          toolbar: {
              show: false
          },
        },
        stroke: {
          curve: 'stepline',
        },
        colors: ['#487FFF'],  // Set the color of the series
        dataLabels: {
          enabled: false
        },
        markers: {
          hover: {
            sizeOffset: 4
          }
        },
        grid: {
          show: true,
          borderColor: '#D1D5DB',
          strokeDashArray: 3,
          position: 'back',
        },
        xaxis: {
            labels: {
                show: false
            },
            categories: [`Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`],
            tooltip: {
                enabled: false,        
            },
            labels: {
                formatter: function (value) {
                    return value;
                },
                style: {
                    fontSize: "14px"
                }
            },
        },
        yaxis: {
                labels: {
                    formatter: function (value) {
                        return "$" + value + "k";
                    },
                    style: {
                        fontSize: "14px"
                    }
                },
        },
    };

    var chart = new ApexCharts(document.querySelector("#stepLineChart"), options);
    chart.render();
  // =========================== Step Line Chart End ===============================

    // =========================== Gradient Line Chart Start ===============================
    var options = {
        series: [{
            name: "This month",
            data: [12, 6, 22, 18, 38, 16, 40, 8, 35, 18, 35, 22, 50]
        }],
        chart: {
            height: 264,
            type: 'line',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            colors: ['#FF9F29'], // Specify the line color here
            width: 4
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            gradientToColors: [ '#0E53F4'],
            shadeIntensity: 1,
            type: 'horizontal',
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
          },
        },
        markers: {
            size: 0,
            strokeWidth: 3,
            hover: {
                size: 8
            }
        },
        tooltip: {
            enabled: true,
            x: {
                show: true,
            },
            y: {
                show: false,
            },
            z: {
                show: false,
            }
        },
        grid: {
            row: {
                colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
            borderColor: '#D1D5DB',
            strokeDashArray: 3,
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                return "$" + value + "k";
                },
                style: {
                fontSize: "14px"
                }
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            tooltip: {
                enabled: false
            },
            labels: {
                formatter: function (value) {
                return value;
                },
                style: {
                    fontSize: "14px"
                }
            },
            axisBorder: {
                show: false
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#gradientLineChart"), options);
    chart.render();
  // =========================== Gradient Line Chart End ===============================

