$(document).ready(function() {
	// $('#mfc_bundle_ratingsbundle_studentrating_learnt').button();
	$('textarea').autosize();

	$('select#mfc_bundle_ratingsbundle_studentrating_timeEval').change(function(event) {
		$('div.usefulPast').slideToggle();
		$('div.usefulFuture').slideToggle();
	});

	// if ($('select#mfc_bundle_ratingsbundle_studentrating_timeEval').value() == "Before") {
	// 	$('div.usefulPast').hide();
	// } else {
	// 	$('div.usefulFuture').hide();
	// };
});