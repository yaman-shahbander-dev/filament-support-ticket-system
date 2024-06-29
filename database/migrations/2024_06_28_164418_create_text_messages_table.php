<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TextMessageStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('text_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->string('response')->nullable();
            $table->foreignId('sent_to')->constrained('users');
            $table->foreignId('sent_by')->constrained('users');
            $table->enum('status', TextMessageStatusEnum::getValues())->default(TextMessageStatusEnum::Pending->value);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_messages');
    }
};
