
<?php

ini_set('display_errors', "On");
require_once "../../db/reservation_settings.php"; 
require_once "../../db/entries.php"; 

  
     //データを配列にまとめる
     $newArr = array();

     $reservation_data = getAllData();

     foreach ($reservation_data as $k => $val) {
        $newItem = array();

        $entry = getEntry($val['id']);
        $count = 0;
      
        if(!empty($entry)){
            foreach ($entry as $item) {
                $count = $count + $item['count'];
            }
        }
        $left_seat = $val['count'] - $count;


        switch ($val['place']) {
            case 1:
                $newItem['title'] = '(' . $left_seat . '/' . $val['count'] .')'. '初任者講習(会員)';
                $newItem["color"] = '#99CCFF';
                break;
            case 2:
                $newItem['title'] = '(' . $left_seat . '/' . $val['count'] .')'.'初任者講習(非会員)';
                $newItem["color"] = '#CCCCCC';
                break;
            case 11:
                $newItem['title'] = '(' . $left_seat . '/' . $val['count'] .')'.'三重会場';
                $newItem["color"] = '#FF99FF';
                break;
            case 21:
                $newItem['title'] = '(' . $left_seat . '/' . $val['count'] .')'.'京都会場';
                $newItem["color"] = '#FFFF99';
                break;
            default:
                break;
        }


        $newItem["textColor"] = 'black';

        $newItem['start'] = $val['start_date'];
        $newItem['url'] = 'http://localhost:8888/management/reservation/detail/?id=' . $val["id"];


        $newArr[] = $newItem;
     }
     
     echo json_encode($newArr);



     

?>