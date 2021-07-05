// najezdzanie poszczególnych zadań
$("ul").on("click", "li", function(){

if($(this).css("color") === "rgb(128, 128, 128)"){
	$(this).css("color", "black");
	$(this).css("text-decoration", "none");
	}
else{
	$(this).css("color", "grey");
	$(this).css("text-decoration", "line-through");
	}
	});
// uswanie zdarzen X
$("ul").on("click", "span",function(event){
	$(this).parent().fadeOut(500, function(){
		$(this).remove();
	});
	event.stopPropagation(); // zatrzymanie propagacji na inne zdarzenia

})

$("input[type='text']").keypress(function(event){
	if(event.which === 13) {
		// dodanie textu do inputu
		var toDoText = $(this).val();
		$(this).val("");
		$("ul").append("<li><span><i class='fas fa-toilet'></i></span> " + toDoText + "</li>");
		//dodanie nowego zdarzenia

	}
});

$(".fa-pen-alt").click(function(){
$("input[type='text']").fadeToggle();
});