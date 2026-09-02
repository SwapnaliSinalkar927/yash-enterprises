/*Dashboard Init*/
"use strict";
/*DataTable Init*/
if ($("#datable_1").length > 0) {
	/*Checkbox Add*/
	var tdCnt=0;
	$('table tr').each(function(){
		$('<span class="form-check mb-0"><input type="checkbox" class="form-check-input check-select" id="chk_sel_'+tdCnt+'"><label class="form-check-label" for="chk_sel_'+tdCnt+'"></label></span>').appendTo($(this).find("td:first-child"));
		tdCnt++;
	});
	var targetDt = $('#datable_1').DataTable({
		"dom": '<"row"<"col-7 mb-3"<"contact-toolbar-left">><"col-5 mb-3"<"contact-toolbar-right"f>>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
		"ordering": true,
		"columnDefs": [ {
			"searchable": false,
			"orderable": false,
			"targets": [0,5]
		} ],
		"order": [1, 'asc' ],
		language: { search: "",
			searchPlaceholder: "Search",
			"info": "_START_ - _END_ of _TOTAL_",
			sLengthMenu: "View  _MENU_",
			paginate: {
			  next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
			  previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
			}
		},
		"drawCallback": function () {
			$('.dataTables_paginate > .pagination').addClass('custom-pagination pagination-simple pagination-sm');
		}
	});
	$(document).on( 'click', '.del-button', function () {
		targetDt.rows('.selected').remove().draw( false );
		return false;
	});
	// $("div.contact-toolbar-left").html('<div class="d-xxl-flex d-none align-items-center"><div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example"><button type="button" class="btn btn-outline-light active">View all</button><button type="button" class="btn btn-outline-light">Monitored</button><button type="button" class="btn btn-outline-light">Unmonitored</button></div>');
	$("div.contact-toolbar-right").addClass('d-flex justify-content-end');
	$("#datable_1").parent().addClass('table-responsive');

	/*Select all using checkbox*/
	var  DT1 = $('#datable_1').DataTable();
	$(".check-select-all").on( "click", function(e) {
		$('.check-select').attr('checked', true);
		if ($(this).is( ":checked" )) {
			DT1.rows().select();
			$('.check-select').prop('checked', true);
		} else {
			DT1.rows().deselect();
			$('.check-select').prop('checked', false);
		}
	});
	$(".check-select").on( "click", function(e) {
		if ($(this).is( ":checked" )) {
			$(this).closest('tr').addClass('selected');
		} else {
			$(this).closest('tr').removeClass('selected');
			$('.check-select-all').prop('checked', false);
		}
	});
}

/*Apex Column Chart*/
window.Apex = {
	chart: {
		foreColor: "#646A71",
		fontFamily: 'Inter',
		toolbar: {
			tools: {
				download: '<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>',
				selection: '<img src="/static/icons/reset.png" width="20">',
				zoom: '<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>',
				zoomin: '<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>',
				zoomout: '<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>',
				pan: '<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>',
				reset: '<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
			}
		}
	},
	grid: {
		borderColor: '#F4F5F6',
	},
	xaxis: {
		labels: {
			style: {
				fontSize: '12px',
				fontFamily: 'inherit',
			},
		},
		axisBorder: {
			show: false,
		},
		title: {
			style: {
				fontSize: '12px',
				fontFamily: 'inherit',
			}
		}
	},
	yaxis: {
		labels: {
			style: {
				fontSize: '12px',
				fontFamily: 'inherit',
			},
		},
		title: {
			style: {
				fontSize: '12px',
				fontFamily: 'inherit',
			}
		},
	},
};


