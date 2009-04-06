<?php

class GoogleBlogScraper extends Scraper {

  protected $name = 'Google Blog Search';


  function scrape($query) {
    $page = scrape_page("http://blogsearch.google.com/blogsearch_feeds?hl=en&num=10&output=atom&q=" . $query);

    $doc = new SimpleXmlElement($page, LIBXML_NOCDATA);
    
    return $doc->entry;
  }
  
  function showResult($result) {
    echo "<li><p><a href='" . $result->link['href'] . "'>" . $result->title . "</a></p><p>" . $result->content . "</p><p>- <a href='" . $result->author->uri . "'>" . $result->author->name . "</a> <small>" . $result->published . "</small></p></li>";
  }

}

?>
