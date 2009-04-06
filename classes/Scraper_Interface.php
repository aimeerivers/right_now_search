<?php

interface Scraper_Interface {
  
  public  function showResults($results);
  public  function showResult($result);
  
  public  function scrape($query);
  
}
