$j(function() {
	$j('<button id="add-pocket-money" type="button" class="btn btn-default"><i class="glyphicon glyphicon-usd"></i> Weekly pocket money</button>').appendTo('.all_records');
	
	$j('#add-pocket-money').on('click', function() {
		$j(this).prop('disabled', true);
		$j.ajax({
			url: 'hooks/cron-pocket-money-friday.php',
			complete: function() {
				$j('#add-pocket-money').prop('disabled', false);
			}
		})
	})
})