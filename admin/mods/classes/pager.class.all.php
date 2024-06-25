<?php
/**
 * License
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 **/

/**
 * Klasa do generowania i obsĹugi pager'a
 * Klasa zapamietuje aktualnÄ stronÄ dodatkowo w sesji. DziÄki temu moĹźna skakaÄ po rĂłĹźnych linkach
 * a gdy siÄ wrĂłci na stronÄ z pager'em, to bÄdziemy na ostatnio wybranej stronie.
 *
 * @package MCM
 * @subpackage independent
 * @version 2.5.1 for PHP5
 * @author Robert (nospor) Nodzewski (email: nospor at interia dot pl)
 * @copyright 2005 - 2007 Robert Nodzewski
 * @license http://opensource.org/licenses/lgpl-license.php GNU Lesser General Public License
 **/

class Pager {
	/** StaĹe klasy */
	const GOTO_FIRST = 'gtf';
	const GOTO_PREV_X = 'gtpx';
	const GOTO_PREV = 'gtp';
	const GOTO_NEXT = 'gtn';
	const GOTO_NEXT_X = 'gtnx';
	const GOTO_LAST = 'gtl';
	const PAGES = 'pages';
	const PAGE = 'page';
	const LINK = 'link';
	const LINK_PAGE = 'lp';
	const LINK_SEP = 'ls';
	const PARAM_PAGE_NUMBER = 'ppn';
	const PAGES_PER_NAV = 'ppern';
	const TOTAL_RECORDS = 'tr';

	/** Podstawowy adres do kolejnych stron.*/
	protected $linkPage = '';

	/** Podstawowy adres do kolejnych stron.*/
	protected $userWholeLink = false;

	/** Czym poĹÄczyÄ parametr strony z adresem (? lub &) */
	protected $linkSep = '&amp;';

	/** Liczba rekordĂłw */
	protected $totalRecords = 0;

	/** IloĹÄ rekordĂłw na stronie */
	public $RecordsPerPage = 50;

	/** Numer aktualnej strony */
	protected $actualPage = 0;

	/** Liczba stron na pasku nawigatora */
	protected $pagesPerNav = 5;

	/** KtĂłra to jest x(_pagesOnNav) stron */
	protected $actualNavPages = 1;

	/** IloĹÄ x stron */
	protected $totalNavPages = 1;

	/** IloĹÄ wszystkich stron */
	protected $totalPages = 0;

	/** Index rekordu poczÄtkowego (od 0) */
	protected $indexRecordStart = null;

	/** Index rekordu koĹcowego (od 0) */
	protected $indexRecordEnd = null;

	/** Index strony poczÄtkowej */
	protected $indexPageStart;

	/** Index strony koĹcowej */
	protected $indexPageEnd;

	/** id pagera */
	protected $id;

	/** Nazwa parametru, w ktĂłrej bÄdzie numer aktualnej strony */
	protected $paramPageNumber;

	/** Nazwa parametru ogĂłlnego w url z numerem strony */
	public $GeneralParamPageNumber = 'page';

	private $useGeneralParam;
	/** Czy zapamiÄtywaÄ dane w sesji */
	protected $useSession = false;

	/** Tablica reprezentujÄca pager */
	protected $array = array();

	/** Komunikaty bĹÄdĂłw */
	protected $errorMsg = array(
		'call_get' => 'Method %s() You must call after Make()',
		'call_set' => 'Method %s() You must call before Make()',
		'wrong_parameter' => 'Wrong parameter "%s" in method "%s()"',
	);

