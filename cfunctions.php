<?php

	

	

		

	// echos "Torsdag 23. november 2006"

	$today = no_day().date(" j. ").no_month().' '.date("Y").' kl '.date("G:i");

	

	// enable cookies in the middle of the script

	ob_start();

	

	// enable sessions

	session_start();

	
	function no_day() { // date("l") på norsk.

		$dag = date("l"); // dagen på engelsk

		switch($dag) {

			case "Monday":

				$dag = "Mandag";

				break;

			case "Tuesday":

				$dag = "Tirsdag";

				break;

			case "Wednesday":

				$dag = "Onsdag";

				break;

			case "Thursday":

				$dag = "Torsdag";

				break;

			case "Friday":

				$dag = "Fredag";

				break;

			case "Saturday":

				$dag = "Lørdag";

				break;

			case "Sunday":

				$dag = "Søndag";

				break;

			default:

				$dag = "Loldag";

				break;

		}

		return $dag;

	} // no_day

	

	

	function no_month() { // date("F") på norsk

		$month = date("F");

		switch($month) {

			case "January":

				$month = "januar";

				break;

			case "February":

				$month = "februar";

				break;

			case "Mars":

				$month = "mars";

				break;

			case "April":

				$month = "april";

				break;

			case "May":

				$month = "mai";

				break;

			case "June":

				$month = "juni";

				break;

			case "July":

				$month = "juli";

				break;

			case "August":

				$month = "august";

				break;

			case "September":

				$month = "september";

				break;

			case "October":

				$month = "oktober";

				break;

			case "November":

				$month = "november";

				break;

			case "December":

				$month = "desember";

				break;



		}

		return $month;

		

	} // no_month

	

	

?>