<?php
const ACCOUNT_BUSINESS = 'business';
//if (!defined('MODULE_FILE')) die ("<b>Dostp bezpośredni zabroniony</b><br />You can't access this file directly...");

require 'funcs/items/classes/items.class.php';
$itemsClass = new items;

$getID = $classMain->formatSQL($_GET['id'], 'int');

$itemsClass->catsList($getID);

$rowCat = $db->prepare("SELECT * FROM ".DB_PREFIX."_users WHERE user_id=:id AND u_type=:utype LIMIT 1");
$rowCat->bindValue(':id', $getID, PDO::PARAM_INT);
$rowCat->bindValue(':utype', ACCOUNT_BUSINESS);
$rowCat->execute();
$row = $rowCat->fetch(PDO::FETCH_OBJ);

$rowCat1 = $db->prepare("SELECT title_pl, price, item_currency, city, post_code, address, phone, user_id FROM " . DB_PREFIX . "_items WHERE user_id=:id LIMIT 4");
$rowCat1->bindValue(':id', $getID, PDO::PARAM_INT);
$rowCat1->execute();
$row1 = $rowCat1->fetchAll(PDO::FETCH_OBJ);


$itemsClass->itemsList($getID);

$dataTPL['items'] = $row1;
$dataTPL['id'] = $row->user_id;
$dataTPL['company_name'] = $row->company_name;
$dataTPL['nip'] = $row->nip;
$dataTPL['email'] = $row->email;
$dataTPL['city'] = $row->city;
$dataTPL['post_code'] = $row->post_code;
$dataTPL['street'] = $row->street;
$dataTPL['phone'] = $row->phone;
$dataTPL['website'] = $row->website;
$dataTPL['avatar'] = $row->avatar;
$dataTPL['description'] = $row->description;
$dataTPL['fb'] = $row->social_fb;
$dataTPL['linkedin'] = $row->social_insta;

//1
$dataTPL['item1_title_pl'] = $row1[0]->title_pl;
$dataTPL['item1_city'] = $row1[0]->city;
$dataTPL['item1_post_code'] = $row1[0]->post_code;
$dataTPL['item1_address'] = $row1[0]->address;
$dataTPL['item1_user_id'] = $row1[0]->user_id;
$dataTPL['item1_end'] = round($row1[0]->end/86400) ;

//2
$dataTPL['item2_title_pl'] = $row1[1]->title_pl;
$dataTPL['item2_city'] = $row1[1]->city;
$dataTPL['item2_post_code'] = $row1[1]->post_code;
$dataTPL['item2_address'] = $row1[1]->address;
$dataTPL['item2_user_id'] = $row1[1]->user_id;
$dataTPL['item2_end'] = round($row1[1]->end/86400) ;

//3
$dataTPL['item3_title_pl'] = $row1[2]->title_pl;
$dataTPL['item3_item_currency'] = $row1[2]->item_currency;
$dataTPL['item3_city'] = $row1[2]->city;
$dataTPL['item3_post_code'] = $row1[2]->post_code;
$dataTPL['item3_address'] = $row1[2]->address;
$dataTPL['item3_user_id'] = $row1[2]->user_id;
$dataTPL['item3_end'] = round($row1[2]->end/86400) ;

//4
$dataTPL['item4_title_pl'] = $row1[3]->title_pl;
$dataTPL['item4_item_currency'] = $row1[3]->item_currency;
$dataTPL['item4_city'] = $row1[3]->city;
$dataTPL['item4_post_code'] = $row1[3]->post_code;
$dataTPL['item4_address'] = $row1[3]->address;
$dataTPL['item4_user_id'] = $row1[3]->user_id;
$dataTPL['item4_end'] = round($row1[3]->end/86400) ;


$classMain->dataTPLarray($dataTPL);

$classMain->tpl('company.tpl');