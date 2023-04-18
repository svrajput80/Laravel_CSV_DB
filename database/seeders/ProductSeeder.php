<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LocalCommunity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class ProductSeeder extends Seeder 
  {
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
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
    ->skip(1)
    ->chunk(1000)
    ->each(function (LazyCollection $chunk) {
      $records = $chunk->map(function ($row) {
        dd($row);
      return [
        "name" => $row[0],
        "sku" => $row[1],
        "price" => $row[2]
      ];
      })->toArray();
      
      DB::table('products')->insert($records);
    });
  }
}
