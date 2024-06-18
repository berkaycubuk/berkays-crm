<?php

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('subtotal');
            $table->decimal('tax_subtotal');
            $table->string('currency', 10);
            $table->string('status');
            $table->string('first_name');
            $table->string('last_name')->nullable;
            $table->string('company')->nullable();
            $table->text('address')->nullable;
            $table->string('city')->nullable;
            $table->string('country')->nullable;
            $table->string('postal_code', 50)->nullable;
            $table->string('tax_id')->nullable;
            $table->string('document_path')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
