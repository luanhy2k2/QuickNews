<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUpdatedByInCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi thay đổi cột
            $table->dropForeign(['updated_by']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('updated_by')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Thay đổi lại cột
            $table->string('updated_by')->nullable(false)->change();

            // Thêm lại khóa ngoại nếu cần
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
