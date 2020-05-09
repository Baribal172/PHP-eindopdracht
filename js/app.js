$(document).ready(function () {
	$("#btnAccept").click(function () {
		var clickBtnValue = $(this).val();
		$.ajax({
			type: "POST",
			url: "ajax/requestButton.php",
			data: {
				action: clickBtnValue,
			},
		}).done(function (msg) {
			alert(msg);
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
		}).done(function (msg) {
			alert(msg);
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
	$(".message")
		.mouseover(function () {
			$(this).find(".emoji").show();
		})
		.mouseout(function () {
			$(this).find(".emoji").hide();
		});
	$(".emoji").click(function () {
		var emoji = $(this).text();
		console.log(emoji);
		$.ajax({
			type: "POST",
			url: "ajax/emoji.php",
			data: {
				res: emoji,
			},
		}).done(function (msg) {
			alert(msg);
		});
	});
});
