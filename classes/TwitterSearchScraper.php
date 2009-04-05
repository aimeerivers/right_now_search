<?php

class TwitterSearchScraper extends Scraper {

  function name() {
    return "Twitter Search";
  }

  function scrape($query) {
    // get a page of results
    $page = scrape_page("http://search.twitter.com/search.json?rpp=20&q=" . urlencode($query));
    
    $results = json_decode($page);

    return $results->{'results'};
  }
  
  function showResult($result) {
    echo "<li><img src='" . $result->{'profile_image_url'} . "' class='avatar' /><p>" . $result->{'text'} . "</p><p>- <a href='http://twitter.com/" . $result->{'from_user'} . "/status/" . $result->{'id'} . "'>" . $result->{'from_user'} . "</a> <small>" . $result->{'created_at'} . "</small></p></li>";
  }

}

?>
