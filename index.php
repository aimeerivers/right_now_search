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
      include('classes/Scraper.php');
      include('classes/GoogleUkScraper.php');
      include('classes/GoogleNewsScraper.php');
      include('classes/GoogleBlogScraper.php');
      include('classes/TwitterSearchScraper.php');
      include('classes/TechnoratiScraper.php');
    ?>

    <div id='search_options'>
      <form method='get'>
        <label for='search_input'>Search:</label>
        <input type='text' id='search_input' name='q' value='<?php echo stripslashes($_GET['q']); ?>' />
        <input type='submit' value='Go!' />
      </form>
    </div>

    <div id='results'>
    
      <?php
        $scrapers[] = new TwitterSearchScraper;
        $scrapers[] = new GoogleUkScraper;
        $scrapers[] = new GoogleNewsScraper;
        $scrapers[] = new GoogleBlogScraper;
        $scrapers[] = new TechnoratiScraper;
        
        foreach($scrapers as $scraper) {
          $scraper ->fetchAndDisplayResults($_GET['q']);
        }
      ?>
        
    </div>
  </body>
</html>
