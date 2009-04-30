<?php
/**
 * Identi.ca scraper
 *
 * @author Russell Smith <russell.smith@ukd1.co.uk>
 */
class IdenticaScraper extends AtomScraper {
	
	protected $name = 'Identi.ca';
	
	/**
	 * Constructor - just call the parent and set the feed url :)
	 *
	 */
	function __construct()
	{
		parent::__construct('http://identi.ca/api/search.atom?q=%s');
	}
}