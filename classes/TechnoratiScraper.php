<?php

class TechnoratiScraper extends Scraper implements Scraper_Interface {

    protected $name = 'Technorati Search';


  function scrape($query) {
    $page = scrape_page("http://feeds.technorati.com/search/" . $query . "?language=en");

    $doc = new SimpleXmlElement($page, LIBXML_NOCDATA);
    
    return $doc->channel->item;
  }
  
  function showResult($result) {
    echo "<li><p><a href='" . $result->link . "'>" . $result->title . "</a></p><p>" . $result->description . "</p><p><small>" . $result->pubDate . "</small></p></li>";
  }

}

?>
