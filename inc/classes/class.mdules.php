<?php
class modules extends main {

  protected $errorMsg = array(
    '_HOMEPROBLEM' => 'Brak strony głównej',
    '_HOMEPROGEMLINK' => 'Nie znaleziono pliku strony głównej',
    '_MODULEPROBLEM' => 'Moduł %s nie został znaleziony',
    '_MODULEEXISTS' => 'Moduł %s nie istnieje',
    '_MODULEUNACTIVE' => 'Moduł %s nie został aktywowany',
    '_MODULEEMPTY' => 'Moduł nie został wybrany'
  );

  public function __construct()
  {
    global $db;
    $this->db = $db;
    parent::getConfig();
    define('MODULE_FILE', true);
  }

  public function setName()
  {
    if (isset($_GET['name'])) $this->getName = main::formatSQL($_GET['name']);
    else throw new Exeption($this->$errorMsg['_MODULEEMPTY']);
  }
  public function setFile()
  {
    $this->getFile = (isset($_GET['file'])) ? main::formatSQL($_GET['file']) : false;
  }

  public function getName()
  {
    return $this->getName;
  }
  public function getFile()
  {
    return $this->getFile;
  }

  public function homeModule()
  {
    try{
      include $this->getHomeModule();
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function checkBreak()
  {
    if ($this->mainConfig->site_break == 1 && !main::is_admin()) $this->showBreakPage();
  }

  private function showBreakPage()
  {
    global $classMain;
    $classMain->tpl('site-break.tpl');
    exit;
  }

  private function getHomeModule()
  {
    $row = $this->db->query('SELECT * FROM '.DB_PREFIX.'_main LIMIT 1')->fetch(PDO::FETCH_OBJ);
    if (!$row) throw new Exception($this->errorMsg['_HOMEPROBLEM']);
    else
    {
      $homeModuleLink = $this->moduleLink($row->main_func);
      if ($homeModuleLink) return $homeModuleLink;
      else throw new Exception($this->errorMsg['_HOMEPROGEMLINK']);
    }
  }
  private function checkFile()
  {
    if (!empty($_GET['file'])) return $this->formatSQL($_GET['file']).'.php'; else return false;
  }
  private function moduleLink($name)
  {
    $file = $this->checkFile();
    $file = ($file) ? $file : self::FUNCS_MAIN_FILE;
    $file_dir = self::FUNCS_DIR.'/'.$name.'/'.$file;
    if (file_exists($file_dir)) return $file_dir;
    else throw new Exception(sprintf($this->errorMsg['_MODULEEXISTS'], $name));
  }
  public function getModule($name)
  {
    $this->getModuleInfo($name);
    return $this->moduleLink($this->moduleInfo->title);
  }
  public function getModuleInfo($name)
  {
    $row = $this->db->query("SELECT * FROM ".DB_PREFIX."_funcs WHERE title='".$name."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
    if($row) $this->moduleInfo = $row;
    else throw new Exception(sprintf($this->errorMsg['_MODULEPROBLEM'], $name));
  }
  private function setModuleName()
  {
    $this->moduleName = $this->moduleInfo->title;
  }
  private function getModuleName()
  {
    return $this->moduleName;
  }
  public function checkActive()
  {
    if ($this->moduleInfo->active == 1) $this->moduleActive = true; else throw new Exeption(sprintf($this->errorMsg['_MODULEUNACTIVE'], $moduleInfo->custom_title));
  }
  public function getClassFile($name, $className)
  {
    include self::FUNCS_DIR.'/'.$name.'/'.self::INCLUDE_FOLDER_CLASSES.'/'.self::CLASS_FILE_PREFIX.'.'.$className.'.php';
  }
}
?>
