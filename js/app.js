$(document).ready(function () {
	$("#btnAccept").click(function () {
		var clickBtnValue = $(this).val();
		$.ajax({
			type: "POST",
			url: "ajax/requestButton.php",
			data: {
				action: clickBtnValue,
			},
		});
	});

	$("#btnDecline").click(function () {
		var clickBtnValue = $(this).val();
		var value = $("#reason").val();
		$.ajax({
			type: "POST",
			url: "ajax/requestButton.php",
			data: {
				action: clickBtnValue,
				reason: value,
			},
		});
	});

	$("#btnDelete").click(function () {
		var clickBtnValue = $(this).val();
		$.ajax({
			type: "POST",
			url: "ajax/requestButton.php",
			data: {
				delete: clickBtnValue,
			},
		}).done(function (msg) {
			alert(msg);
		});
	});
	$(".emoji").hide();
	$(".tmp").hide();
	$(".message")
		.mouseover(function () {
			$(this).find(".emoji").show();
			$(this).find(".tmp").show();
		})
		.mouseout(function () {
			$(this).find(".emoji").hide();
			$(".tmp").hide();
		});
	$(".emoji").click(function () {
		var emoji = $(this).text();
		var id = $(this).attr("id");
		console.log(emoji);
		$.ajax({
			type: "POST",
			url: "ajax/emoji.php",
			data: {
				res: emoji,
				id: id,
			},
		});
	});
});
