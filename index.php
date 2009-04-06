<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

  <head>
    <title>Right Now Search <?php if($_GET['q'] != '') { echo "- " . stripslashes($_GET['q']); } ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="Author" content="" />
    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/screen.css">
  </head>
  
  <body>
    <?php
    
      include('lib/scrape_page.php');
      include('classes/Scraper_Interface.php');
      include('classes/Scraper.php');
      include('classes/GoogleUkScraper.php');
      include('classes/GoogleNewsScraper.php');
      include('classes/GoogleBlogScraper.php');
      include('classes/TwitterSearchScraper.php');
      include('classes/TechnoratiScraper.php');
    ?>
    
    <a href="http://github.com/sermoa/right_now_search"><img style="position: absolute; top: 0; right: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub" /></a>

    <div id='search_options'>
      <form method='get'>
        <label for='search_input'>Search for:</label>
        <input type='text' id='search_input' name='q' value='<?php echo stripslashes($_GET['q']); ?>' />
        <input type='submit' value='Go!' />
      </form>
    </div>

    <div id='results'>
    
      <?php
        $scrapers[] = Scraper::factory('TwitterSearchScraper');
        $scrapers[] = Scraper::factory('GoogleUkScraper');
        $scrapers[] = Scraper::factory('GoogleNewsScraper');
        $scrapers[] = Scraper::factory('GoogleBlogScraper');
        $scrapers[] = Scraper::factory('TechnoratiScraper');
        
        foreach($scrapers as $scraper) {
          $scraper ->fetchAndDisplayResults($_GET['q']);
        }
      ?>
        
    </div>
  </body>
</html>
