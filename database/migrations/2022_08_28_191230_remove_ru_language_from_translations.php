<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Brackets\AdminTranslations\Translation;

class RemoveRuLanguageFromTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $translations = Translation::all();
        foreach ($translations as $translation) {
            $translationText = $translation->text;
            if (isset($translationText['ru'])) {
                $translationText['ua'] = $translationText['ru'];
                unset($translationText['ru']);
                $translation->text = $translationText;
                $translation->save();
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translations', function (Blueprint $table) {
            //
        });
    }
}
