<!DOCTYPE html> 	10:07 
<html>
<head>
    <meta charset="UTF-8"/>
	<title>Document</title>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
	<script>	
		var from = null, start = 0, url='chat.php';
		$( document ).ready(function() {

			$('#message').val('');
			from = prompt("Qual é o seu nome?");
		
			$( "#message" ).focus();

		});	
			$(document).keypress(function(e) {
					if(e.which == 13){
						
						if($('#message').val() != ""){	
							
							
							
							message = $('#message').val();
							
							$.post("chat.php",
							{
								message: message,
								from: from
							},
							function(data, status){
								load();
								$("body, html").animate({
								scrollTop: $(document).height()
							}, 400);
							});
							
							$('#message').val('');
							return false;
							};
					};
			});
		
		


			function load(){
				
				$.ajax({
					type: 'GET',
					url: 'db.php?start=' + start,
					
				}).done(function(e){
					obj = jQuery.parseJSON(e);
					if(obj.items){
						obj.items.forEach(Item =>{
							start = Item.id;
							
							 $('#container').append(renderMessage(Item));
							 $("body, html").animate({
								scrollTop: $(document).height()
							}, 100);
						});
						
					};
				});


			};

			function renderMessage(item){
				var data2 = new Date(item.created);
				var horas = data2.getHours();
        		var minutos = data2.getMinutes();
				if(horas<10){horas='0'+horas};
            			if(minutos<10){minutos='0'+minutos};
			
				var dataformatada = horas+":"+minutos;

				if(item.from == from){	
						return '<div class=msgbody><div class=mymsg><span>'+item.message+'</span></div><div class=myimgbody><span class="mytimepost">'+dataformatada+'</span></div></div>';
						
					}else{	
						return '<div class=msgbody><div class=othersimgbody><img src="img/hacker.png" alt="Smiley face" class="anonymous"><span class="timepost">'+dataformatada+'</span></div><div class=othersmsg><span class="nameOther">'+item.from+'</span></br><span>'+item.message+'</span></div>';
						
					};
				};

				var i=0;

			setInterval(function() {
				load();

			}, 1000);
				
							


		
	</script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="divSend"><input type="text" id="message" class="textSend">  </div>
	<div id="container">
		
		










		

				
			</div>
	

	</div>
</body>
</html>
