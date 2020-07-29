
function submitLink() {
	var url = $("#url").val();
	$('#insert_area').html('<img src="../assets/loading.gif">');
	$('#confirm_button').hide(0);
	$.ajax({
		type: "POST",
		url: 'ajax/createTile.php',
		data: {o:"submitLink", url:url},
		dataType: "html"
	})
		.done(function(data){
			$("#footer").animate({height: 400}, 300);
			$('#insert_area').html(data);
		});
}

function saveTile() {
	var title = $("#tileTitle").val();
	var title = $("#tileFoundPrice").val();
	var title = $("#tileTargetPrice").val();


}