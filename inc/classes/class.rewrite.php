<?php
class rewrite extends main
{
  public function replace_for_mod_rewrite(&$s)
	{
		global $mainConfig;
		$urlin = array(
      "'(?<!/)funcs.php\?name=items&amp;id=([a-zA-Z0-9\-\_]+)&amp;title=([a-zA-Z0-9\-\_]+)&amp;city=([a-zA-Z0-9\-\_]+)'",
      "'(?<!/)funcs.php\?name=items&amp;file=list&amp;id=([a-zA-Z0-9\-\_]+)&amp;title=([a-zA-Z0-9\-\_]+)'",

      "'(?<!/)funcs.php\?name=news&amp;id=([a-zA-Z0-9\-\_]+)&amp;title=([a-zA-Z0-9\-\_]+)'",
					#"'(?<!/)funcs.php\?name=([a-zA-Z0-9\-\_]+)&amp;file=([a-zA-Z0-9\-\_]+)'",
          #"'(?<!/)funcs.php\?name=([a-zA-Z0-9\-\_]+)'",
		);

		$urlout = array(
      "\\2-\\3-item-\\1.html",
      "\\2-category-\\1.html",

      "\\2-article-\\1.html",
					#$this->mainConfig->siteurl."/\\1/\\2",
          #$this->mainConfig->siteurl."/\\1"
		);

		$s = preg_replace($urlin, $urlout, $s);
		return $s;
	}
}
?>
