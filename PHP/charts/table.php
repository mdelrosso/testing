<?php

class myTable {
	
	var $numCols;	
	var $headings;		// array of the headings $object->headings = array('Business','Contact Name');

	// table style - Setting font sizes decorations etc...
	var $headingStyle;	// style for the heading row
	var $rowLightStyle;	// style for the lighter colored rows
	var $rowDarkStyle;	// style for the darker colored rows
	var $rowHighlightStyle; // style for the highlighted row

	var $colStyle; 		// array of style tags for each column (not implemented)
	
	// basic table settings	
	var $cellpadding;
	var $cellspacing;	
	var $tableWidth;
	var $tablestyle;

	// cell borders
	var $cellborder;	// another style tag for each cell


	var $row;		// array $row[row][column]
	var $numRows;		// row counter
	// Constructor
	function myTable(){

		// this sets up the default values
		// if all of your tables are going to look the same you can put all
		// of your style information in here and it will make using the table class easier
		$this->headingStyle = "font-weight: bold; background: #000099; color: #FFFFFF; font-weight: bold; font-size: 10pt;";

		$this->rowLightStyle = "background: #FFFFFF; color: #000000; font-size: 10pt;";
		$this->rowDarkStyle = "background: #DDDDDD; color: #000000; font-size: 10pt;";

		$this->cellpadding = 3;
		$this->cellspacing = 0;

		$this->cellborder = "border: solid 1px #000000;";

		$this->numRows = 0;
		$this->numCols = 0;
	}


	function addRow($rowData){
		
		for ( $i=0; $i<$this->numCols; $i++ ){
			if ($rowData[$i])
				$this->row[$this->numRows][$i] = $rowData[$i];
			else
				$this->row[$this->numRows][$i] = "&nbsp;";
		}

		$this->numRows++;
	}	

	function displayTable(){

		echo "<style>\r\n";
		echo ".row_dark { " . $this->rowDarkStyle . " }\r\n";
		echo ".row_lite { " . $this->rowLightStyle . " }\r\n";
		echo ".row_hilite { " . $this->rowHighlightStyle . " } \r\n";
		echo "</style>\r\n";

		echo "<table cellspacing=" . $this->cellspacing . " cellpadding=" . $this->cellpadding . " width=" . $this->tableWidth . " style=\"" . $this->tablestyle . "\">\r\n";
		// The heading row
		echo "<tr style=\"" . $this->headingStyle . "\">\r\n";
		
			for ( $i=0; $i<$this->numCols; $i++ ){
				echo "<td style=\"" . $this->cellborder . "\">" . $this->headings[$i] . "</td>";
			}

		echo "</tr>\r\n";			
			for ( $r=0; $r<$this->numRows; $r++ ){

				if (fmod($r,2))	// Even rows are lite, odd rows are dark
					$cRowClass = "row_dark";
				else
					$cRowClass = "row_lite";
	
				echo "<tr class=\"" . $cRowClass . "\"";
				
				if ($this->rowHighlightStyle)
					echo " onmouseover=\"this.className='" . $cRowClass . " row_hilite';\" onmouseout=\"this.className='" . $cRowClass . "';\"";

				echo ">\r\n";
				for ( $c=0; $c<$this->numCols; $c++ ){
					echo "<td style=\"" . $this->cellborder . "\">" . $this->row[$r][$c] . "</td>";
				}
				echo "\r\n</tr>\r\n";
			}

		echo "</table>";
	}
} 

// Usage Example

$tb = new myTable;

// set up the style of the table... only needed if you don't like the defaults
// You could setup include files for each style of table you need and just include
// the particular style you want here.
$tb->numCols 			= 3;     // Required
$tb->tableWidth 		= "";
$tb->tablestyle 		= "background: #2a97c7; color:#000000; font-size:12px; font-family:Arial, Helvetica, sans-serif;";

$tb->headingStyle 		= "background-image:url(modules/stats/images/fondo_rankings.png); color:#000000; font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;";
$tb->rowLightStyle 		= "background: #fffff0; color:#000000; font-size:12px; font-family:Arial, Helvetica, sans-serif;";
$tb->rowDarkStyle 		= "background: #00ff00; color:#000000; font-size:12px; font-family:Arial, Helvetica, sans-serif;";
$tb->rowHighlightStyle 	= "background: #ff0000; color:#000000; font-size:12px; font-family:Arial, Helvetica, sans-serif;";

$tb->cellborder 		= "0";
$tb->cellspacing 		= 1;
$tb->cellpadding 		= 4;

$tb->headings = array("N","Hotel", "Reservas");    // Required

$newRow = array("20x20 Tent","Tents","5");
$tb->addRow($newRow);

$newRow = array("8ft Table", "Tables", "15");
$tb->addRow($newRow);

$newrow = array("Silver Chair", "Chairs", "300");
$tb->addRow($newRow);

$newrow = array("Silver Chair", "Chairs", "300");
$tb->addRow($newRow);

// I think the above method reads easier than the following esspecially if
// you are using a lot of variables
// $tb->addRow( array("20x20 Tent","Tents","5") );



?>

<table border="0" cellpadding="1" cellspacing="0" bgcolor="#2a97c7">
  <tr>
    <td><?php $tb->displayTable();?></td>
  </tr>
</table>
