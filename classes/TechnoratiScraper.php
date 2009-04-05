<?php

class TechnoratiScraper extends Scraper {

  function name() {
    return "Technorati";
  }

  function scrape($query) {
    $page = scrape_page("http://feeds.technorati.com/search/" . $query . "?language=n");

    $doc = new SimpleXmlElement($page, LIBXML_NOCDATA);
    
    return $doc->channel->item;
  }
  
  function showResult($result) {
    echo "<li><p><a href='" . $result->link . "'>" . $result->title . "</a></p><p>" . $result->description . "</p><p><small>" . $result->pubDate . "</small></p></li>";
  }

}

?>
