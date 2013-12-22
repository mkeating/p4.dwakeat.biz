
	var totalAllowed = 16;
	var text = '';
	var words = [];
	var wordsLeft;
	var color;

	
	$(".storyfield").keyup(function(e){
		text = $(".storyfield").val();
		words = text.split(' ');
		wordsLeft = totalAllowed - words.length;
		if (wordsLeft == 0){
			if(e.keyCode != 8){
				console.log("not backspace");
				$(".storyfield").keydown(function(){
					return false;
				}	
				);
			}else{$(".storyfield").keydown(function(){
					return true;
				}	
				);
				}
		}
		
		if (wordsLeft <= 15 && wordsLeft > 5){
			color = 'orange';
		}else if(wordsLeft <= 5){
			color = 'red';
		}
		$(".counter").text(wordsLeft + " words left").css('color', color);
	})



