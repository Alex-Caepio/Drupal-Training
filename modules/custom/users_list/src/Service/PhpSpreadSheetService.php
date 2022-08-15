<?php

namespace Drupal\users_list\Service;

use Drupal;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Symfony\Component\HttpFoundation\Response;

class PhpSpreadSheetService
{
  public function spreadSheet()
    {
      $query = Drupal::entityQuery('user');

      $uids = $query->execute();

      $spreadsheet = new Spreadsheet();
      $spreadsheet->getActiveSheet()->fromArray($uids);

      $writer = new Xls($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="name-of-the-generated-file.xls"');
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }
}
