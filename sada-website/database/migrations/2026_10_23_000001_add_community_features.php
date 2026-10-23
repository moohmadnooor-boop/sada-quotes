<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable();
            $table->boolean('is_admin')->default(false);
        });

        Schema::table('quotes', function (Blueprint $table) {
            $table->string('category', 60)->default('عام');
            $table->string('mood', 40)->nullable();
            $table->string('source')->nullable();
            $table->date('challenge_on')->nullable()->index();
        });

        Schema::create('quote_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'quote_id']);
        });

        Schema::create('quote_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'quote_id']);
        });

        Schema::create('quote_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
            $table->string('content', 500);
            $table->timestamps();
        });

        Schema::create('user_follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('followed_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['follower_id', 'followed_id']);
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name', 80);
            $table->timestamps();
        });

        Schema::create('collection_quote', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['collection_id', 'quote_id']);
        });

        Schema::create('quote_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
            $table->string('reason', 180);
            $table->boolean('resolved')->default(false);
            $table->timestamps();
            $table->unique(['user_id', 'quote_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_reports');
        Schema::dropIfExists('collection_quote');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('user_follows');
        Schema::dropIfExists('quote_comments');
        Schema::dropIfExists('quote_favorites');
        Schema::dropIfExists('quote_likes');
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['category', 'mood', 'source', 'challenge_on']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'is_admin']);
        });
    }
};
