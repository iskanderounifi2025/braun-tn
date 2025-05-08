<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->decimal('regular_price', 10, 2);
                $table->decimal('sale_price', 10, 2)->nullable();
                $table->string('SKU', 100)->nullable();
                $table->enum('stock_status', ['instock', 'outofstock'])->default('instock');
                $table->unsignedInteger('quantity')->default(0);
                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->bigInteger('sous_categorie_id')->unsigned()->nullable(); // Sous-catégorie
                $table->longText('specifications')->nullable()->check('json_valid(specifications)');
                $table->longText('additional_links')->nullable()->check('json_valid(additional_links)');
                $table->enum('status', ['published', 'draft'])->default('published');
                $table->string('type', 50)->nullable();
                $table->unsignedInteger('order')->default(0); // Remplaçant de "Publié"
                
                $table->timestamps();
                
                // Ajout des clés étrangères
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
                $table->foreign('sous_categorie_id')->references('id')->on('categories')->onDelete('set null');
            });
        }
        
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('products');
        }
    };
    
    

 