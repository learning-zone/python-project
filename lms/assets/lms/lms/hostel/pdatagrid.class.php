<?php
/**
* PDatagrid
* 
* A class to to display records extracted by a SQL query in a 
* grid-based format or other another customizable layout with 
* page navigation links.
* @version 1.0.0
* @package pdatagrid
*/
/**
 * PDatagrid
 *
 */
class PDatagrid {
	/**
	 * Row formatting string
	 *
	 * Same syntax of sprintf formatting string with 2 placeholders (%s)
	 * 
	 * 1) replaced by tag attributes. 
	 * 2) replaced by all field values formatted by $fieldfmt.
	 * 
	 * Examples: 
	 * - $grid->rowfmt = "<tr%s>%s</tr>";
	 * - $grid->rowfmt = "<ul%s>%s</ul>";
	 * @var string
	 */
	var $rowfmt;
	/**
	 * Field formatting string
	 *
	 * Same syntax of sprintf formatting string with 1 
	 * placeholder (%s) replaced by field value.
	 * 
	 * Examples: 
	 * - $grid->fieldfmt = "<td>%s</td>";
	 * - $grid->fieldfmt = "<li>%s</li>";
	 * @var string
	 */
	var $fieldfmt;
	/**
	 * Navigation link formatting string
	 *
	 * Same syntax of sprintf formatting string with 3 placeholders (%s)
	 * 
	 * 1) replaced by $baselink
	 * 2-3) replaced by current page number
	 * 
	 * Example: 
	 * - $grid->fieldfmt = "<a href=\"%spage=%s\">%s</a>";
	 * @var string
	 */
	var $linkfmt;
	/**
	 * Current page indicator formatting string
	 *
	 * Same syntax of sprintf formatting string with 1
	 * placeholder (%s) replaced by current page number
	 * 
	 * Example:
	 * - $grid->curpagefmt = '[%s]';
	 * @var string
	 */
	var $curpagefmt;
	/**
	 * Navigation links separator
	 *
	 * Used as separator between navigation links
	 * @var string
	 * 
	 * Example:
	 * -$grid->navsep = ' | ';
	 */
	var $navsep;
	/**
	 * Text of go previous navigation link
	 *
	 * Examples:
	 * - $grid->navprev = '&lt; ';
	 * - $grid->navprev = 'Prev. ';
	 * @var string
	 */
	var $navprev;
	/**
	 * Text of go next navigation link
	 *
	 * Examples:
	 * - $grid->navnext = ' &gt;';
	 * - $grid->navnext = ' Next';
	 * @var string
	 */
	var $navnext;
	/**
	 * Text of go first navigation link
	 *
	 * Example:
	 * - $grid->navfirst = '&lt;&lt; ';
	 * @var string
	 */
	var $navfirst;
	/**
	 * Text of go last navigation link
	 *
	 * Example:
	 * - $grid->navlast = ' &gt;&gt;';
	 * @var string
	 */
	var $navlast;
	/**
	 * Odd rows class name
	 *
	 * @var string
	 */
	var $classodd;
	/**
	 * Even rows class name
	 *
	 * @var string
	 */
	var $classeven;
	/**
	 * Base url for navigation links
	 *
	 * Examples:
	 * - $grid->baselink = '/show-records.php';
	 * - $grid->baselink = 'http://www.example.com/show-records.php';
	 * @var string
	 */
	var $baselink;
	/**
	 * Database connection
	 *
	 * @var resource
	 * @access private
	 */
	var $_connection;
	/**
	 * SQL query to select records
	 *
	 * @var string
	 * @access private
	 */
	var $_sql;
	/**
	 * SQL query to count records
	 *
	 * @var string
	 * @access private
	 */
	var $_sqlcount;
	/**
	 * Number of rows to display on a page
	 *
	 * @var int
	 * @access private
	 */
	var $_rowsperpage;
	/**
	 * Maximum nuber of navigation links
	 *
	 * @var int
	 * @access private
	 */
	var $_maxnavlinks;
	/**
	 * Current page number
	 *
	 * @var int
	 * @access private
	 */
	var $_page;
	/**
	 * Error message
	 *
	 * @var string
	 * @access private
	 */
	var $_error;
	/**
	 * Class constructor
	 * 
	 * Connection can be set after object creation.
	 * Pass null as argument and successively call setConnection() method.
	 *
	 * @param resource &$connection valid connection as returned by mysql_connect() 
	 * @return PDatagrid
	 */
	function PDatagrid(&$connection) {
		$this->rowfmt = "<tr%s>%s</tr>\n";
		$this->fieldfmt = "<td>%s</td>";
		$this->linkfmt = "<a href=\"%spage=%s\">%s</a>";
		$this->curpagefmt = "[%s]";
		$this->navsep = " | ";
		$this->navprev = '&lt; ';
		$this->navnext = ' &gt;';
		$this->navfirst = '&lt;&lt; ';
		$this->navlast = ' &gt;&gt;';
		$this->classodd = 'odd';
		$this->classeven = 'even';
		$this->baselink = $_SERVER['PHP_SELF'];
		$this->_rowsperpage = 1;
		$this->_maxnavlinks = 10;
		$this->_page = 1;
		if($connection) {
			$this->setConnection($connection);
		}
	}
	/**
	 * Sets database connection
	 *
	 * @param resource &$conn valid connection as returned by mysql_connect() 
	 */
	function setConnection(&$conn) {
		$this->_connection = $conn;
	}
	/**
	 * Sets SQL query used to select rows
	 *
	 * Example:
	 * - $grid->setSqlSelect("SELECT col1, col2, col3 FROM table");
	 * @param string $sql
	 */
	function setSqlSelect($sql) {
		$this->_sql = $sql;
	}
	/**
	 * Sets SQL query used to count rows
	 *
	 * Example:
	 * - $grid->setSqlCount("SELECT COUNT(*) FROM table");
	 * @param string $sql
	 */
	function setSqlCount($sql) {
		$this->_sqlcount = $sql;		
	}
	/**
	 * Sets max number of rows per page
	 *
	 * @param int $maxrows
	 */
	function setRowsPerPage($maxrows) {
		if($maxrows > 0) {$this->_rowsperpage = $maxrows;}
	}
	/**
	 * Sets max number of navigation links
	 *
	 * @param int $maxlinks
	 */
	function setMaxNavLinks($maxlinks) {
		if($maxlinks < 0) {$maxlinks = 0;}
		$this->_maxnavlinks = $maxlinks;
	}
	/**
	 * Sets current page number
	 *
	 * @param int $pagenum
	 */
	function setPage($pagenum) {
		$pagenum = intval($pagenum);
		if($pagenum> 0) {
			$this->_page = $pagenum;
		}
	}
	/**
	 * Gets error message
	 *
	 * @return string
	 */
	function getError() {
		return $this->_error;
	}
	/**
	 * Gets current page rows
	 *
	 * Data is ready to be echoed and formatted accordingly to $rowfmt, $fieldfmt properties
	 * @see $rowfmt
	 * @see $fieldfmt
	 * @return string|false formatted data or false on error
	 */
	function getRows() {
		if(!$this->_sql) {
			$this->_error = 'Query to select rows not set. Call method setSqlSelect()';
			return false;
		}
		if(!$this->_connection) {
			$this->_error = 'Database connection not set. Call method setConnection()';
			return false;
		}
		$cr = 0;
		$p = $this->_page - 1;
		If($p < 0) {$p = 0;}
		$p = $this->_rowsperpage * $p;
		$result = execute ($this->_sql . " LIMIT $p, {$this->_rowsperpage}", $this->_connection);
		if(!$result) {
			$this->_error = 'Error: ' . mysql_error();
			return false;
		}
		
		if (rowcount($result) == 0) {
			return '';
		}
		
		$classodd = $classeven = '';		
		if($this->classodd) {
			$classodd = ' class="' . $this->classodd . '"';
		}
		if($this->classeven) {
			$classeven = ' class="' . $this->classeven . '"';
		}
		
		$r = '';
		while ($row = mysql_fetch_assoc($result)) {
			$c = '';
			
			foreach($row as $key=>$field) {
				$c .= $this->fmtField($key, $field);
			}
			$r .= sprintf($this->rowfmt, $cr ? $classodd : $classeven, $c);
			$cr = 1 - $cr;
		}
		return $r;
	}
	/**
	 * Returns formatted field value
	 *
	 * @param string $fname Field name
	 * @param string $fvalue Field value
	 * @return string
	 * @access private
	 */
	function fmtField($fname, $fvalue) {
		return sprintf($this->fieldfmt, $fvalue);
	}
	/**
	 * Gets navigation links
	 *
	 * Data is ready to be echoed and formatted accordingly to $linkfmt property
	 * @see $linkfmt
	 * @return string|false formatted data or false on error
	 */
	function getLinks() {
		if($this->_maxnavlinks <= 0) { 
			return; 
		}
		if(!$this->_sqlcount) {
			$this->_error = 'Query to count rows not set. Call method setSqlCount()';
			return false;
		}
		if(!$this->_connection) {
			$this->_error = 'Database connection not set. Call method setConnection()';
			return false;
		}
		$result = execute ($this->_sqlcount, $this->_connection);
		if(!$result) {
			$this->_error = 'Error: ' . mysql_error();
			return false;
		}
		$tot = mysql_result($result, 0);
		if($tot == 0) {return '';}
		$pages = ceil($tot / $this->_rowsperpage);
		
		$bl = $this->baselink;
		$p = strpos($bl, '?');
		if($p === false) {
			$bl .= '?';
		} elseif($p != strlen($bl) - 1) {
			$bl .= '&amp;';
		}
		
		$p = $this->_page;
		$links = array(sprintf($this->curpagefmt, $p));
		$tl = $this->_maxnavlinks - 1;
		$lr = 1;
		while($tl > 0) {
			$ex = true;
			$n=$p-$lr;
			if($p - $lr > 0) {
				array_unshift($links, sprintf($this->linkfmt, $bl, $n, $n));
				$ex = false;
				$tl--;
			}
			if($tl > 0) {
				$n = $p + $lr;
				if($n<= $pages) {
					$links[] = sprintf($this->linkfmt, $bl, $n, $n);
					$ex = false;
					$tl--;
				}
			}
			if($ex) {break;}
			$lr++;
		}
		$nf = $this->navfirst;
		$np = $this->navprev;
		if($p > 1) {
			$nf = sprintf($this->linkfmt, $bl, 1, $this->navfirst);
			$np = sprintf($this->linkfmt, $bl, $p - 1, $this->navprev);
		}
		$nl = $this->navlast;
		$nn = $this->navnext;
		if($p < $pages) {
			$nl = sprintf($this->linkfmt, $bl, $pages, $this->navlast);
			$nn = sprintf($this->linkfmt, $bl, $p + 1, $this->navnext);
		}
		return $nf . $np . implode($this->navsep, $links) . $nn . $nl;
	}
}
?>