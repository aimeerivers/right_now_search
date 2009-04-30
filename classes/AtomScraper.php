<?php
/**
 * Generic atom scraper
 *
 * @author Sermoa
 * @author Russell Smith <russell.smith@ukd1.co.uk>
 */
class AtomScraper extends Scraper implements Scraper_Interface {

	protected $name = 'Atom Search';

	private $feedUrl = '';

	/**
	 * The URL of the atom feed to parse
	 *
	 * @param string $feedUrl
	 * @example "http://news.google.com/news?um=1&ned=us&hl=en&output=atom&q=%s"
	 */
	function __construct($feedUrl)
	{
		$this->feedUrl = $feedUrl;
	}

	/**
	 * Get the atom feed for this query
	 *
	 * @param string $query a search query
	 * @return SimpleXMLElement
	 */
	function scrape($query) {
		// stick the query into the url :)
		$url = sprintf($this->feedUrl, $query);

		// grab it
		$page = $this->fetchUrl($url);

		// turn it in to XML object
		try {
			$doc = @new SimpleXMLElement($page, LIBXML_NOCDATA);
			
			return $doc->entry;
		} catch (Exception $e) {
			// bad feed
			return false;
		}

	}

	function showResult($result) {
		echo "<li><p><a href='" . $result->link['href'] . "'>" . $result->title . "</a></p><p>" . $result->content . "</p><p>- <a href='" . $result->author->uri . "'>" . $result->author->name . "</a> <small>" . $result->published . "</small></p></li>";
	}
}