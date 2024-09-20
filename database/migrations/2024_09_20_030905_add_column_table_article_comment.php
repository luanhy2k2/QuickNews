<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    // Thêm cột approval vào bảng comment
    Schema::table('comments', function (Blueprint $table) {
        $table->enum('approval', ['pending', 'accepted', 'rejected'])->default('pending'); // Thêm giá trị mặc định nếu cần
    });

    // Thêm cột summary vào bảng articles
    Schema::table('articles', function (Blueprint $table) {
        $table->text('summary')->nullable(); // Đặt nullable nếu cần
    });

    // Tạo bảng notifications
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Sử dụng foreignId cho dễ quản lý
        $table->string('content');
        $table->string('title');
        $table->timestamps(); 
    });
    Schema::create('notification_status_reads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Sử dụng foreignId
        $table->boolean('is_seen')->default(false); // Đặt giá trị mặc định nếu cần
        $table->foreignId('notification_id')->constrained('notifications')->onDelete('cascade'); // Sử dụng foreignId
        $table->timestamps();
    });
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('notification_status_reads'); // Xóa bảng notification_status_reads trước
    Schema::dropIfExists('notifications'); // Xóa bảng notifications
    Schema::table('articles', function (Blueprint $table) {
        $table->dropColumn('summary'); // Xóa cột summary
    });
    Schema::table('comment', function (Blueprint $table) {
        $table->dropColumn('approval'); // Xóa cột approval
    });
}

};
