<?php

namespace Drupal\users\Controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController
{
    public function list_of_users()
    {
      $query = Drupal::entityQuery('user');

      $uids = $query->execute();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', $uids);

      $writer = new Xlsx($spreadsheet);
      $writer->save('users.xlsx');
    }
}
