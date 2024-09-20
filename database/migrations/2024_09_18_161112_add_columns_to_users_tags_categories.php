<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTagsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Admin', 'Editor', 'Author', 'SupportStaff', 'Client'])
                  ->default('Client')
                  ->after('email');
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->text('describe')->nullable();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->text('describe')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Xóa cột 'role' từ bảng 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        // Xóa cột 'describe' từ bảng 'tags'
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('describe');
        });

        // Xóa cột 'describe' từ bảng 'categories'
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('describe');
        });
    }
}
