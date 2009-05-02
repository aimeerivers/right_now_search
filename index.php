<?php
/**
 * Right now search - a quick implementation of a multi-site searching tool :-)
 * 
 * @author Sermoa
 */

//enable all + strict errors :)
//error_reporting(E_ALL | E_STRICT);

/**
 * Autoloader for the classes
 *
 * @param string $class
 */
function __autoload ($class) {
	require_once 'classes/'.basename($class).'.php';
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

  <head>
    <title>Right Now Search <?=(isset($_GET['q']) && trim($_GET['q']) != '') ? "- " . stripslashes($_GET['q']) : '';?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="Author" content="Sermoa" />
    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/screen.css" />
  </head>
  
  <body>
    
    <a href="http://github.com/sermoa/right_now_search"><img id="forkme" src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub" /></a>

    <div id='search_options'>
      <form method='get'>
        <label for='search_input'>Search for:</label>
        <input type='text' id='search_input' name='q' value='<?=isset($_GET['q'])?stripslashes($_GET['q']):''; ?>' />
        <input type='submit' value='Go!' />
      </form>
    </div>

    <div id='results'>
    
		<?php
		if (isset($_GET['q']) && trim($_GET['q']) != '')
		{
			// $scrapers[] = new IdenticaScraper;
			$scrapers[] = new TwitterSearchScraper;
			$scrapers[] = new GoogleUkScraper;
			$scrapers[] = new GoogleNewsScraper;
			$scrapers[] = new GoogleBlogScraper;
			$scrapers[] = new TechnoratiScraper;
	
			foreach($scrapers as $scraper) {
				$scraper->fetchAndDisplayResults($_GET['q']);
			}
		}
		?>
        
    </div>
  </body>
</html>