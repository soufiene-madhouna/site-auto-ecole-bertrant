(function($) {
	'use strict';
	$.datepick.regionalOptions.fr = {
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
		'Jul','Aoû','Sep','Oct','Nov','Déc'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		dateFormat: 'dd/mm/yyyy',
		firstDay: 1,
		renderer: $.datepick.defaultRenderer,
		prevText: '&#x3c;Préc',
		prevStatus: 'Voir le mois précédent',
		prevJumpText: '&#x3c;&#x3c;',
		prevJumpStatus: 'Voir l\'année précédent',
		nextText: 'Suiv&#x3e;',
		nextStatus: 'Voir le mois suivant',
		nextJumpText: '&#x3e;&#x3e;',
		nextJumpStatus: 'Voir l\'année suivant',
		currentText: 'Courant',
		currentStatus: 'Voir le mois courant',
		todayText: 'Aujourd\'hui',
		todayStatus: 'Voir aujourd\'hui',
		clearText: 'Effacer',
		clearStatus: 'Effacer la date sélectionnée',
		closeText: 'Fermer',
		closeStatus: 'Fermer sans modifier',
		yearStatus: 'Voir une autre année',
		monthStatus: 'Voir un autre mois',
		weekText: 'Sm',
		weekStatus: 'Semaine de l\'année',
		dayStatus: '\'Choisir\' le DD d MM',
		defaultStatus: 'Choisir la date',
		isRTL: false
	};
	$.datepick.setDefaults($.datepick.regionalOptions.fr);
})(jQuery);

$(".datepicker").datepick({dateFormat: 'dd-mm-yyyy'});


$('.btnAction').click(function(){
 //var res= $(this).attr("href");
 var id= $(this).attr("value");
// var url= Routing.generate("modification_transporteur_voyage_f', { idTV: id }");
 var url1 = Routing.generate('modification_transporteur_voyage_f', {
    'idTV': id
});
    $.ajax({
       url : url1,
	   type: "post",
	   data: { voyage : id },
	   dataType: "json",	   
       success : function(data){ 
			alert("data");
       },

       });



});


  $(".loading").hide();
	  $("#form_recherche").submit(function(){
	     $(".loading").show();
		 var motrech = $("#acteurrecherche_motrech").val();
		 var DATA = 'motrech=' +motrech;
		 $.ajax({
		    type: "POST",
			url: url1,
			data: DATA,
			cache: false,
			success: function(data){
			   $('#resultats_recherche').html(data);
			   $(".loading").hide();
			}
	     });
		 return false;
	});

/*
fullcalendar javascript event	
*/
	jQuery('#calendar-holder').fullCalendar({
		header: {
		    left: 'pv, next',
		    center: 'title',
		    right: 'month, agendaWeek, agendaDay'
		},
		timezone: ('Europe/London'),
		businessHours: {
		    start: '09:00',
		    end: '17:30',
		    dow: [1, 2, 3, 4, 5]
		},
		allDaySlot: false,
		defaultView: 'agendaWeek',
		lazyFetching: true,
		firstDay: 1,
		selectable: true,
		timeFormat: {
		    agenda: 'h:mmt',
		    '': 'h:mmt'
		},
		columnFormat:{
		    month: 'ddd',
		    week: 'ddd D/M',
		    day: 'dddd'
		},
		editable: true,
		eventDurationEditable: true,
		eventSources: [
		{
			url: /full-calendar/load,
			type: 'POST',
			data: {
				filters: { param: foo }
			}
			error: function() {
			   //alert()
			}
		}
]
});



//fc-mon fc-other-month fc-future