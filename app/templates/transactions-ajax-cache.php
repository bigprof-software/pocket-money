<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'transactions';

		/* data for selected record, or defaults if none is selected */
		var data = {
			kid: <?php echo json_encode(array('id' => $rdata['kid'], 'value' => $rdata['kid'], 'text' => $jdata['kid'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for kid */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'kid' && d.id == data.kid.id)
				return { results: [ data.kid ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

