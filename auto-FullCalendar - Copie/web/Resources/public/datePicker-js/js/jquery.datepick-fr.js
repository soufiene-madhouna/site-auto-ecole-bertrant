/* http://keith-wood.name/datepick.html
   French localisation for jQuery Datepicker.
   Stأphane Nahmani (sholby@sholby.net). */
(function($) {
	'use strict';
	$.datepick.regionalOptions.fr = {
		monthNames: ['Janvier','Fأvrier','Mars','Avril','Mai','Juin',
		'Juillet','Aoأ؛t','Septembre','Octobre','Novembre','Dأcembre'],
		monthNamesShort: ['Jan','Fأv','Mar','Avr','Mai','Jun',
		'Jul','Aoأ؛','Sep','Oct','Nov','Dأc'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		dateFormat: 'dd/mm/yyyy',
		firstDay: 1,
		renderer: $.datepick.defaultRenderer,
		prevText: '&#x3c;Prأc',
		prevStatus: 'Voir le mois prأcأdent',
		prevJumpText: '&#x3c;&#x3c;',
		prevJumpStatus: 'Voir l\'annأe prأcأdent',
		nextText: 'Suiv&#x3e;',
		nextStatus: 'Voir le mois suivant',
		nextJumpText: '&#x3e;&#x3e;',
		nextJumpStatus: 'Voir l\'annأe suivant',
		currentText: 'Courant',
		currentStatus: 'Voir le mois courant',
		todayText: 'Aujourd\'hui',
		todayStatus: 'Voir aujourd\'hui',
		clearText: 'Effacer',
		clearStatus: 'Effacer la date sأlectionnأe',
		closeText: 'Fermer',
		closeStatus: 'Fermer sans modifier',
		yearStatus: 'Voir une autre annأe',
		monthStatus: 'Voir un autre mois',
		weekText: 'Sm',
		weekStatus: 'Semaine de l\'annأe',
		dayStatus: '\'Choisir\' le DD d MM',
		defaultStatus: 'Choisir la date',
		isRTL: false
	};
	$.datepick.setDefaults($.datepick.regionalOptions.fr);
})(jQuery);
