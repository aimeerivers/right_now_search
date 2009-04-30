<?php
/**
 * Google blog scraper
 *
 * @author Sermoa
 */
class GoogleBlogScraper extends AtomScraper {

	protected $name = 'Google Blog Search';
	
	function __construct () {
		parent::__construct('http://blogsearch.google.com/blogsearch_feeds?hl=en&num=10&output=atom&q=%s');
	}
}