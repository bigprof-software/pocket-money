<?php
	/**
	 * @file
	 * This file contains hook functions that get called when a new member signs up, 
	 * when a member signs in successfully and when a member fails to sign in.
	*/

	/**
	 * This hook function is called when a member successfully signs in. 
	 * It can be used for example to redirect members to specific pages rather than the home page, 
	 * or to save a log of members' activity, ... etc.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A string containing the URL to redirect the member to. It can be a relative or absolute URL. 
	 * If the return string is empty, the member is redirected to the homepage (index.php).
	*/

	function login_ok($memberInfo, &$args) {

		return '';
	}

	/**
	 * This hook function is called when a login attempt fails.
	 * It can be used for example to log login errors.
	 * 
	 * @param $attempt
	 * An associative array that contains the following members:
	 * $attempt['username']: the username used to log in
	 * $attempt['password']: the password used to log in
	 * $attempt['IP']: the IP from wihich the login attempt was made
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function login_failed($attempt, &$args) {

	}

	/**
	 * This hook function is called when a new member signs up.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $activity
	 * A string that takes one of the following values:
	 * 'pending': 
	 *     Means the member signed up through the signup form and awaits admin approval.
	 * 'automatic':
	 *     Means the member signed up through the signup form and was approved automatically.
	 * 'profile':
	 *     Means the member made changes to his profile.
	 * 'password':
	 *     Means the member changed his password.
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function member_activity($memberInfo, $activity, &$args) {
		switch($activity) {
			case 'pending':
				break;

			case 'automatic':
				break;

			case 'profile':
				break;

			case 'password':
				break;

		}
	}

	/**
	 * This hook function is called when an email is being sent
	 * 
	 * @param $pm is the PHPMailer object, passed by reference in order to easily modify its properties.
	 *            Documentation and examples can be found at https://github.com/PHPMailer/PHPMailer
	 *  
	 * @return none
	 */
	function sendmail_handler(&$pm) {

	}

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