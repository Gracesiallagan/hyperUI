
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();// Lukisan, Digital Art, Kriya, Tekstil
            $table->string('medium')->nullable();
            $table->integer('price')->default(0);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_sold')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
