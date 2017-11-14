var chartDisc = {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Disciplina'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Disciplina',
        colorByPoint: true,
        data: []
    }]
}
	$.ajax({
		url:'php/lista_maestra/grafica_disciplina.php',
		method:'post',
		dataType:'json',
		success:function(response){
			$.each(response,function(i,item){
				chartDisc.series[0].data.push(response[i]);
			});
			Highcharts.chart('grafica', chartDisc);
		},
		error:function(response){

		}
	});
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/

var chartFase = {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Disciplina'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Disciplina',
        colorByPoint: true,
        data: []
    }]
}
$.ajax({
    url:'php/lista_maestra/grafica_fase.php',
    method:'post',
    dataType:'json',
    success:function(response){
        $.each(response,function(i,item){
            chartFase.series[0].data.push(response[i]);
        });
        Highcharts.chart('gf', chartFase);
    },
    error:function(response){

    }
});