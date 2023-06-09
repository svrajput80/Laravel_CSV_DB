<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\LocalCommunity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function uploadcsv()
  {
    DB::disableQueryLog();
    // DB::table('products')->truncate();

    LazyCollection::make(function () {
      $handle = fopen(public_path("Bulk_Ledger_04_03_2021_17_13_28.csv"), 'r');
      
      while (($line = fgetcsv($handle, 4096)) !== false) {
        $dataString = implode(", ", $line);
        $row = explode(';', $dataString);
        yield $row;
      }

      fclose($handle);
    })
    // ->skip(1)
    ->chunk(10000)
    ->each(function (LazyCollection $chunk) {
      $records = $chunk->map(function ($row) {
      return [
        "row" => $row[0],
        // "sku" => $row[1],
        // "price" => $row[2]
      ];
      })->toArray();
      foreach($records as $data){
        $records = explode(',', $data['row']);
        echo "<pre>";
      print_r($records);
      }
    //   $records = explode(',', $records[0]['row']);
    //   echo "<pre>";
    //   print_r($records);
      die;
      DB::table('products')->insert($records);
    });
  }
}
