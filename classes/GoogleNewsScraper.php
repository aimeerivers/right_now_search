<?php
/**
 * Google news scraper
 *
 * @author Sermoa
 */
class GoogleNewsScraper extends AtomScraper {

	protected $name = 'Google News Search';

	function __construct () {
		parent::__construct('http://news.google.com/news?um=1&ned=us&hl=en&output=atom&q=%s');
	}
}