<?php
/**
 * Twitter scraper
 *
 * @author Sermoa
 */
class TwitterSearchScraper extends Scraper implements Scraper_Interface {

	protected $name = 'Twitter Search';

	function scrape($query) {
		// get a page of results
		$page = $this->fetchUrl("http://search.twitter.com/search.json?rpp=20&q=" . $query);

		$results = json_decode($page);

		return $results instanceof stdClass ? $results->{'results'} : false;
	}

	function showResult($result) {
		echo "<li><img src='" . $result->{'profile_image_url'} . "' class='avatar' /><p>" . $result->{'text'} . "</p><p>- <a href='http://twitter.com/" . $result->{'from_user'} . "/status/" . $result->{'id'} . "'>" . $result->{'from_user'} . "</a> <small>" . $result->{'created_at'} . "</small></p></li>";
	}
}