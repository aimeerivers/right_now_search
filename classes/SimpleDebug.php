<?php
class SimpleDebug
{
	private $log = array();
	
	/**
	 * Just register a shutdown function
	 * to run the log display function
	 *
	 */
	function __construct () {
		register_shutdown_function(array($this, 'display'));
		
		return $this;
	}
	
	/**
	 * Return a new SimpleDebug object
	 *
	 * @return SimpleDebug
	 */
	static function factory () {
		return new SimpleDebug();
	}
	
	/**
	 * Add an entry to the log
	 *
	 * @param mixed $what
	 */
	function log ($what) {
		$this->log[] = $what;
		
		// return itself so it can be chained
		return $this;
	}
	
	/**
	 * Display the contents of the log, currently
	 * this is just a plain and nasty print_r
	 *
	 */
	function display () {
		echo '<div style="clear:both"></div><pre>'.print_r($this->log, true).'</pre>';
	}
}