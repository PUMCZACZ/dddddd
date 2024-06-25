<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	NAZWA SKRYPTU:				SKRYPT AUKCYJNY					*/
/*	WERSJA:						1.01							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

class mainPage extends main
{
  const FOLDER_SLIDER = 'img/slider/';
  protected $infoMsg = array(
  );
  protected $errorMsg = array(
  );

  public function __construct()
  {
    global $db, $classMain;

    $this->db = $db;
    $this->classMain = $classMain;
  }
  public function slider($tpl_name='s', $block=0)
  {
    $no = 1;
    $result = $this->db->query("SELECT * FROM ".DB_PREFIX."_slider WHERE aktywne=1 AND block=".$block." ORDER BY pozycja ASC");
    while ($row = $result->fetch(PDO::FETCH_OBJ))
    {
      $row->no = $no;
      $row->obraz = self::FOLDER_SLIDER.$row->obraz;
      $this->classMain->dataTPLarrayList($tpl_name, $row);
      $no++;
    }
  }
  public function siteBreak()
  {
    if ($this->classMain->mainConfig->site_break && !$this->classMain->is_admin())
    {
      $this->classMain->tpl('site-break.tpl');
  		exit;
    }
	}

	public function subdomainCheck()
	{
		$siteMain = str_replace(array('http://', 'https://'), '', $this->classMain->mainConfig->siteurl);
		$siteMain = str_replace('www.', '', $siteMain);
		$siteMain = explode('.', $siteMain);
		$siteMain = $siteMain[0];

		$subdomena = str_replace('www.', '', $_SERVER['HTTP_HOST']);
		$subdomena = explode('.', $subdomena);
		$subdomena = $subdomena[0];

		if ($subdomena != 'localhost' && $subdomena != $siteMain)
		{

			//sprawdzanie czy subdomena istnieje/jest aktywna
			$row = $this->db->query("SELECT u.user_id, u.username, u.subdomain FROM ".DB_PREFIX."_users u
													WHERE u.subdomain='".$subdomena."' LIMIT 1")->fetch(PDO::FETCH_OBJ);

			if (empty($row->user_id))
      {
        $this->classMain->redirect($this->classMain->mainConfig->siteurl);
      }
			else
			{
        main::redirect('funcs.php?name=items&file=list&user_id='.$row->user_id.'&id=0&search=1&end=1');
				/*$funcsURLoff = true;
				$_GET['user_id'] = $row->user_id;
				$_GET['szukaj'] = 1;
				$_GET['end'] = 1;

				include 'funcs/items/list.php';
				exit;*/
			}
		}

	}
}

?>