	/**
	 * Konstruktor klasy
	 *
	 * @param string id - unikalne id pagera.
	 * @param string pageLink - adres, jaki bÄdzie generowny do linkĂłw w pagerze
	 * JeĹli pageLink zawiera ciÄg #PAGE#, oznaczaÄ to bÄdzie, iĹź link nie bÄdzie modyfikowany przez klase, tylko
	 * bÄdzie wyglÄdaĹ jak zapodaĹ uĹźytkownik. Jedyne co zostanie podmienione to #PAGE# na numer strony.
	 * JeĹli pageLink bÄdzie nullem, klasa wstawi parametr strony do linku uwzglÄdniajÄc przy tym wszystkie parametry jakie byĹy w linku.
	 * @param mixed userGeneralParam - czy jako parametru strony uĹźywaÄ parametru dla danego pagera, czy teĹź ogĂłlnego
	 * true - uzywaÄ
	 * false - nie uĹźywaÄ
	 * string - uzywaÄ i ustawiÄ takÄ nazwÄ parametru
	 * parametru okreĹlonego w $GeneralParamPageNumber
	 */
	public function __construct($id, $pageLink = '', $useGeneralParam = false) {
		$this->id = $id;
		if ($useGeneralParam){
			$this->useGeneralParam = true;
			if (is_string($useGeneralParam))
				$this->GeneralParamPageNumber = $useGeneralParam;
		} else
			$this->useGeneralParam = false;
		$this->paramPageNumber = $id;
		if (is_null($pageLink))
			$this->makeLink();
		else
			$this->linkPage = $pageLink;

		if (strpos($this->linkPage, '#PAGE#') !== false)
			$this->userWholeLink = true;
		if (!$this->userWholeLink && $this->linkPage && strpos($this->linkPage, '?') !== false)
			$this->linkSep = '&amp;';
	}

