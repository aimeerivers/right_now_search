<?php

class Scraper {
  
  protected $name = "Generic Scraper";
  
  public static function factory($type) {
    return new $type;
  }
  
  function showResults($results) {
    echo "<div class='results_column'>";
    echo "<h2>" . $this->name . "</h2>";
    echo "<ul>";
    if(count($results) == 0) {
      echo "<ul>No results found.</ul>";
    } else {
      foreach($results as $result) {
        $this->showResult($result);
      }
    }
    echo "</ul>";
    echo "</div>";
  }
  
  function fetchAndDisplayResults($query) {
    if($query == '') { return ""; }
    $results = $this->scrape(urlencode($query));
    $this->showResults($results);
  }

}

?>
