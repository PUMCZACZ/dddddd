<?php
class seo extends main
{
  private function generateSeoURL($string, $wordLimit = 0)
  {
    $separator = '-';

    if($wordLimit != 0)
    {
      $wordArr = explode(' ', $string);
      $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
    }

    $quoteSeparator = preg_quote($separator, '#');

    $trans = array(
      '&.+?;'                  => '',
      '[^\w\d _-]'             => '',
      '\s+'                    => $separator,
      '('.$quoteSeparator.')+' => $separator
    );

    $string = strip_tags($string);
    foreach ($trans as $key => $val) $string = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $string);

    $string = strtolower($string);

    return trim(trim($string, $separator));
  }

  protected function convertString($tekst)
  {
		$win = array("ą","ć","ę","ł","ń","ó","ś","ź","ż", "Ą","Ć","Ę","Ł","Ń","Ó","Ś","Ź","Ż"," - ","-"," ","!","","",",","\/","\.","\+","<",">","\"","%","&",";","'",":","\(","\)");
		$uni = array("a","c","e","l","n","o","s","z","z", "A","C","E","L","N","O","S","Z","Z","","","-","","","","","","","","","","","","","","","","");
		for ( $i=0; $i < count($win);$i++) $win[$i]="/".$win[$i]."/";
		$tekst = @preg_replace($win, $uni, htmlspecialchars_decode($tekst, ENT_QUOTES));

		return htmlspecialchars(strip_tags($tekst));
	}
}
?>