	/**
	 * Tworzy link pagera uwzglÄdniajÄc (zachowujÄc) przy tym wszystkie aktualne parametry w linku.
	 * Funkcja ustawia wĹaĹciwoĹÄ linkPage na taki link, jaki powinien juĹź byÄ. NaleĹźy o tym pamiÄtaÄ, jeĹli ktoĹ
	 * bÄdzie miaĹ ochotÄ modyfikowaÄ tÄ funkcjÄ.
	 */
	protected function makeLink(){
		//TODO: pomyslec cos z niceurl
		//pobranie nazwy parametru z $_GET
		$paramPageNumber = $this->getUrlParamPageNumber();

		//wyrzucenie go z REQUEST_URI jeĹli byĹ
		$this->linkPage = $paramPageNumber ? preg_replace('/&?'.$paramPageNumber.'=\d*/','', $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI'];
	}

	/**
	 * Ustawia uĹźywanie sesji
	 *
	 * @param boolean $useSession
	 * @return true
	 */
	public function SetUseSession($useSession) {
		$this->useSession = $useSession;
		return true;
	}

	/**
	 * Ustawiamy liczbÄ rekordĂłw na stronie
	 *
	 * @param int $rpp liczba rekordĂłw na stronie
	 * @return true
	 */
	public function SetRecordsPerPage($rpp) {
		if (!is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_set'], 'SetRecordsPerPage'));
		$this->RecordsPerPage = (int) $rpp;
		return true;
	}
	/**
	 * Ustawiamy liczbÄ stron w nawigatorze
	 *
	 * @param int $pon liczba stron w nawigatorze
	 * @return true
	 */
	public function SetPagesPerNav($pon) {
		if (!is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_set'], 'SetPagesPerNav'));
		$this->pagesPerNav = (int) $pon;
		return true;
	}

	/**
	 * Ustawiamy liczbÄ wszystkich rekordĂłw
	 *
	 * @param int $count liczba wszystkich rekordĂłw
	 * @return true
	 */
	public function SetTotalRecords($count) {
		if (!is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_set'], 'SetTotalRecords'));
		$this->totalRecords = (int) $count;
		return true;
	}

	/**
	 * Zwraca index rekordu poczÄtkowego (od 0)
	 *
	 * @return int
	 */
	public function GetIndexRecordStart() {
		if (is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_get'],'GetIndexRecordStart'));
		return $this->indexRecordStart;
	}

	/**
	 * Zwraca index rekordu koĹcowego (od 0)
	 *
	 * @return int
	 */
	public function GetIndexRecordEnd() {
		if (is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_get'],'GetIndexRecordEnd'));
		return $this->indexRecordEnd;
	}

	/**
	 * Zwraca liczbÄ wszystkich stron
	 *
	 * @return int
	 */
	public function GetTotalPages() {
		return $this->totalPages;
	}

	/**
	 * Zwraca tablicÄ pager'a
	 *
	 * @return array
	 */
	public function GetArray() {
		if (is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_get'],'GetArray'));
		return $this->array;
	}

	/**
	 * Ustawia numer aktulnej strony.
	 * Zaleca siÄ nie uĹźywaÄ tej metody, chyba Ĺźe naprawdÄ istnieje potrzeba
	 *
	 * @param int $page numer aktualnej strony
	 * @return true
	 */
	public function SetActualPage($page) {
		if (!is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_set'], 'SetActualPage'));
		$this->actualPage = (int) $page;
		return true;
	}

	/**
	 * Zwraca numer aktulnej stony
	 *
	 * @return int
	 */
	public function GetActualPage() {
		if (is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_get'],'GetActualPage'));
		return $this->actualPage;
	}

	/**
	 * Zwraca nazwÄ parametru wygenerowanego dla pagera.
	 *
	 * @return string
	 */
	public function GetParamPageNumber() {
		if (is_null($this->indexRecordStart))
			throw new Exception(sprintf($this->errorMsg['call_get'],'GetParamPageNumber'));
		return $this->useGeneralParam ? $this->GeneralParamPageNumber : $this->paramPageNumber;
	}

	protected function getUrlParamPageNumber(){
		return isset($_GET[$this->paramPageNumber]) ? $this->paramPageNumber : (isset($_GET[$this->GeneralParamPageNumber]) ? $this->GeneralParamPageNumber : null);
	}
	public function GetProbablyActualPage(){
		$paramPageNumber = $this->getUrlParamPageNumber();
		$actPage = $paramPageNumber ?  ((int) $_GET[$paramPageNumber]) : 0;
		if ($actPage <= 0 && isset($_SESSION) && $this->useSession)
			$actPage = isset($_SESSION[$this->paramPageNumber]) ? ((int) $_SESSION[$this->paramPageNumber]) : 0;
		if ($actPage <= 0)
			$actPage = 1;
		return $actPage;
	}
	 /**
	 * Wylicza wszystkie niezbÄdne dane (aktualna strona, jakie indexy pobieraÄ). Generuje tablicÄ pagera
	 *
	 * @param boolean $smartRange czy uĹźywaÄ zmiennych zasiÄgĂłw
	 * @return array Tablica pagera
	 */
	public function Make($smartRange = false) {
		if ($this->actualPage <= 0)
			$this->actualPage = $this->GetProbablyActualPage();

		$this->totalPages = (int) ceil($this->totalRecords / $this->RecordsPerPage);
		if ($this->actualPage > $this->totalPages)
			$this->actualPage = $this->totalPages;

		$this->totalNavPages = (int) ceil($this->totalPages / $this->pagesPerNav);
		$this->actualNavPages = (int) ceil($this->actualPage / $this->pagesPerNav);
		$this->indexRecordStart = ($this->actualPage - 1) * $this->RecordsPerPage;
		if ($this->indexRecordStart < 0)
			$this->indexRecordStart = 0;
		$this->indexRecordEnd = $this->indexRecordStart + $this->RecordsPerPage - 1;
		if ($this->indexRecordEnd + 1  > $this->totalRecords)
			$this->indexRecordEnd = $this->totalRecords - 1;
		if ($this->indexRecordEnd < 0)
			$this->indexRecordEnd = 0;

		if (!$smartRange){
			$this->indexPageStart = ($this->actualNavPages - 1) * $this->pagesPerNav + 1;
			$this->indexPageEnd = $this->actualNavPages * $this->pagesPerNav;
			if ($this->totalPages < $this->indexPageEnd)
				$this->indexPageEnd = $this->totalPages;
		} else {
			$halfPagesOnNav = (int) ($this->pagesPerNav / 2);
			$this->indexPageStart = $this->actualPage - $halfPagesOnNav;
			$rest = 0;
			if ($this->indexPageStart < 1) {
				$rest = abs($this->indexPageStart) + 1;
				$this->indexPageStart = 1;
			}
			$this->indexPageEnd = $this->actualPage + $halfPagesOnNav + $rest;
			if ($this->indexPageEnd > $this->totalPages){
				$this->indexPageStart -= ($this->indexPageEnd - $this->totalPages);
				if ($this->indexPageStart < 1) $this->indexPageStart = 1;
				$this->indexPageEnd = $this->totalPages;
			}
		}

		if (isset($_SESSION) && $this->useSession)
			$_SESSION[$this->paramPageNumber] = $this->actualPage;
		return $this->toArray();
	}

	 /**
	 * Generuje html odpowiadajÄcy pager'owi
	 *
	 * @param mixed $externFunction zewnÄtrzna funkcja, ktĂłra bÄdzie generowaĹa kod pager'a na podstawie podanej tablicy.
	 * MoĹźe to byÄ string bÄdÄcy nazwÄ funkcji, bÄdĹş teĹź tablica dwuelementowa, ktĂłrej pierwszym elementem jest nazwa klasy
	 * a drugim nazwa metody tej klasy. Do zewnÄtrznej funkcji zostanie zapodana tablica reprezentujÄca pager.
	 * @return string
	 */
	public function Render($externFunction = null) {
		if ($externFunction && !(is_string($externFunction) ||
			(is_array($externFunction) && count($externFunction) == 2) && is_string($externFunction[0]) && is_string($externFunction[1])))
			throw new Exception(sprintf($this->errorMsg['wrong_parameter'], '$externFunction','Render'));
		if ($externFunction)
			return call_user_func($externFunction, $this->array);
		else
			return $this->toString();
	}

	/**
	 * Tworzy tablicÄ reprezentujÄcÄ pager. Tablica skĹada siÄ z nastÄpujĹĄcych indexĂłw reprezentowanych przez staĹe:
	 * - GOTO_FIRST - idĹş do pierwszej strony
	 * - GOTO_PREV_X - idĹş do x kolejnej strony
	 * - GOTO_PREV - idĹş do poprzedniej strony
	 * - GOTO_NEXT - idĹş do nastÄpnej strony
	 * - GOTO_NEXT_X - idĹş do x nastÄpnej strony
	 * - GOTO_LAST - idĹş do ostaniej strony
	 * wartoĹciÄ dla powyĹźszych indexĂłw jest tablica o indexach:
	 * 	- PAGE - numer strony
	 *  - LINK - peĹny link do tej strony
	 * - PAGES - zawiera tablicÄ, ktĂłrej indexami sÄ numery stron wyĹwietlanych w pagerze,
	 * a wartoĹciÄ jest false (jest to strona aktualna - bez linku) lub string (peĹny link do danej strony)
	 * - LINK_PAGE - link do strony (bez wstawionego numeru strony)
	 * - LINK_SEP - separator
	 * - PARAM_PAGE_NUMBER - nazwa parametru, w ktĂłrej bÄdzie numer aktualnej strony
	 * - PAGES_PER_NAV - liczba stron na pasku nawigatora
	 * - TOTAL_RECORDS - OgĂłlna liczba rekordĂłw
	 * @return true
	 */
	protected function toArray() {
		$link = $this->linkPage;
		if (!$this->userWholeLink)
			$link.=$this->linkSep.($this->useGeneralParam ? $this->GeneralParamPageNumber : $this->paramPageNumber).'=';
		if ($this->indexPageStart > 1)
			$this->array[self::GOTO_FIRST] = array(self::PAGE => 1, self::LINK =>$this->createLink($link, 1));
		if ($this->actualPage - $this->pagesPerNav > 0)
			$this->array[self::GOTO_PREV_X] = array(self::PAGE => $this->actualPage - $this->pagesPerNav, self::LINK =>$this->createLink($link, $this->actualPage - $this->pagesPerNav));
		if ($this->actualPage > 1)
			$this->array[self::GOTO_PREV] = array(self::PAGE => $this->actualPage - 1, self::LINK =>$this->createLink($link, $this->actualPage - 1));

		//strony
		$this->array[self::PAGES] = array();
		for ($i = $this->indexPageStart; $i <= $this->indexPageEnd; $i++) {
			if ($i == $this->actualPage)
				$this->array[self::PAGES][$i] = false;
			else
				$this->array[self::PAGES][$i] = $this->createLink($link, $i);
		}

		if ($this->actualPage < $this->totalPages)
			$this->array[self::GOTO_NEXT] = array(self::PAGE => $this->actualPage + 1, self::LINK =>$this->createLink($link,$this->actualPage + 1));
		if ($this->actualPage + $this->pagesPerNav <=$this->totalPages)
			$this->array[self::GOTO_NEXT_X] = array(self::PAGE => $this->actualPage + $this->pagesPerNav, self::LINK =>$this->createLink($link, $this->actualPage + $this->pagesPerNav));
		if ($this->indexPageEnd < $this->totalPages)
			$this->array[self::GOTO_LAST] = array(self::PAGE => $this->totalPages, self::LINK =>$this->createLink($link, $this->totalPages));


		$this->array[self::LINK_PAGE] = $this->linkPage;
		$this->array[self::LINK_SEP] = $this->linkSep;
		$this->array[self::PARAM_PAGE_NUMBER] = $this->useGeneralParam ? $this->GeneralParamPageNumber : $this->paramPageNumber;
		$this->array[self::PAGES_PER_NAV] = $this->pagesPerNav;
		$this->array[self::TOTAL_RECORDS] = $this->totalRecords;
		return true;
	}

	/**
	 * Zwraca string reprezentujÄcy kod html pager'a
	 *
	 * @return string
	 */
	protected function toString() {

		if ($this->totalRecords <= $this->RecordsPerPage)
			return '';
		$_str = '';
		$sep = '';
		if (isset($this->array[self::GOTO_FIRST]))
			$_str .= $this->createHTMLLink('Pierwsza strona', $this->array[self::GOTO_FIRST][self::LINK], 1).$sep;
		if (isset($this->array[self::GOTO_PREV_X]))
			$_str .= $this->createHTMLLink($this->array[self::PAGES_PER_NAV].' stron(y) do tyłu', $this->array[self::GOTO_PREV_X][self::LINK], '&laquo;&laquo;').$sep;
		if (isset($this->array[self::GOTO_PREV]))
			$_str .= $this->createHTMLLink('Poprzednia strona', $this->array[self::GOTO_PREV][self::LINK], '&laquo;').$sep;

		foreach ($this->array[self::PAGES] as $_page => $_pageLink)
		{
				$_str .= $this->createHTMLLink("Strona ".$_page, $_pageLink, $_page);
		}

		if (isset($this->array[self::GOTO_NEXT]))
			$_str .= $this->createHTMLLink('Następna strona', $this->array[self::GOTO_NEXT][self::LINK], '&raquo;');
		if (isset($this->array[self::GOTO_NEXT_X]))
			$_str .= $sep.$this->createHTMLLink($this->array[self::PAGES_PER_NAV].' stron(y) do przodu', $this->array[self::GOTO_NEXT_X][self::LINK], '&raquo;&raquo;');
		if (isset($this->array[self::GOTO_LAST]))
			$_str .= $this->createHTMLLink('Ostatnia strona', $this->array[self::GOTO_LAST][self::LINK], $this->totalPages);

		return $_str;
	}


	/**
	 * Generuje html podanego linku
	 *
	 * @param string $title tytuĹ linku
	 * @param string $link link
	 * @param string $text text linku
	 * return string
	 */
	protected function createHTMLLink($title, $link, $text)
	{
		$linkForm = $_GET;
		unset($linkForm['p']);
		$linkForm = http_build_query($linkForm);
		$active = (empty($link)) ? ' active' : false;
		#$linkForm .= (isset($_GET['file']) && !empty($_GET['file'])) ? '&amp;op='.$_GET['op'] : false;
		return ' <li class="page-item'.$active.'"><a class="page-link" title="'.$title.'" href="'.ADMIN_FILE.'.php?'.$linkForm.$link.'">'.$text.'</a></li>';
	}

	protected function createLink($link, $page){
		return $this->userWholeLink ? str_replace('#PAGE#', $page, $link) : $link.$page;
	}
}
?>
