<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AffiliatedOrganizationCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('affiliated_organization_infos', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('president_name');
            $table->string('president_image')->nullable();
            $table->string('gs_name');
            $table->string('gs_image')->nullable();
            $table->text('description');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->string('facebook_link');
            $table->string('instagram_link');
           
            $table->foreignIdFor(AffiliatedOrganizationCategory::class);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliated_organization_infos');
    }
};
