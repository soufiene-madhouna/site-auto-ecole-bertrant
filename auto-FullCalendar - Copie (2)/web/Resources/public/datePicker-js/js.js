	//sidebar
 
function htmlbodyHeightUpdate(){
		var height3 = $( window ).height()
		var height1 = $('.nav').height()+50
		height2 = $('.main').height()
		if(height2 > height3){
			$('html').height(Math.max(height1,height3,height2)+10);
			$('body').height(Math.max(height1,height3,height2)+10);
		}
		else
		{
			$('html').height(Math.max(height1,height3,height2));
			$('body').height(Math.max(height1,height3,height2));
		}
		
	}
	$(document).ready(function () {
		htmlbodyHeightUpdate()
		$( window ).resize(function() {
			htmlbodyHeightUpdate()
		});
		$( window ).scroll(function() {
			height2 = $('.main').height()
  			htmlbodyHeightUpdate()
		});
	});
	
	//sidebar

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
// form start end of full calendar with datepicker bootstrap 
	
jQuery( document ).ready( function() {
$('#sideF').css('postion','fixed');	
function editionE(id)
{
	var id;
	 var url=Routing.generate('rendez_vous_edition', {
		    'edRdv': id
	 });
	  window.location.href= url;
}
function ajax(url,start,obj) {
	var stateObj = { foo: "bar" };
	//history.pushState(url, "start", "Event?start="+start);
    var url=Routing.generate('Event_creation',{
    	start
    });
    //window.location.href= url;
var i=0;
	//alert('event is clicked with start');
	 //alert(start);
	//alert(obj.length);
	for (var i = 0; i < obj.length; i++) {
		//alert(obj[i].date);
		 var arrayD= obj[i].date.split("-");
		   var startD= arrayD[2]+'/'+arrayD[1]+'/'+arrayD[0];
		   startD=startD.toString();
		  // alert(startD +'string');
		//alert(startD==start);

		if(startD==start){
			//alert("oui");
			$('#checkF').hide();
			$('#messageF').text(obj[i].descritpion);
		}
	  }
	
	    $.ajax({
	        type: 'POST',
	        url: url,//'/sousou',
	        dataType: "json",
	        //data:{start},//data: $(this).serialize(start),
	        success: function(json) {
				//alert('OK'); // le message s'affiche 
				 var myJSON = JSON.stringify(json);
				  var obj = JSON.parse(myJSON);
				  //alert(start);
					var nn = $.fullCalendar.moment(start,'DD/MM/YYYY').format('L');
				      //nn= new Date(nn);
				      var ts= nn.getTime();
					  for(var k in obj){

						alert(obj.k.date);
					  }
					 },
	        error : function(response){
	            console.log('Something went wrong.');
	        },
	        cache: true
	    });
    //pushState(start, url);
   // $('#formEventCustomC').modal('show');

	//var re=document.history.pushState("string", "Title", url);
	    //return history.pushState(url, "start", "Event?start="+start);
	}
	

	
		var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var day=date.toLocaleDateString();
 var calendar=jQuery('#calendar-holder').fullCalendar({
		header: {
		    left: 'prev, next',
		    center: 'title',
		    right: 'month, agendaWeek,listWeek'
		},
		timezone: ('Europe/London'),
		businessHours: {
		    start: '08:00',
		    end: '19:00',
		    dow: [1, 2, 3, 4, 5,6]
		},
        allDaySlot: false,
        displayEventTime: true,
		allDayDefault:false,
		defaultView: 'month',
		lazyFetching: true,
		firstDay: 1,
		selectable: true,
		nowIndicator:true,
		lang:'fr',
		timeFormat: 'H:mm',
				
		 views: {
			month: { // name of view
            columnFormat: 'dddd'
            // other view-specific options here
			},
			week: { // name of view
            titleFormat: 'ddd D/M'
            // other view-specific options here
			},
			day: { // name of view
            titleFormat: 'dddd'
            // other view-specific options here
			},
		},
		editable: true,
		
		eventDurationEditable: true,
		select: function(start, end, allDay,jsEvent ) { 
			var temps = $.fullCalendar.moment(start,'DD/MM/YYYY').format('L');
			var dayEv   = $.fullCalendar.moment(start,'DD/MM/YYYY').format('E');
			var currD= new Date();

			
			if(dayEv==7 || start< currD){
		        $('#formEventCustomC').modal('hide');

			}else{
		        $('#formEventCustomC').modal('show');

			}
//			ajax(url,temps);
			//injectQsComponent(url,start);
//		    history.pushState(temps,url);
			
			$('#messageF').text("");

			//< par click dans le calendrier 
			  // var title = prompt ("Titre de l'évènement :");
				$().modal()
				 //if (title) {
			      //alert(start);

		       var Estart = $.fullCalendar.moment(start).format('DD/MM/YYYY HH:mm:ss');
				var Eend = $.fullCalendar.moment(end).format('DD/MM/YYYY HH:mm:ss');
		        $(".datetimepicker").attr('placeholder',Estart);
		        $(".datetimepicker1").attr('placeholder',Eend);
		        $(".datetimepicker").val(Estart);
		        $(".datetimepicker1").val(end);
		        
		        //$.post( Routing.generate('Event_creation'), { name: "John", time: "2pm","start":start } );
		       
		        /*
		         * verification de validité d'une date 
		         */
		        
		        $.ajax({
					type: "POST",
					url: Routing.generate('date_repos_load'),
					data: 'date_check'+ start  , // données à envoyer
					success: function(json) {
						//alert('OK'); // le message s'affiche 
						 var myJSON = JSON.stringify(json);
						  var obj = JSON.parse(myJSON);
						  //alert(start);
							ajax(url,temps,obj);
							
							var nn = $.fullCalendar.moment(start,'DD/MM/YYYY').format('L');
						      //nn= new Date(nn);
						      var ts= nn.getTime();
						      

							
					}
					});
		        
		        
				$('#checkF').show();

				//prompt(start);
				// ici toutes les valeurs sont bonnes, title existe 
		        var url=Routing.generate('Event_creation');
		        //alert(url);
		        

		        
		       
				calendar.fullCalendar('renderEvent',
				 {
				   title: title, // toutes ces valeurs sont bonnes et affichent 
				   start: start, // correctement l'évènement dans le calendrier 
				   end: end,     // donc elles sont au bon format pour Fullcalendar
				   allDay: allDay
				 },
				true // make the event "stick"
				);
				//}
				 calendar.fullCalendar('unselect');
				},				
				events: function(start, end, timezone, callback) {
						jQuery.ajax({
							url: Routing.generate('Event_load'),
							type: 'POST',
							dataType: 'json',
							
							success: function (doc) {
								  //alert("Success");
								  var events = [];
								  //var objs= [];
								  
								  var myJSON = JSON.stringify(doc);
								  var obj = JSON.parse(myJSON);
								  //alert(obj);
									$.each(obj, function(j, objs) {

								  //for(var i=0;i<obj.length;i++){
								  //var objs= obj.title;
								  //alert(objs.title);
											  
										var startD= $.fullCalendar.moment(objs.startDate,'YYYY-MM-DD').format('L');
											var Dt= $.fullCalendar.moment.parseZone(objs.startDate,'YYYY-MM-DD H:mm').format('LT');
												Dt= Dt.toString();
											     // alert(startD);

										      startD=startD.toString();
											   var arrayD= startD.split("/");
											    startD= arrayD[2]+'/'+arrayD[1]+'/'+arrayD[0];
											    
										      //alert(startD);
										     // alert(Dt);

										   var endD =  $.fullCalendar.moment(objs.endDate,'YYYY-MM-DD').format('L');
										   var endDt =  $.fullCalendar.moment.parseZone(objs.endDate,'YYYY-MM-DD H:mm').format('LTS');
										   //endD= endD.toString();

										   endDt=endDt.toString()
										    var arrayE= endD.split("/");
											    //alert(arrayE[1]);
											    endD= arrayE[2]+'/'+arrayE[1]+'/'+arrayE[0];
											 //alert(endD);
										     //alert(endDt);
										   /*if (objs.allDay== false) 
											   {
											   alert(objs.allDay);
											   objs.allDay=llDay=objs.allDay.toString();
											   }else{objs.allDay=objs.allDay.toString();}
										    */
											  events.push({
						                          title: objs.title.toString()+" "+objs.nom,  //your calevent object has identical parameters 'title', 'start', ect, so this will work
						                          start: startD+" "+Dt || Dt,//"2017-05-04 18:20" start.dateTime || objs.startDate.start.date, // will be parsed into DateTime object
						                          intervalStart: Dt,
						                          intervalEnd: endDt,
						                          end: endD+" "+endDt || endDt,//|| objs.endDate.date,
						                          id: objs.id.toString() ,
						                          filters: objs.filters,
						                          event:objs.event,
					                        	  url: objs.event,
					                        	  className: objs.className,
					                        	  editable: objs.editable,
					                        	  startEditable: objs.startEditable,
					                        	  durationEditable: objs.durationEditable,
					                        	  rendering: objs.rendering,
					                        	  overlap: objs.overlap,
					                        	  constraint: objs.constraint,
					                        	  source: objs.source,
					                        	  color: objs.color,
					                        	  backgroundColor: objs.backgroundColor,
					                        	  textColor: objs.textColor,
					                        	  allDay: objs.allDay
						                      });
								  });
								
								  callback(events);
							},
							 error: function() {
					                alert('there was an error while fetching events!');
					            },
						
						});
					},
					eventClick: function(event, element) {
						
				        event.title = "CLICKED!";
				        var id=event.id;

				        if(event.id){
					        //$('#formEventCustomE').modal('show');
				        	//editionE(id);
				        	 var url = "{{ path('rendez_vous_edition', {'id': id}) }}"; 
				        	    //url = url.replace("rendez_vous_edition", "id");
				        	    window.location.href = myVar+'/'+id ;
						 }
				        //jQuery('#formEventCustomC').show();
				        $('#calendar').fullCalendar('updateEvent', event);

				    },
					
				    	
				    	
					
 });
//#formEventCustomC  
 
 
 $('#calendar-holder').fullCalendar('today').addClass('.fc-today-green');
 
 function convertTime24to12(time24){
	 var tmpArr = time24.split(':'), time12;
	 if(+tmpArr[0] == 12) {
	 time12 = tmpArr[0] + ':' + tmpArr[1] ;
	 } else {
	 if(+tmpArr[0] == 00) {
	 time12 = '12:' + tmpArr[1] + ' am';
	 } else {
	 if(+tmpArr[0] > 12) {
	 time12 = (+tmpArr[0]-12) + ':' + tmpArr[1] + ' pm';
	 } else {
	 time12 = (+tmpArr[0]) + ':' + tmpArr[1] + ' am';
	 }
	 }
	 }
	 return time12;
	 }
});
//$('#calendar-holder').fullCalendar('renderEvent', event, true);
//fc-mon fc-other-month fc-future
$(function () {
$('.datetimepicker').datetimepicker({
   format: 'L LT',
    //locale: moment.locale(),
    
});

$('.datetimepicker1').datetimepicker({
   // format: 'L LTS',
    //locale: moment.locale(),
});

});




