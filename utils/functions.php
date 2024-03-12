<?php

use function PHPSTORM_META\type;

function getDateUpdate($date, $db = false)
{
  return $db ? date('Y-m-d', strtotime($date)) : date('d/m/Y', strtotime($date));
}

function convertXlsxForArray($file)
{
  $zip = new ZipArchive;

  if ($zip->open($file['tmp_name']) === true) {
    $xmlContent = $zip->getFromName('xl/sharedStrings.xml');
    $sharedStrings = simplexml_load_string($xmlContent);

    $xmlContent = $zip->getFromName('xl/worksheets/sheet1.xml');
    $sheetData = simplexml_load_string($xmlContent);

    $excelData = array();
    foreach ($sheetData->sheetData->row as $row) {
      $rowData = array();
      $rowIndex = (int)$row['r'];
      $currentColumnIndex = 0;
      foreach ($row->c as $cell) {
        $attr = $cell->attributes();
        $cellIndex = (string)$attr['r'];
        list($column, $row) = sscanf($cellIndex, "%[A-Z]%d");
        $columnIndex = array_search($column, range('A', 'Z')) + 1;

        while ($currentColumnIndex < $columnIndex - 1) {
          $rowData[] = '';
          $currentColumnIndex++;
        }
        $currentColumnIndex = $columnIndex;
        if (isset($attr['t']) && (string) $attr['t'] == 's') {
          $s = (int) $cell->v;
          $value = (string) $sharedStrings->si[$s]->t;
        } else {
          $value = (string) $cell->v;
        }
        $rowData[] = $value;
      }
      $excelData[] = $rowData;
    }


    $zip->close();
    return $excelData;
  }
}

function convertFileCSVOrXlsx($file)
{
  if (isset($file['type']) && $file['type'] === 'text/csv') {
    $dataFile = fopen($file['tmp_name'], 'r');

    $array = [];
    while ($line = fgetcsv($dataFile, 1000, ';')) {
      array_push($array, (object) array(
        'id' => $line[0],
        'name' => $line[1],
        'email' => $line[2],
        'product' => (object) array(
          'name' => explode(';', $line[3]),
          'price' => isset($line[5]) ? $line[5] : 0
        ),
        'request' => (object) array(
          'update_at' => $line[4]
        )
      ));
    }
    array_shift($array);
    return $array;
  } else if ($file['type'] === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
    $fileArray = convertXlsxForArray($file);

    $array = [];
    foreach ($fileArray as $key => $value) {
      if ($key > 0) {
        array_push($array, (object) array(
          'id' => $value[0],
          'name' => $value[1],
          'email' => $value[2],
          'product' => (object) array(
            'name' => explode(';', $value[3]),
            'price' => isset($value[5]) ? $value[5] : 0
          ),
          'request' => (object) array(
            'update_at' => $value[4]
          )
        ));
      }
    }

    return $array;
  } else {
    return [];
  }
}

function sanitizeField($field)
{
  return strip_tags(trim(filter_input(INPUT_POST, $field)));
}

function setHashPassword($email, $pass)
{
  return  hash('sha512', hash('sha512', sha1(sha1(md5(sha1((hash('sha512', $email . $pass . $email))))))));
}

function getUrl($path)
{
  $newPath = explode('/', $_SERVER['REQUEST_URI']);
  array_shift($newPath);

  $newPath = "http://{$_SERVER['SERVER_NAME']}/{$newPath[0]}/{$path}";

  return $newPath;
}

function isActive($array)
{
  $str = '';
  foreach ($array as $arr) {

    if (preg_match("/{$arr}/i", $_SERVER['REQUEST_URI'])) {
      $str = 'active';
      break;
    }
  }
  return $str;
}

