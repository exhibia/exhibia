<?php

/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validUrl($url) {
//    $reg ='/^http\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(/\S*)?$/';
//    if (preg_match($reg, $url)==0) {
//        return false;
//    }else{
    return true;
//    }
}

function exportExcel($filename, $sheettitle, $exceldata) {
    include_once('../lib/phpexcel/Classes/PHPExcel.php');
    include_once('../lib/phpexcel/Classes/PHPExcel/Writer/Excel5.php');
    $excel = new PHPExcel();
    $writer = new PHPExcel_Writer_Excel5($excel);
    //$writer->setOffice2003Compatibility(true);
    $properties = $excel->getProperties();
    $properties->setCreator('');
    $properties->setTitle($filename);
    $sheet = $excel->getActiveSheet();
    $sheet->setTitle($sheettitle);

    $colfirst = ord('A');
    $rowfirst = 1;
    $col = $colfirst;
    $row = $rowfirst;


    foreach ($exceldata->keys as $key => $keyname) {
        $cell = chr($col) . $row;
        $sheet->setCellValue($cell, $keyname);
        $styleTitle = $sheet->getStyle($cell);
        $font = $styleTitle->getFont();
        $font->setBold(true);
        $styleTitle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->getColumnDimension(chr($col))->setAutoSize(true);
        $col++;
    }
    $row = $rowfirst + 1;
    $keys = array_keys($exceldata->keys);
    foreach ($exceldata->datas as $data) {
        $col = $colfirst;
        foreach ($keys as $key) {
            $sheet->setCellValue(chr($col++) . $row, $data[$key]);
        }
        $row++;
    }

    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition:inline;filename="' . $filename . '.xls' . '"');
    header("Content-Transfer-Encoding: binary");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");
    $writer->save('php://output');
}

?>
