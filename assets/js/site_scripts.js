$(document).ready(function(){
	var $fotoramaDiv = $("#slider").fotorama({
		nav: false,
		width: '100%',
		height: '408px',
		arrows: false,
		click: false,
		swipe: false
	});
	var fotorama = $fotoramaDiv.data('fotorama');
	$(".content__slider_pag span:first-child").click(function(){
		fotorama.show('<');
	});
	$(".content__slider_pag span:last-child").click(function(){
		fotorama.show('>');

		addEventClickInput();
	});

	function addEventClickInput() {
		let inputs = document.querySelectorAll('input');
		for (input of inputs) {
			let idlike = input.id;
			idlike = parseInt(idlike.match(/\d+/));
			input.addEventListener('click', addLike);
		}
	}
	addEventClickInput();

	function addLike(e) {
		let id = e.target.id;
		id = parseInt(id.match(/\d+/))
		$.ajax({
			type: 'GET',
			url: 'index.php?class=like&method=add',
			data: {id},
			success: function(){
				$('#heart-' + id).load('index.php #heart-' + id);
			}
		})
	}

});