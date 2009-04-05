<?php

class Scraper {

  function name() {
    return "Generic Scraper";
  }

  function scrape($query) {
    die('must be overridden');
  }
  
  function showResult($results) {
    die('must be overridden');
  }
  
  function showResults($results) {
    echo "<div class='results_column'>";
    echo "<h2>" . $this->name() . "</h2>";
    echo "<ul>";
    foreach($results as $result) {
      $this->showResult($result);
    }
    echo "</ul>";
    echo "</div>";
  }
  
  function fetchAndDisplayResults($query) {
    $results = $this->scrape($query);
    $this->showResults($results);
  }

}

?>
