<?php
/**
 * Scraper Interface file
 *
 * @author Sermoa
 * @package Scraper
 */
interface Scraper_Interface {
	/**
	 * Output the results
	 *
	 * @param object $result
	 */
	public function showResult($result);

	/**
	 * Perform a scrape based on the query
	 *
	 * @param string $query the query to search
	 */
	public function scrape($query);
}