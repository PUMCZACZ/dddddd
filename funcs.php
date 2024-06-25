<?php

include_once 'inc/functions_main.php';

$classModules->checkBreak();

try{

	$classModules->setName();
	$classModules->setFile();

	$name = $classModules->getName();
	$file = $classModules->getFile();

	if (isset($name) && $name == $_REQUEST['name'])
	{
		try {
			$moduleLink = $classModules->getModule($name);
			$classMain->getHeader();
			include $moduleLink;
			$classMain->getFooter();
		} catch(Exception $e) {
			$classMain->redirect('index.php', 'error', $e->getMessage());
		}
	}
	else
	{
		$classMain->redirect('index.php');
	}

} catch(Exeptions $e) {
	$classMain->redirect('index.php', 'error', $e->getMessage());
}
?>
