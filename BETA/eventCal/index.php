<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='css/fullcalendar.css' rel='stylesheet' />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/lib/moment.min.js'></script>
<script src='js/lib/jquery.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			defaultDate: '2014-08-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2014-08-01'
				},
				{
					title: 'Long Event',
					start: '2014-08-07',
					end: '2014-08-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-08-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-08-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2014-08-11',
					end: '2014-08-13'
				},
				{
					title: 'Meeting',
					start: '2014-08-12T10:30:00',
					end: '2014-08-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-08-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-08-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2014-08-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2014-08-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-08-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-08-28'
				}
			]
		});

	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

</body>
</html>