/*Multiple Chart*/
/*var options2 = {
	series: [80, 75 , 20 ,40],
	stroke: {
		lineCap: 'round'
	},
	chart: {
		height: 255,
		type: 'radialBar',
	},
	plotOptions: {
		radialBar: {
			hollow: {
				margin: 0,
				size: "40%",
			},
			dataLabels: {
				showOn: "always",
				name: {
					show: false,
				},
				value: {
					fontSize: "1.75rem",
					show: true,
					fontWeight: '500'
				}	,
				total: {
					show: true,
					formatter: function () {
						return [('220')];
					}
				}
			  }
		}
	},
	colors: ['#0069f7', '#c02ff3', '#72ddf7','#ff36ab'],
	labels: ['400 packets Target', '200 packets Target','100 packets Target','40 packets Target'],
};

var chart2 = new ApexCharts(document.querySelector("#radial_chart_2"), options2);
chart2.render();*/

/*Animated Map*/
/*am4core.ready(function() {

	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end

	// Create map instance
	var chart2 = am4core.create("anim_map_2", am4maps.MapChart);

    // var chart = am4core.create("chartdiv", am4maps.MapChart);
        chart2.homeZoomLevel = 5.6;
        chart2.homeGeoPoint = {
        latitude: 23,
        longitude: 83
        };

	// Set map definition
	chart2.geodata = am4geodata_worldIndiaLow;

	// Set projection
	chart2.projection = new am4maps.projections.Miller();

	// Create map polygon series
	var polygonSeries = chart2.series.push(new am4maps.MapPolygonSeries());
	polygonSeries.mapPolygons.template.fill = am4core.color("#E6E9EB");
	polygonSeries.mapPolygons.template.fillOpacity = 1;
	// Exclude Antartica
	polygonSeries.exclude = ["AQ"];

	// Make map load polygon (like country names) data from GeoJSON
	polygonSeries.useGeodata = true;

	// Configure series
	var polygonTemplate = polygonSeries.mapPolygons.template;
	polygonTemplate.tooltipText = "{name}";


	// Create hover state and set alternative fill color
	var hs = polygonTemplate.states.create("hover");
	hs.properties.fill = am4core.color("#CCE5E7");

	// Add image series
	var imageSeries = chart2.series.push(new am4maps.MapImageSeries());
	imageSeries.mapImages.template.propertyFields.longitude = "longitude";
	imageSeries.mapImages.template.propertyFields.latitude = "latitude";
	imageSeries.mapImages.template.tooltipText = "{title}";
	imageSeries.mapImages.template.propertyFields.url = "url";

	var circle = imageSeries.mapImages.template.createChild(am4core.Circle);
	circle.radius = 0.5;
	circle.propertyFields.fill = "color";

	var circle2 = imageSeries.mapImages.template.createChild(am4core.Circle);
	circle2.radius = 3;
	circle2.propertyFields.fill = "color";


	circle2.events.on("inited", function(event){
	  animateBullet(event.target);
	})


	function animateBullet(circle) {
		var animation = circle.animate([{ property: "scale", from: 0.2, to: 0.8 }, { property: "opacity", from: 1, to: 0 }], 1000, am4core.ease.circleOut);
		animation.events.on("animationended", function(event){
		  animateBullet(event.target.object);
		})
	}

	var colorSet = new am4core.ColorSet();

	imageSeries.data = [
    {
	  "title": "Pondicherry",
	  "latitude": 11.9160,
	  "longitude": 79.8123,
	   "color":'#0069f7'
	}, {
	  "title": "Andhra Pradesh",
	  "latitude": 15.9129,
	  "longitude": 79.7400,
	  "url": "http://www.google.co.jp",
	  "color":'#0069f7'
	}, {
	  "title": "Tamil Nadu",
	  "latitude": 11.1271,
	  "longitude": 78.6569,
	   "color":'#0069f7'
	}, {
	  "title": "Karnataka",
	  "latitude": 15.3173,
	  "longitude": 75.7139,
	   "color":'#0069f7'
	}, {
	  "title": "Kerala",
	  "latitude": 10.1632,
	  "longitude": 76.6413,
	   "color":'#0069f7'
	}, ];



	}); // end am4core.ready()*/
