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

class news extends main
{
	const FOLDER_IMAGES = 'img/news/';

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

	public function newsList($limit=false)
	{
		//count records
		$sql = "SELECT * FROM ".DB_PREFIX."_news";

		$result = $this->db->query($sql);
		$row = $result->fetch(PDO::FETCH_OBJ);

		//start pager class
		if (!$limit)
		{
			//pager class
			include_once 'inc/classes/class.pager.php';
			try{
				$pager = new Pager('');
				$pager->SetTotalRecords($result->rowCount());
				$pager->Make(true);
				$pag = $pager->Render();
				$start = $pager->GetIndexRecordStart();
				$end = $pager->GetIndexRecordEnd();
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		$limit = ($limit) ? $limit : $start.','.($end - $start + 1);

		//news
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_news ORDER BY date DESC LIMIT ".$limit);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->photo = glob(self::FOLDER_IMAGES.'mini_'.$row->photo.".*");
			$row->photo = $row->photo[0];
			$row->title = $this->textCut($this->classMain->setLangVar('title', $row), 63);
			$row->date = main::dateName($row->date);
			$row->text = $this->classMain->textCut(strip_tags($this->classMain->setLangVar('text_intro', $row)), 150);
			$row->href = 'funcs.php?name=news&amp;id='.$row->id;

			$this->classMain->dataTPLarrayList('n', $row, false);
		}
	}
	public function getArticle($id)
	{
		$id = $this->classMain->formatSQL($_GET['id'], 'int');
		$news = $this->db->query("SELECT * FROM ".DB_PREFIX."_news WHERE id=".$id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$photo = glob(self::FOLDER_IMAGES.'srednie_'.$news->photo.".*");
		if ($news->id)
		{
			$dataTPL = $news;
			$dataTPL->title = $this->classMain->setLangVar('title', $dataTPL);
			$dataTPL->text_intro = $this->classMain->setLangVar('text_intro', $dataTPL);
			$dataTPL->text = $this->classMain->setLangVar('text', $dataTPL);
			$dataTPL->photo = $photo[0];
			$this->classMain->dataTPLarray($dataTPL);
		}
	}
}

?>
