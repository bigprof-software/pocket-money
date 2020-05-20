<?php
	auto_deposit_pocket_money_weekly();





	function auto_deposit_pocket_money_weekly() {
		$date = pocket_money_date();
		$description = 'Pocket money';

		// get all kids and their current pocket money value
		$kids = get_all_kids();
		foreach ($kids as $kid) {
			// if pocket money already added, skip
			if(sqlValue(
				"SELECT COUNT(1) FROM `transactions` 
				 WHERE
				 	`kid` = '{$kid['id']}' AND
				 	`date` = '{$date}' AND
				 	`description` LIKE '{$description}'"
			)) continue;

			// insert pocket money for kid, then set owner to admin
			if(insert('transactions', [
				'kid' => $kid['id'],
				'date' => $date,
				'amount' => $kid['pocket_money'],
				'description' => $description
			]))
				set_record_owner('transactions', db_insert_id(), 'admin');
		}
	}

	function get_all_kids() {
		$kids = [];
		$res = sql("SELECT * FROM `kids`", $eo);
		while($row = db_fetch_assoc($res)){
			$kids[] = $row;
		}

		return $kids;
	}

	function pocket_money_date() {
		// if today is Friday, return today
		if(date('w') == 5) return date('Y-m-d');

		// return date of last Friday
		return date('Y-m-d', strtotime('last friday'));
	}