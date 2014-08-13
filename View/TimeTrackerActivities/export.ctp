<?php
pr($timeTrackerActivities);

App::uses('Folder', 'Utility');
App::import('Vendor', 'PHPExcel/Classes/PHPExcel');

$path = APP . 'tmp' . DS . 'workdir' . DS . 'Stats' . DS . 'TripStat';
$dir = new Folder($path);
$dir->delete();
$dir->create($path);

$files = array();


foreach($trips as $trip) {

    if(empty($timeTrackerActivities)) {
        continue;
    }

    $filename = 'timetracker.xls';
    $file = $dir->pwd() . DS . $filename;


    $xls = new PHPExcel();

    // Liste des statistiques a afficher par défaut
    $statsToDisplay = array(
        'date',
        'user',
        'customer',
        'category',
        'duration',
    );

    // Si l'utilisateur à fournis une liste de statistique à afficher, on prend sa liste
    if(!empty($options['Column']['type'])){
        $statsToDisplay = $options['Column']['type'];
    }

    $statsSettings = array(
        'date'        			=> array('header' => __("Date")),
        'user'        			=> array('header' => __("Utilisateur")),
        'customer'        		=> array('header' => __("Client")),
        'category'        		=> array('header' => __("Catégorie")),
        'duration'        		=> array('header' => __("Durée")),
    );

    // Calcul du nombre de colonnes du fichier
    $width = max(10, count($statsToDisplay) + 1);

    $xls = new PHPExcel();

    $xls->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $xls->getActiveSheet()->getPageSetup()->setFitToPage(TRUE);



    // Création du titre du tableau
    $xls->getActiveSheet()->SetCellValue('A1', __("Statistiques de course par arrêt"));
    $xls->getActiveSheet()->mergeCells('A1:' . PHPExcel_Cell::stringFromColumnIndex($width - 1) . '1');
    $titleStyle = $xls->getActiveSheet()->getStyle('A1:' . PHPExcel_Cell::stringFromColumnIndex($width - 1) . '1');
    $titleStyle->getFont()->setSize(18);
    $titleStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $titleStyle->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

    // Création du tableau de clé-valeur
    $xls->getActiveSheet()->SetCellValue('B3', __("Exploitant") . ' : ')->SetCellValue('C3', $trip['TCompanyCompany']['name']);
    $xls->getActiveSheet()->SetCellValue('B4', __("Service") . ' : ')->SetCellValue('C4', $trip['NetworkTrip']['name']);
    $xls->getActiveSheet()->SetCellValue('B5', __("Capacité") . ' : ')->SetCellValue('C5', $trip['avg_vehicle_capacity']);
    $xls->getActiveSheet()->getStyle('B3:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $xls->getActiveSheet()->getStyle('B3:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $xls->getActiveSheet()->getStyle('B3:C5')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

    // Ajout d'un commentaire si la capacity a changé au cours de la période
    if(count(array_unique($trip['vehicleCapacity'])) > 1) {
        $xls->getActiveSheet()->getComment('C5')->getText()->createText(__("Cette course à été effectuée avec des cars de différente capacité : %s ", implode(', ', $trip['vehicleCapacity'])));
    }

    // Création du tableau de clé-valeur de la période
    $xls->getActiveSheet()->SetCellValue('E3', __("Moyenne sur la période du") . ' : ')->SetCellValue('F3', date('d/m/Y', strtotime($options['Period']['start'])));
    $xls->getActiveSheet()->SetCellValue('E4', __("Jusqu'au") . ' : ')->SetCellValue('F4', date('d/m/Y', strtotime($options['Period']['end'])));
    $xls->getActiveSheet()->getStyle('E3:F4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $xls->getActiveSheet()->getStyle('E3:F4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

    $currentLine = 7;

    // Début du tableau avec les headers
    $xls->getActiveSheet()->getStyle($currentLine)->getFont()->setBold(true);
    $xls->getActiveSheet()->setCellValueByColumnAndRow(0, $currentLine, __("Point d'arrêt"));
    foreach($statsToDisplay as $c => $statToDisplay){
        $xls->getActiveSheet()->setCellValueByColumnAndRow($c + 1, $currentLine, $statsSettings[$statToDisplay]['header']);
    }

    // On freeze le tableau a partir de la première valeur de la première colonne
    $xls->getActiveSheet()->freezePane('B8');

    // Pour chaque stoptime
    foreach ($trip['Stats'] as $r => $stopTime) {

        $currentLine++;


        $xls->getActiveSheet()->setCellValueByColumnAndRow(0, $currentLine, h($stopTime['NetworkStoppoint']['name']));
        foreach($statsToDisplay as $c => $statToDisplay) {

            // Si la colonne a un format particulier, on l'applique
            if(!empty($statsSettings[$statToDisplay]['format'])) {
                $xls->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($c + 1) . $currentLine)->getNumberFormat()->setFormatCode($statsSettings[$statToDisplay]['format']);
            }

            // Si la colonne est celle de l'écrat d'effectif, on créé une formule
            if($statToDisplay == 'avg_onboard_diff') {
                $t = array_search('avg_onboard_t', $statsToDisplay);
                $r = array_search('avg_onboard', $statsToDisplay);
                if($t && $r){
                    $xls->getActiveSheet()->setCellValueByColumnAndRow($c + 1, $currentLine, '=' . PHPExcel_Cell::stringFromColumnIndex($t + 1) . $currentLine . '-' . PHPExcel_Cell::stringFromColumnIndex($r + 1) . $currentLine);
                }
            } else { // Sinon  on affiche la valeur (si il y en a une)
                if(isset($stopTime['Stats']['custom'][$statToDisplay])) {
                    $xls->getActiveSheet()->setCellValueByColumnAndRow($c + 1, $currentLine, $stopTime['Stats']['custom'][$statToDisplay]);
                }
            }
        }

    }

    $currentLine++;

    // On ajoute les bordures
    $xls->getActiveSheet()->getStyle('A' . $currentLine . ':' . PHPExcel_Cell::stringFromColumnIndex(count($statsToDisplay)) . $currentLine)->getFont()->setBold(true);
    $xls->getActiveSheet()->getStyle('A7:' . PHPExcel_Cell::stringFromColumnIndex(count($statsToDisplay)) . $currentLine)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $xls->getActiveSheet()->getStyle('A7:' . PHPExcel_Cell::stringFromColumnIndex(count($statsToDisplay)) . $currentLine)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
    $xls->getActiveSheet()->getStyle('A7:' . PHPExcel_Cell::stringFromColumnIndex(count($statsToDisplay)) . '7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
    $xls->getActiveSheet()->getStyle('A' . $currentLine . ':' . PHPExcel_Cell::stringFromColumnIndex(count($statsToDisplay)) . $currentLine)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

    // On termine le tableau avec la ligne des totaux
    $totalLine = $currentLine;

    $xls->getActiveSheet()->setCellValueByColumnAndRow(0, $currentLine, __("Totaux"));
    foreach($statsToDisplay as $c => $statToDisplay){
        // Si la colonne a un format particulier, on l'applique
        if(!empty($statsSettings[$statToDisplay]['format'])) {
            $xls->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($c + 1) . $currentLine)->getNumberFormat()->setFormatCode($statsSettings[$statToDisplay]['format']);
        }
        // Si la colonne peut-etre additionnée
        if(!empty($statsSettings[$statToDisplay]['total']) && $statsSettings[$statToDisplay]['total'] == 'SUM'){
            $xls->getActiveSheet()->setCellValueByColumnAndRow($c + 1, $currentLine, '=SUM(' . PHPExcel_Cell::stringFromColumnIndex($c + 1) . '8:' . PHPExcel_Cell::stringFromColumnIndex($c + 1) . ($currentLine - 1) . ')');
        }
    }


    $currentLine++;
    $currentLine++;

    // On ajoute ensuite le tableau de conclusion avec quelques stats supplémentaires
    $xls->getActiveSheet()->getStyle('B' . $currentLine . ':C' . ($currentLine + 2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $xls->getActiveSheet()->getStyle('B' . $currentLine . ':C' . ($currentLine + 2))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $xls->getActiveSheet()->getStyle('B' . $currentLine . ':C' . ($currentLine + 2))->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

    // On calcule le nombre minimum de place disponible dans le car en moyenne
    $xls->getActiveSheet()->SetCellValue('B' . $currentLine, __("Places disponibles min :"));
    $index = array_search('avg_seats_available', $statsToDisplay);
    if($index !== false){
        $xls->getActiveSheet()->SetCellValue('C' . $currentLine, '=MIN(' . PHPExcel_Cell::stringFromColumnIndex($index + 1) . '8:' . PHPExcel_Cell::stringFromColumnIndex($index + 1) . (8 + count($trip['Stats']) - 1) . ')');
    }

    $currentLine++;

    // On calcule le taux de remplissage
    $xls->getActiveSheet()->SetCellValue('B' . $currentLine, __("Taux de remplissage :"));
    $xls->getActiveSheet()->getStyle('C' . $currentLine)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
    $indexBoarding = array_search('avg_boarding', $statsToDisplay);
    if($indexBoarding !== false){
        $xls->getActiveSheet()->SetCellValue('C' . $currentLine, '=' . PHPExcel_Cell::stringFromColumnIndex($indexBoarding + 1) . $totalLine . '/C5');
    }

    $currentLine++;

    // On calcule le taux d'usage
    $xls->getActiveSheet()->SetCellValue('B' . $currentLine, __("Taux d'usage :"));
    $xls->getActiveSheet()->getStyle('C' . $currentLine)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
    $indexBoardingT = array_search('avg_boarding_t', $statsToDisplay);
    $indexBoarding = array_search('avg_boarding', $statsToDisplay);
    if($indexBoardingT !== false && $indexBoarding !== false){
        $xls->getActiveSheet()->SetCellValue('C' . $currentLine, '=' . PHPExcel_Cell::stringFromColumnIndex($indexBoarding + 1) . (8 + count($trip['Stats'])) . '/' . PHPExcel_Cell::stringFromColumnIndex($indexBoardingT + 1) . (8 + count($trip['Stats'])));
    }

    // On resize les colonnes automatiquement
    for ($c = 0; $c < $width; $c++) {
        $xls->getActiveSheet()->getColumnDimensionByColumn($c)->setAutoSize(true);
    }

    PHPExcel_IOFactory::createWriter($xls, 'Excel5')->save($file);

    $files[] = $file;

}

// Si plus d'une course, on zip les exports
if(count($files) > 1){
    $exportFile = $dir->pwd() . DS . 'export.zip';
    $zip = new ZipArchive();
    if ($zip->open($exportFile, ZipArchive::CREATE) === TRUE) {
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
    }
    $zip->close();
}else{
    $exportFile = $files[0];
}

$this->response->file($exportFile, array('download' => true, 'name' => basename($exportFile)));
$this->response->send();
exit;

