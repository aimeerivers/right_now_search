<?php
/**
 * Generic RSS Scraper
 *
 * @author Sermoa
 * @author Russell Smith <russell.smith@ukd1.co.uk>
 */
class RSSScraper extends Scraper implements Scraper_Interface {

	protected $name = 'RSS Search';

	private $feedUrl = '';

	/**
	 * The URL of the atom feed to parse
	 *
	 * @param string $feedUrl
	 * @example "http://news.google.com/news?um=1&ned=us&hl=en&output=rss&q=%s"
	 */
	function __construct($feedUrl)
	{
		$this->feedUrl = $feedUrl;
	}

	/**
	 * Get the feed for this query
	 *
	 * @param string $query a search query
	 * @return SimpleXMLElement
	 */
	function scrape($query) {
		$page = $this->fetchUrl("http://feeds.technorati.com/search/" . $query . "?language=en");

		try {
			$doc = @new SimpleXMLElement($page, LIBXML_NOCDATA);
			
			if (isset($doc->channel->image->url) && $doc->channel->image->url != '') {
				$this->name = sprintf('<a href="%s" title="%s"><img src="%s" border="0" alt="%s" /></a>', $doc->channel->image->link, $doc->channel->title, $doc->channel->image->url, $doc->channel->image->title);
			} elseif (isset($doc->channel->title) && $doc->channel->title != '') {
				$this->name = $doc->channel->title;
			}
			
			return $doc->channel->item;
		} catch (Exception $e) {
			// bad feed
			return false;
		}
	}

	function showResult($result) {
		echo "<li><p><a href='" . $result->link . "'>" . $result->title . "</a></p><p>" . $result->description . "</p><p><small>" . $result->pubDate . "</small></p></li>";
	}
}