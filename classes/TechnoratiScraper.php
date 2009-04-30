<?php
/**
 * Technorati scraper
 *
 * @author Russell Smith <russell.smith@ukd1.co.uk>
 */
class TechnoratiScraper extends RSSScraper {

	protected $name = 'Technorati Search';

	function __construct () {
		parent::__construct ('http://feeds.technorati.com/search/%s?language=en');
	}
}