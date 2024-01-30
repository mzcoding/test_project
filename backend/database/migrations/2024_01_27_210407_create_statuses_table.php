<?php

declare(strict_types=1);

use App\Enums\TermRent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')
                ->cascadeOnDelete();
            $table->string('hash_code', 255);
            $table->boolean('is_rent')->default(false);
            $table->integer('term_rent')->nullable();
            $table->timestamp('term_rent_at')->nullable();
            $table->timestamps();

            $table->index(['hash_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
