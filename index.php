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

$rows = 500; // Numerical rangeю

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

// Array of random numbers.
$randomArray = range(1, $rows);
// Shaffle array to eliminate dublicates.
shuffle($randomArray); 

// Run through array...
foreach ($randomArray as $val) {
	
	// This variable is used to detect number name.
	$numClass = $lang[$val];

	// Check is number divisible by 3 and 5
	if ($val %15 == 0)  {
		$tdClass = "divisible_3_5";
		$numClass = "Fizzbuzz";
	} 
	// Check is number divisible by 5
	else if ($val %5 == 0) {
		$tdClass = "divisible_5";
		$numClass = "buzz";
	} 
	// Check is number divisible by 3
	else if ($val %3 == 0) {
		$tdClass = "divisible_3";
		$numClass = "Fizz";
	}

	// Render rows. Firs - with numbers...
	$table .= '<td class=' .$tdClass .'>' .$val .'</td>';
	// ...second - width definition.
	$table .= '<td>' .$numClass .'</td>';
	$table .= '</tr>';

 }

// Close table.
$table .= '</table>';
// Get table on page.
echo $table;

?>