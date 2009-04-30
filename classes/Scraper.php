<?php
/**
 * Scraper class
 *
 */
class Scraper {
	
	/**
	 * Debug mode - should we output debug information on
	 * the requests we are making?
	 *
	 */
	const DEBUG = false;
	
	/**
	 * Don't wait too long for feeds, abort the request after
	 * this many seconds
	 *
	 */
	const FETCH_TIMEOUT = 3;
	
	/**
	 * The user agent to pretend to be
	 *
	 */
	const USER_AGENT = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)";

	/**
	 * Name for the scraper
	 *
	 * @var string
	 */
	protected $name = "Generic Scraper";
	
	/**
	 * List through a result set
	 *
	 * @param array $results
	 */
	function showResults($results) {
		echo "<div class='results_column'>";
		echo "<h2>" . $this->name . "</h2>";
		echo "<ul>";
		
		if (count($results) == 0 || !($results instanceof SimpleXMLElement || is_array($results))) {
			echo "<li>No results found.</li>";
		} else {
			foreach($results as $result) {
				$this->showResult($result);
			}
		}
		echo "</ul>";
		echo "</div>";
	}

	/**
	 * If a valid query is passed, run the scrape and then 
	 *
	 * @param unknown_type $query
	 * @return unknown
	 */
	function fetchAndDisplayResults($query) {
		if (trim($query) == '') {
			return "";
		}
		
		$results = $this->scrape(urlencode($query));
		$this->showResults($results);
	}

	/**
	 * Grab a url and return the result
	 *
	 * @param string $url
	 * @return string
	 */
	protected function fetchUrl($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
		curl_setopt($ch, CURLOPT_TIMEOUT, self::FETCH_TIMEOUT);
		curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
		
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		
		// is debugging on?
		if (Scraper::DEBUG) {
			// log the response & the stats array
			$debug = SimpleDebug::factory()->log(htmlentities($response, ENT_COMPAT))->log($info);
		}

		curl_close($ch);

		if ($info['http_code'] == 200) {
			return $response;
		} else {
			return false;
		}
	}
}