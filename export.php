<?php
    error_reporting(0);
    require_once 'config/connect.php';
    require_once 'Classes/PHPExcel.php';
    $filename = "Отчет по оборудованию за ".date('d.m.Y').".xlsx";
    $phpexcel = new PHPExcel(); //Создаем класс объекта Excel
    //Подготовка основных переменных
    $headIDCells = 1;
    $bodyIDCells = 2;
    //Стиль для всех ячеек
    $sheetStyle = array(
        'font' => array(
            'name'      => 'Times New Roman',
            'size'      => 14,
        )
    );
    //Стиль для шапки
    $styleHead = array(
        'font' => array(
            'name'      => 'Times New Roman',
            'size'      => 16,               
            'bold'      => true,
        )
    );
    //Стиль для таблицы
    $styleBody = array(
        'borders'=>array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array(
                    'rgb' => '000000'
                    )
            )
        ),
    );
    //Подготовка шапки 
    $header = array(
        array(
            'name' => 'ID',
            'cell' => 'A',
            'width' => '12',
        ),
        array(
            'name' => 'Отдел',
            'cell' => 'B',
            'width' => '76',
        ),
        array(
            'name' => 'Категория',
            'cell' => 'C',
            'width' => '29',
        ),
        array(
            'name' => 'Инв/номер',
            'cell' => 'D',
            'width' => '26',
        ),
        array(
            'name' => 'Название',
            'cell' => 'E',
            'width' => '40',
        ),
    );
    //Массив (Ячейка => Номер записи)
    $arrCellID = ['A'=>0, 'B'=>1, 'C'=>2, 'D'=>3, 'E'=>4];
    //Подготовка листа Excel
    $phpexcel->setActiveSheetIndex(0);
    $sheet = $phpexcel->getActiveSheet();
    $sheet->setTitle('Отчет');
    $sheet->freezePane('A2'); //Фиксирование шапки
    $sheet->setAutoFilter('A1:E1');//Создание фильтра для шапки таблицы
    $sheet->getDefaultStyle()->applyFromArray($sheetStyle); //Стиль для всех ячеек
    $sheet->getStyle('A1:E1')->applyFromArray($styleHead); //Стиль для шапки
    $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Горизонтальное выравнивание по центру
    $sheet->getStyle('A1:E1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //Вертикальное выравнивание по центру
    
    //Вывод шапки
    foreach($header as $row){
        $string = $row['name']; //Значение записи в ячейку
        $cellLetter = $row['cell'].$headIDCells; //Имя ячейки для записи
        $width = $row['width']; //Ширина ячейки
        $sheet->setCellValueExplicit($cellLetter, $string, PHPExcel_Cell_DataType::TYPE_STRING);
        $sheet->getColumnDimension($row['cell'])->setWidth($width); //Установка ширины столбца
    }

    $SQL = "SELECT * FROM `technic`";
    if (isset($_GET['sort'])){
        $sort_sql = $_GET['sort'];
        $SQL .= "ORDER BY {$sort_sql}";
    }
    $technic = mysqli_query($connect, $SQL);
    $technic = mysqli_fetch_all($technic);

    //Вывод массив с данными в Excel файл
    $i = $bodyIDCells;
    foreach($technic as $row){ //
        foreach ($arrCellID as $cell=>$id) {
            $sheet->setCellValueExplicit($cell.$i, $row[$id],  PHPExcel_Cell_DataType::TYPE_STRING); //Запись значение из массива в ячейку
        }
        $i++;
    }
    $lastCells = $i - 1;
    $sheet->getStyle("A1:E".$lastCells)->applyFromArray($styleBody);//Рисуем границы таблицы

    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=".$filename);
    $file_path = __DIR__ . "/xlsx.tmp";
    $objWriter = new PHPExcel_Writer_Excel2007($phpexcel);
    $objWriter->save($file_path);
    readfile($file_path);
    unlink($file_path);
    header('Location: index.php');
    die();
?>