<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->string('module')->nullable();
            $table->longText('issue')->nullable();
            $table->string('date_logged')->nullable();
            $table->bigInteger('qa_id')->nullable();
            $table->enum('qa_status', ['open', 'closed', 'unresolved'])->default('open');
            $table->bigInteger('dev_id')->nullable();
            $table->enum('dev_status', ['open', 'closed', 'unresolved'])->default('open');
            $table->string('date_fixed')->nullable();
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
        Schema::dropIfExists('project_issues');
    }
}
