<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloumToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->addColumn('string','intro',['length'=>255])->nullable();
            $table->addColumn('string','avatar',['length'=>255])->defualt('http://www.photophoto.cn/m15/032/004/0320040163.jpg');
            $table->addColumn('string','main_interesting',['length'=>255])->nullable();
            $table->addColumn('string','occupation',['length'=>255])->nullable();
            $table->addColumn('string','company_or_school',['length'=>255])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('intro');
            $table->removeColumn('avatar');
            $table->removeColumn('main_interesting');
            $table->removeColumn('occupation');
            $table->removeColumn('company_or_school');
        });
    }
}
