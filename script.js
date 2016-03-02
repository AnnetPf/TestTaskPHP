// This script is uisng to sort table.
// Deafult settings - second column is sorted by name.
// For this purpose I use jQuery plugin - Tablesorter. 

$(document).ready(function() {
	$("table").tablesorter( {sortList: [[1,0], [0,0]]} ); 
});