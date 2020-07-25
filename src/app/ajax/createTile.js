
function submitLink() {
	var url = $("#url").val();
	$('#insert_area').html('<img src="../assets/loading.gif">');
	$.ajax({
		type: "POST",
		url: 'ajax/createTile.php',
		data: {o:"submitLink", url:url},
		dataType: "html"
	})
		.done(function(){
			$('#insert_area').html('OK!');
		});
}