function changeStringForNumber($str)
{
  if (is_numeric($str)) return $str;

  $array['um'] = 1;
  $array['dois'] = 2;
  $array['três'] = 3;
  $array['quatro'] = 4;
  $array['cinco'] = 5;
  $array['seis'] = 6;
  $array['sete'] = 7;
  $array['oito'] = 8;
  $array['nove'] = 9;
  $array['dez'] = 10;
  $array['onze'] = 11;
  $array['doze'] = 12;
  $array['treze'] = 13;
  $array['quatorze'] = 14;
  $array['quinze'] = 15;
  $array['dezesseis'] = 16;
  $array['dezessete'] = 17;
  $array['dezoito'] = 18;
  $array['dezenove'] = 19;
  $array['vinte'] = 20;
  $array['vinte e um'] = 21;
  $array['vinte e dois'] = 22;
  $array['vinte e três'] = 23;
  $array['vinte e quatro'] = 24;
  $array['vinte e cinco'] = 25;
  $array['vinte e seis'] = 26;
  $array['vinte e sete'] = 27;
  $array['vinte e oito'] = 28;
  $array['vinte e nove'] = 29;
  $array['trinta'] = 30;
  $array['trinta e um'] = 31;
  $array['trinta e dois'] = 32;
  $array['trinta e três'] = 33;
  $array['trinta e quatro'] = 34;
  $array['trinta e cinco'] = 35;
  $array['trinta e seis'] = 36;
  $array['trinta e sete'] = 37;
  $array['trinta e oito'] = 38;
  $array['trinta e nove'] = 39;
  $array['quarenta'] = 40;
  $array['quarenta e um'] = 41;
  $array['quarenta e dois'] = 42;
  $array['quarenta e três'] = 43;
  $array['quarenta e quatro'] = 44;
  $array['quarenta e cinco'] = 45;
  $array['quarenta e seis'] = 46;
  $array['quarenta e sete'] = 47;
  $array['quarenta e oito'] = 48;
  $array['quarenta e nove'] = 49;
  $array['cinquenta'] = 50;
  $array['cinquenta e um'] = 51;
  $array['cinquenta e dois'] = 52;
  $array['cinquenta e três'] = 53;
  $array['cinquenta e quatro'] = 54;
  $array['cinquenta e cinco'] = 55;
  $array['cinquenta e seis'] = 56;
  $array['cinquenta e sete'] = 57;
  $array['cinquenta e oito'] = 58;
  $array['cinquenta e nove'] = 59;
  $array['sessenta'] = 60;
  $array['sessenta e um'] = 61;
  $array['sessenta e dois'] = 62;
  $array['sessenta e três'] = 63;
  $array['sessenta e quatro'] = 64;
  $array['sessenta e cinco'] = 65;
  $array['sessenta e seis'] = 66;
  $array['sessenta e sete'] = 67;
  $array['sessenta e oito'] = 68;
  $array['sessenta e nove'] = 69;
  $array['setenta'] = 70;
  $array['setenta e um'] = 71;
  $array['setenta e dois'] = 72;
  $array['setenta e três'] = 73;
  $array['setenta e quatro'] = 74;
  $array['setenta e cinco'] = 75;
  $array['setenta e seis'] = 76;
  $array['setenta e sete'] = 77;
  $array['setenta e oito'] = 78;
  $array['setenta e nove'] = 79;
  $array['oitenta'] = 80;
  $array['oitenta e um'] = 81;
  $array['oitenta e dois'] = 82;
  $array['oitenta e três'] = 83;
  $array['oitenta e quatro'] = 84;
  $array['oitenta e cinco'] = 85;
  $array['oitenta e seis'] = 86;
  $array['oitenta e sete'] = 87;
  $array['oitenta e oito'] = 88;
  $array['oitenta e nove'] = 89;
  $array['noventa'] = 90;
  $array['noventa e um'] = 91;
  $array['noventa e dois'] = 92;
  $array['noventa e três'] = 93;
  $array['noventa e quatro'] = 94;
  $array['noventa e cinco'] = 95;
  $array['noventa e seis'] = 96;
  $array['noventa e sete'] = 97;
  $array['noventa e oito'] = 98;
  $array['noventa e nove'] = 99;
  $array['cem'] = 100;

  return $array[strtolower($str)];
}
