<?php

class GoogleUKScraper extends Scraper {

  function name() {
    return "Google UK";
  }

  function scrape($query) {
    // get a page of results
    $page = scrape_page("http://www.google.co.uk/search?hl=en&num=20&q=" . urlencode($query));

    // get a list of organic SE links
    preg_match("/<li class=g>(.*)<\/cite>/", $page, $matches);
    $link_list = $matches[1];

    // get a list of URLS
    $link_list = str_replace("</cite>", "</cite>\n", $link_list);
    preg_match_all("/<h3 class=r><a href=\"(.*)\" class=(.*)\">(.*)<\/a><\/h3><div class=\"s\">(.*)<br><cite>/", $link_list, $matches, PREG_SET_ORDER);
    $link_list = $matches;

    return $link_list;
  }
  
  function showResult($result) {
    echo "<li><a href='" . $result[1] . "'>" . $result[3] . "</a><p>" . $result[4] . "</p></li>";
  }

}

?>
