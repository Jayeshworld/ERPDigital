<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employeeDetails', function (Blueprint $table) {
            // Rename the existing 'password' column to 'vpassword'
            $table->renameColumn('password', 'vpassword');

            // Add the new 'password' column after 'vpassword'
            $table->string('password')->after('vpassword');

            // Rename 'updatedDate' to 'updated_at' and set it to auto-update timestamps
            $table->renameColumn('updatedDate', 'updated_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->change();

            // Add 'created_at' column with default current timestamp
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::table('employeeDetails', function (Blueprint $table) {
            // Drop 'created_at' column
            $table->dropColumn('created_at');

            // Revert 'updated_at' back to 'updatedDate'
            $table->renameColumn('updated_at', 'updatedDate');

            // Drop the newly added 'password' column
            $table->dropColumn('password');

            // Rename 'vpassword' back to 'password'
            $table->renameColumn('vpassword', 'password');
        });
    }
};