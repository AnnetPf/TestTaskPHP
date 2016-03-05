<?php
include_once 'lang-switcher.php';
?>

<?php

// For mobile version.
echo '<meta name="viewport" content="initial-scale=1, maximum-scale=1">';

// Including files.
echo '<link href="style.css" rel="stylesheet">';
echo '<script type="text/javascript" src="libs/jquery.js"></script>';
echo '<script type="text/javascript" src="libs/jquery.tablesorter.js"></script>';
echo '<script type="text/javascript" src="script.js"></script>';

$rows = 500; // Numerical range.

// Start to create table...
$table = '<table border="1">';
// Include table header. With the help of this, we can sort table.
$table .= '
	<thead>
		<tr>
			<th>' .$lang['firstColumnTitle'] .'</th>
			<th>' .$lang['secondColumnTitle'] .'</th>
		</tr>
	</thead>';

for ($tr=1; $tr<=$rows; $tr++) {
	
	$tdClass = "smth";
	
	// Create random number.
	$rand = rand();
	// Covrert to string.
	$str = "$rand";
	// Convert to array.
	$arr1 = str_split($str);
	// Check length of array to define length of number.
	$length = count($arr1);

	// And now check number...

	// 0 - 9
	if ($length == 1) {
		$numClass = $units[$rand];
	}

	// 10 - 19
	if ($length == 2 && $arr1[0] == '1') {
		$numClass = $oneDozensOf[$rand];
	}

	// 20 - 99
	if ($length == 2 && $arr1[0] != '1') {
		$numClass = $dozensOf[$arr1[0]] .' ' .$units[$arr1[1]];
		if ($length == 2 && $arr1[1] == '0') {
			$numClass = $dozensOf[$arr1[0]];
		}
	}

	// 100 - 999
	if ($length == 3) {
		$numClass = $units[$arr1[0]] .' hundred and ' .$dozensOf[$arr1[1]] .' ' .$units[$arr1[2]];
		// If 1 - the second number (211, 213, 214...)
		if ($arr1[1] == '1') {
			$numClass = $units[$arr1[0]] .' hundred and ' .$oneDozensOf[$arr1[1] .$arr1[2]];			
		}
	}

	// 1000 - 9999
	if ($length == 4) {
		$numClass = $units[$arr1[0]] .' thousand ' .$units[$arr1[1]] .' hundred and ' .$dozensOf[$arr1[2]] . ' ' .$units[$arr1[3]];
		// Numbers like 2026, 3031... (when 0 is the second symbol)
		if ($arr1[1] == '0' && $arr1[2] != '1') {
			$numClass = $units[$arr1[0]] .' thousand '  .$dozensOf[$arr1[2]] . ' ' .$units[$arr1[3]];
		}
		// Numbers 2012, 4013, 4018... (when 1 is the third symbol)
		else if ($arr1[2] == '1') {
			$numClass = $units[$arr1[0]] .' thousand '  .$oneDozensOf[$arr1[2].$arr1[3]];
		}
	}

	// 10000 - 99999
	if ($length == 5) {
		// Normal numbers
		$numClass = $dozensOf[$arr1[0]] .' ' .$units[$arr1[1]]. ' thousand ' .$units[$arr1[2]] .' hundred and ' .$dozensOf[$arr1[3]] . ' ' .$units[$arr1[4]];
		// No hundred part.
		if ($arr1[2] == '0') {
			$numClass =  $dozensOf[$arr1[0]] .' ' .$units[$arr1[1]] .' thousand and ' .$dozensOf[$arr1[3]] . ' ' .$units[$arr1[4]];
			// 1 - fourth number.
			if ($arr1[3] == '1') {
				$numClass = $dozensOf[$arr1[0]] .' ' .$units[$arr1[1]] .' thousand and ' .$oneDozensOf[$arr1[3] .$arr1[4]];
			}
		}

		// 1 - first number.
		if ($arr1[0] == '1') {
			$numClass = $oneDozensOf[$arr1[0] .$arr1[1]] .' thousand ' .$units[$arr1[2]] .' hundred and ' .$dozensOf[$arr1[3]] . ' ' .$units[$arr1[4]];
			// No hundred part.
			if ($arr1[2] == '0') {
				$numClass = $oneDozensOf[$arr1[0] .$arr1[1]] .' thousand and ' .$dozensOf[$arr1[3]] . ' ' .$units[$arr1[4]];
				// 1 - fourth number.
				if ($arr1[3] == '1') {
					$numClass = $oneDozensOf[$arr1[0] .$arr1[1]] .' thousand and ' .$oneDozensOf[$arr1[3] .$arr1[4]];
				}
			}
		}

		// 0 - second number.
		if ($arr1[1] == '0') {
			$numClass = $dozensOf[$arr1[0]] .' thousand ' .$units[$arr1[2]] .' hundred and ' .$dozensOf[$arr1[3]] . ' ' .$units[$arr1[4]];
			// No hundred part.
			if ($arr1[2] == '0') {
				$numClass = $dozensOf[$arr1[0]] .' thousand and ' .$dozensOf[$arr1[3]] . ' ' .$units[$arr1[4]];
				// 1 - fourth number.
				if ($arr1[3] == '1') {
					$numClass = $dozensOf[$arr1[0]] .' thousand and ' .$oneDozensOf[$arr1[3] .$arr1[4]];
				}
			}
		}
	}


	// Check is number divisible by 3 and 5
	if ($rand %15 == 0)  {
		$tdClass = "divisible_3_5";
		$numClass = "Fizzbuzz";
	} 
	// Check is number divisible by 5
	else if ($rand %5 == 0) {
		$tdClass = "divisible_5";
		$numClass = "buzz";
	} 
	// Check is number divisible by 3
	else if ($rand %3 == 0) {
		$tdClass = "divisible_3";
		$numClass = "Fizz";
	}

	// Render rows. First - with numbers...
	$table .= '<td class=' .$tdClass .'>' .$rand .'</td>';
	// ...second - width definition.
	$table .= '<td>' .$numClass .'</td>';
	$table .= '</tr>';	
}

// Close table.
$table .= '</table>';
// Get table on page.
echo $table;

?>