<?php

namespace Drupal\users_list\Controller;

use Drupal;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserController
{
    public function list_of_users()
    {
      $response = new Response();
      $response->headers->set('Pragma', 'no-cache');
      $response->headers->set('Expires', '0');
      $response->headers->set('Content-Type', 'application/vnd.ms-excel');
      $response->headers->set('Content-Disposition', 'attachment; filename=demo.xlsx');

      $spreadsheet = new Spreadsheet();

      $spreadsheet->getProperties()
        ->setCreator('Test')
        ->setLastModifiedBy('Test')
        ->setTitle("PHPExcel Demo")
        ->setLastModifiedBy('Test')
        ->setDescription('A demo to show how to use PHPExcel to manipulate an Excel file')
        ->setSubject('PHP Excel manipulation')
        ->setKeywords('excel php office phpexcel lakers')
        ->setCategory('programming');

      $spreadsheet->setActiveSheetIndex(0);
      $worksheet = $spreadsheet->getActiveSheet();

      $worksheet->setTitle('My File name');

      $query = Drupal::entityQuery('user');

      $uids = $query->execute();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', $uids);

      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      ob_start();
      $writer->save('php://output');
      $content = ob_get_clean();

      $spreadsheet->disconnectWorksheets();
      unset($spreadsheet);

      $response->setContent($content);
      return $response;
//      try {
//        $query = Drupal::entityQuery('user');
//
//        $uids = $query->execute();
//
//        $spreadsheet = new Spreadsheet();
//        $sheet = $spreadsheet->getActiveSheet();
//        $sheet->setCellValue('A1', $uids);
//        $writer = new Xlsx($spreadsheet);
//        return $writer->save('Drupal\users_list\Controller\users.xlsx');
//      }catch (Throwable $e) {
//        echo 'And my error is: ' . $e->getMessage();
//      }
//      $element = array(
//        '#markup' => 'Hello World!',
//      );
//      return $element;
    }
}
