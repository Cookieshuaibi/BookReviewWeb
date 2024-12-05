<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddBoodsUserIdTable extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(0);
        });
    }
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}