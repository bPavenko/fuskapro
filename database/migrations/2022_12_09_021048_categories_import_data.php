<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TaskCategory;
Use App\Models\TaskSection;

class CategoriesImportData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (($handle = fopen(storage_path('data.csv'), "r")) !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $section = TaskSection::where('name->ua', $data[0])->first();
                if (!$section) {
                    $section = TaskSection::create(['name' => [
                        'ua' => $data[0],
                        'en' => $data[0],
                        'cz' => $data[0]
                    ]]);
                }
                TaskCategory::create([
                    'parent_id' => $section->id,
                    'name' => [
                        'ua' => $data[1],
                        'en' => $data[1],
                        'cz' => $data[1]
                    ]
                ]);
            }
            fclose($handle);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
