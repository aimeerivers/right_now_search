<?php

class GoogleNewsScraper extends Scraper implements Scraper_Interface {

   protected $name = 'Google News Search';


  function scrape($query) {
    $page = scrape_page("http://news.google.com/news?um=1&ned=us&hl=en&output=atom&q=" . $query);

    $doc = new SimpleXmlElement($page, LIBXML_NOCDATA);
    
    return $doc->entry;
  }
  
  function showResult($result) {
    echo "<li><p><a href='" . $result->link['href'] . "'>" . $result->title . "</a></p><p><small>" . $result->modified . "</small></p></li>";
  }

}

?>
