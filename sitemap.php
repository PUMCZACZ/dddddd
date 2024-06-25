<?php

$max = 49000;
define('SITEMAPS_FOLDER', 'sitemaps/');

include_once 'inc/functions_main.php';

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');
//$xml->addAttribute('encoding', "UTF-8");
$files = array();

#$child = $xml->addChild('urlset');
#$child->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

$query = "SELECT * FROM ".DB_PREFIX."_items";
$result = $db->query($query);
$itemsCount = ceil($result->rowCount()/$max);

for ($i=0; $i<$itemsCount; $i++)
{
  $start = $i*$max;
  $end = ($i+1)*$max;
  $result = $db->query($query." LIMIT ".$start.", ".$end);
  while ($row = $result->fetch(PDO::FETCH_OBJ))
  {
    $track = $xml->addChild('url');
    $track->addChild('loc', $classMain->mainConfig->siteurl.'/'.$classMain->convertString($row->title_pl).'-'.$classMain->convertString($row->city).'-item-'.$row->id.'.html');
    $track->addChild('lastmod', date('c'));
  	$track->addChild('changefreq', 'always');
  	$track->addChild('priority', '0.8');
  }
  $newFile = SITEMAPS_FOLDER.'sitemap_'.$i.'.xml';
  $file = fopen($newFile,"wa+");
  fwrite($file, $xml->asXML());
  fclose($file);
  $files[] = $newFile;
}

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

#$child = $xml->addChild('sitemapindex');
#$child->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
foreach ($files as $key => $value)
{
  $track = $xml->addChild('sitemap');
  $track->addChild('loc', $classMain->mainConfig->siteurl.'/'.$value);
  $track->addChild('lastmod', date('c'));
}

$newFile = 'sitemap.xml';
$file = fopen($newFile,"wa+");
fwrite($file, $xml->asXML());
fclose($file);

?>
