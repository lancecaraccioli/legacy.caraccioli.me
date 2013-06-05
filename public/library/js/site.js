function displayMessage(message, type){
			alertType = (type=='warning' || type=='error')?'ui-state-error':'ui-state-highlight';
			$.jGrowl(message, {theme:alertType, life:10000, header:type});				
}
function displayMessages(messages){
	for (category in messages){
		for(message in messages[category]){
			displayMessage(messages[category][message], category);
		} 
	}
}
