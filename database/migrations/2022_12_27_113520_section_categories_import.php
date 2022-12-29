<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TaskSection;
use App\Models\TaskCategory;

class SectionCategoriesImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (($handle = fopen(storage_path('Fuska1 - List 1.csv'), "r")) !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $section = TaskSection::where('name->cz', $data[2])->first();
                $section->name = [
                    'ua' => $data[0],
                    'en' => $data[1],
                    'cz' => $data[2]
                ];
                $section->save();

                $category = TaskCategory::where('name->cz', $data[5])->where('parent_id', $section->id)->first();

                $category->name = [
                    'ua' => $data[3],
                    'en' => $data[4],
                    'cz' => $data[5]
                ];
                $category->save();
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
