    // ================================ Bars Up Down (Earning Statistics) chart Start ================================ 
    var options = {
      series: [
          {
              name: "Income",
              data: [44, 42, 57, 86, 58, 55, 70, 44, 42, 57, 86, 58, 55, 70],
          },
          {
              name: "Expenses",
              data: [-34, -22, -37, -56, -21, -35, -60, -34, -22, -37, -56, -21, -35, -60],
          },
      ],
      chart: {
          stacked: true,
          type: "bar",
          height: 263,
          fontFamily: "Poppins, sans-serif",
          toolbar: { 
              show: false,
          },
      }, 
      colors: ["#487FFF", "#EF4A00"],
      plotOptions: {
          bar: {
              columnWidth: "8",
              borderRadius: [2],
              borderRadiusWhenStacked: "all",
          },
      },
      stroke: {
          width: [5, 5]
      },
      dataLabels: {
          enabled: false,
      },
      legend: {
          show: true,
          position: "top",
      },
      yaxis: {
          show: false,
          title: {
              text: undefined,
          },
          labels: {
              formatter: function (y)
              {
                  return y.toFixed(0) + "";
              },
          },
      },
      xaxis: {
          show: false,
          categories: [
              "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", 
              "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"
          ],
          axisBorder: {
              show: false,
          },
          axisTicks: {
              show: false,
          },
          labels: {
              show: true,
              style: {
                  colors: "#d4d7d9",
                  fontSize: "10px",
                  fontWeight: 500,
              },
          },
      },
      tooltip: {
          enabled: true,
          shared: true,
          intersect: false,
          theme: "dark",
          x: {
              show: false,
          },
      },
  };
  var chart = new ApexCharts(document.querySelector("#upDownBarchart"), options);
  chart.render();
    // ================================ Bars Up Down (Earning Statistics) chart End ================================ 
    
    // ================================ Semi Circle Gauge (Daily Conversion) chart Start ================================ 
    var options = {
        series: [75],
        chart: {
            width: 200,
            type: 'radialBar',
            sparkline: {
                enabled: true // Remove whitespace
            },
            toolbar: {
                show: false
            },
        },
        plotOptions: {
            radialBar: {
                offsetY: -24,
                offsetX: -14,
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: "#E3E6E9",
                    // strokeWidth: 32,
                    dropShadow: {
                        enabled: false,
                        top: 2,
                        left: 0,
                        color: '#999',
                        opacity: 1,
                        blur: 2
                    }
                },
                dataLabels: {
                    show: false,
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                        fontSize: '22px'
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            colors: ['#9DBAFF'], 
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['#487FFF'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            lineCap: 'round',
        },
        labels: ['Percent'],
    };

    var chart = new ApexCharts(document.querySelector("#semiCircleGauge"), options);
    chart.render();
    // ================================ Semi Circle Gauge (Daily Conversion) chart End ================================ 

    // ================================ Area chart Start ================================ 
    function createChart(chartId, chartColor) {

        let currentYear = new Date().getFullYear();

        var options = {
        series: [
            {
                name: 'series1',
                data: [0, 10, 8, 25, 15, 26, 13, 35, 15, 39, 16, 46, 42],
            },
        ],
        chart: {
            type: 'area',
            width: 164,
            height: 72,

            sparkline: {
                enabled: true // Remove whitespace
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
            curve: 'smooth',
            width: 2,
            colors: [chartColor],
            lineCap: 'round'
        },
        grid: {
            show: true,
            borderColor: 'transparent',
            strokeDashArray: 0,
            position: 'back',
            xaxis: {
                lines: {
                    show: false
                }
            },   
            yaxis: {
                lines: {
                    show: false
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
                top: -3,
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
                opacityFrom: .8, // Starting opacity
                opacityTo: 0.3,  // Ending opacity
                stops: [0, 100],
            },
        },
        // Customize the circle marker color on hover
        markers: {
            colors: [chartColor],
            strokeWidth: 2,
            size: 0,
            hover: {
            size: 8
            }
        },
        xaxis: {
            labels: {
                show: false
            },
            categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`, `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`],
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            labels: {
                show: false
            }
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

    // Call the function for each chart with the desired ID and color
    createChart('areaChart', '#FF9F29');
    // ================================ Area chart End ================================ 

    // ================================ Bar chart (Today Income0 Start ================================ 
    var options = {
      series: [{
          name: "Sales",
          data: [{
              x: 'Mon',
              y: 20,
          }, {
              x: 'Tue',
              y: 40,
          }, {
              x: 'Wed',
              y: 20,
          }, {
              x: 'Thur',
              y: 30,
          }, {
              x: 'Fri',
              y: 40,
          }, {
              x: 'Sat',
              y: 35,
          }]
      }],
      chart: {
          type: 'bar',
          width: 164,
          height: 80,
          sparkline: {
            enabled: true // Remove whitespace
          },
          toolbar: {
              show: false
          }
      },
      plotOptions: {
          bar: {
              borderRadius: 6,
              horizontal: false,
              columnWidth: 14,
          }
      },
      dataLabels: {
          enabled: false
      },
    states: {
        hover: {
        filter: {
            type: 'none'
            }
        }
    },
      fill: {
          type: 'gradient',
          colors: ['#E3E6E9'], // Set the starting color (top color) here
          gradient: {
              shade: 'light', // Gradient shading type
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: ['#E3E6E9'], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: 1, // Starting opacity
              opacityTo: 1,  // Ending opacity
              stops: [0, 100],
          },
      },
      grid: {
          show: false,
          borderColor: '#D1D5DB',
          strokeDashArray: 1, // Use a number for dashed style
          position: 'back',
      },
      xaxis: {
            labels: {
                show: false // Hide y-axis labels
            },
            type: 'category',
            categories: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat']
      },
      yaxis: {
          labels: {
            show: false,
              formatter: function (value) {
                  return (value / 1000).toFixed(0) + 'k';
              }
          }
      },
      tooltip: {
          y: {
              formatter: function (value) {
                  return value / 1000 + 'k';
              }
          }
      }
    };

    var chart = new ApexCharts(document.querySelector("#dailyIconBarChart"), options);
    chart.render();
    // ================================ Bar chart (Today Income0 End ================================ 

  // ================================ My Portfolio Donut chart Start ================================ 
    var options = { 
      series: [70, 30],
      colors: ['#FF9F29', '#487FFF'],
      labels: ['Female', 'Male'] ,
      legend: {
          show: false 
      },
      chart: {
        type: 'donut',    
        height: 230,
        sparkline: {
          enabled: true // Remove whitespace
        },
        margin: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        },
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      },
      stroke: {
        width: 0,
      },
      dataLabels: {
        enabled: false
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }],
    };

    var chart = new ApexCharts(document.querySelector("#statisticsDonutChart"), options);
    chart.render();
  // ================================ My Portfolio Donut chart End ================================ 

  // ================================ J Vector Map Start ================================ 
  $('#world-map').vectorMap(
    {
      map: 'world_mill_en',
      backgroundColor: 'transparent',
      borderColor: '#fff',
      borderOpacity: 0.25,
      borderWidth: 0,
      color: '#000000',
      regionStyle : {
          initial : {
          fill : '#D1D5DB'
        }
      },
      markerStyle: {
      initial: {
            r: 5,
            'fill': '#fff',
            'fill-opacity':1,
            'stroke': '#000',
            'stroke-width' : 1,
            'stroke-opacity': 0.4
        },
    },
      markers : [{
          latLng : [35.8617, 104.1954],
          name : 'China : 250'
        },

        {
          latLng : [25.2744, 133.7751],
          name : 'AustrCalia : 250'
        },

        {
          latLng : [36.77, -119.41],
          name : 'USA : 82%'
        },

        {
          latLng : [55.37, -3.41],
          name : 'UK   : 250'
        },

        {
          latLng : [25.20, 55.27],
          name : 'UAE : 250'
      }],

      series: {
          regions: [{
              values: {
                  "US": '#487FFF ',
                  "SA": '#487FFF',
                  "AU": '#487FFF',
                  "CN": '#487FFF',
                  "GB": '#487FFF',
              },
              attribute: 'fill'
          }]
      },
      hoverOpacity: null,
      normalizeFunction: 'linear',
      zoomOnScroll: false,
      scaleColors: ['#000000', '#000000'],
      selectedColor: '#000000',
      selectedRegions: [],
      enableZoom: false,
      hoverColor: '#fff',
    }); 
  // ================================ J Vector Map End ================================ 

  // ================================ Total Transaction line chart Start ================================ 
  var options = {
    series: [{
      name: "This month",
      data: [4, 16, 12, 28, 22, 38, 23]
    }],
    chart: {
      height: 290,
      type: 'line',
      toolbar: {
        show: false
      },
      zoom: {
        enabled: false
      },
      dropShadow: {
        enabled: true,
        top: 6,
        left: 0,
        blur: 4,
        color: "#000",
        opacity: 0.1,
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 3
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
      categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
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
      crosshairs: {
        show: true, 
        width: 20,
        stroke: {
          width: 0
        },
        fill: {
          type: 'solid',
          color: '#B1B9C4',
          gradient: {
              colorFrom: '#D8E3F0',
              colorTo: '#BED1E6',
              stops: [0, 100],
              opacityFrom: 0.4,
              opacityTo: 0.5,
          },
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#transactionLineChart"), options);
  chart.render();
  // ================================ Total Transaction line chart End ================================ 