var { Chart } = require('chart.js');

/*
 * This class is used to generate charts for the entire application.
 * All data should be normalized before using the class's functions
 * Refer to http://www.chartjs.org/docs/latest/ for documentation
*/
class ChartBuilder {

    /**
    * Function that takes 2 players 'casual' data and creates a 'radar' chart
    * @param {Array} data - has 3 inner arrays. (Player1 data, Player2 data, Player names)  
    * @param {Array} labels - names of the labels being used on the chart
    * @return {void}
    */
    buildPlayerCompareCasual(data, labels)
    {
        var canvas = document.getElementById("casualCompareCanvas");
        var ctx = canvas.getContext("2d");

        var dat = {
            labels: labels,
            datasets: [
                {
                    label: data[2][0],
                    backgroundColor: "rgba(200,0,0,0.2)",
                    data: data[0]
                },
                {
                    label: data[2][1],
                    backgroundColor: "rgba(0,200,0,0.2)",
                    data: data[1]
                }
            ]
        };

        var options = 
        {
            scale: {
                ticks: {
                   display: false
                }
             }
        };

        var myNewChart = new Chart(ctx , {
            type: "radar",
            data: dat,
            options: options
        });
    }

    /**
    * Function that takes 2 players 'ranked' data and creates a 'radar' chart
    * @param {Array} data - has 3 inner arrays. (Player1 data, Player2 data, Player names)  
    * @param {Array} labels - names of the labels being used on the chart
    * @return {void}
    */
    buildPlayerCompareRanked(data, labels)
    {
        var canvas = document.getElementById("rankedCompareCanvas");
        var ctx = canvas.getContext("2d");

        var dat = {
            labels: labels,
            datasets: [
                {
                    label: data[2][0],
                    backgroundColor: "rgba(200,0,0,0.2)",
                    data: data[0]
                },
                {
                    label: data[2][1],
                    backgroundColor: "rgba(0,200,0,0.2)",
                    data: data[1]
                }
            ]
        };

        var options = 
        {
            scale: {
                ticks: {
                   display: false
                }
             }
        };

        var myNewChart = new Chart(ctx , {
            type: "radar",
            data: dat,
            options: options
        });
    }

}

window.ChartBuilder = ChartBuilder;