events: function(view) {
						jQuery.ajax({
							url: Routing.generate('Event_load'),
							type: 'POST',
							dataType: 'json',
							/*data: {
								start: startDate.format(),
								end: end.format()
							},*/
							 success: function (doc) {
								  //alert("Success");
								  var events = [];
								  var objs= [];
								  var myJSON = JSON.stringify(doc);
								  var obj = JSON.parse(myJSON);
								  //alert(obj);
								  for(var i=0;i<obj.length;i++){
									  
									  //objs= obj[i];
									  //lert(objs[i]['id']);

									  for (var j in objs) {
										 
											  alert(objs.title);
											  
										  /* if (objs.title) {
											   
									            $('#calendar-holder').fullCalendar(
									              'addResource',
									              { title: "<span class='glyphicons'>"+objs.title+"</span>" },
									              true // scroll to the new resource?
									            );
									          }*/
										  var startD =   $.fullCalendar.moment(objs.startDate,'DD-MM-YYYY HH:mm:ss');
										   alert("startdate "+startD);
										   var endD =$.fullCalendar.moment(objs.endDate,'DD-MM-YYYY HH:mm:ss');
										   alert(endD);
										   
											  events.push({
						                          title: objs.title,  //your calevent object has identical parameters 'title', 'start', ect, so this will work
						                          start:startD,//start.dateTime || objs.startDate.start.date, // will be parsed into DateTime object    
						                          end: endD ,//|| objs.endDate.date,
						                          id: objs.id,
						                          filters:objs.filters,
						                          event:objs.event,
					                        	  url:objs.event,
					                        	  className:objs.className,
					                        	  editable:objs.editable,
					                        	  startEditable:objs.startEditable,
					                        	  durationEditable:objs.durationEditable,
					                        	  rendering:objs.rendering,
					                        	  overlap:objs.overlap,
					                        	  constraint:objs.constraint,
					                        	  source:objs.source,
					                        	  color:objs.color,
					                        	  backgroundColor:objs.backgroundColor,
					                        	  textColor:objs.textColor,
					                        	  allDay:objs.allDay
						                      });
											  //jQuery.fullCalendar('addEventSource',events);

									  }	;
								  }
								  return (events);
							},
							 error: function() {
					                alert('there was an error while fetching events!');
					            },
						
						});
					},
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
									events: function(start, end, timezone, callback) {
						jQuery.ajax({
							url: Routing.generate('Event_load'),
							type: 'POST',
							dataType: 'json',
							
							success: function (doc) {
								  alert("Success");
								  var events = [];
								  //var objs= [];
								  
								  var myJSON = JSON.stringify(doc);
								  var obj = JSON.parse(myJSON);
								  //alert(obj);
								  for(var i=0;i<obj.length;i++){
									  
									 var objs= obj[i];
									  //alert(objs[i]['title']);

									  for (var j in objs) {
										 
											  //alert(objs.startDate);
											  
										  if (typeof objs[j] === 'undefined') {
											  // Désormais, on sait que toto est bien
											  // défini et on peut poursuivre.
											  alert("undefined "+objs[j]);
											}
										     var endDt =   $.fullCalendar.moment(objs.endDate).format('HH:mm:ss');

										  var startD =   $.fullCalendar.moment(objs.startDate,'DD-MM-YYYY HH:mm:ss');
										   //alert("startdate "+startD);
										   var endD =$.fullCalendar.moment(objs.endDate,'DD-MM-YYYY HH:mm:ss');
										   alert(endD);
										 
											  events.push({
						                          'title': objs.title,  //your calevent object has identical parameters 'title', 'start', ect, so this will work
						                          'start': "objs.startDate" ,//start.dateTime || objs.startDate.start.date, // will be parsed into DateTime object    
						                          'end': "objs.endDate" ,//|| objs.endDate.date,
						                          'id': objs.id /*,
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
					                        	  allDay: objs.allDay*/
						                      });
											  //jQuery.fullCalendar('addEventSource',events);

									  }	;
									  alert("numero "+ i);
									  
								  }
				                  //$('#calendar-holder').fullCalendar('renderEvent', events,true);
								  alert(events);
								  //alert(doc);
								
								 $('#calendar-holder').fullCalendar({
									 events:events
								 });
								  callback(events);
							},
							 error: function() {
					                alert('there was an error while fetching events!');
					            },
						
						});
					},
					