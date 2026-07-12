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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('first_name');
        });

        // Split existing data
        $customers = \Illuminate\Support\Facades\DB::table('customers')->get();
        foreach ($customers as $customer) {
            $parts = explode(' ', $customer->name, 2);
            $firstName = $parts[0] ?? '';
            $lastName = $parts[1] ?? '';
            
            \Illuminate\Support\Facades\DB::table('customers')
                ->where('id', $customer->id)
                ->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                ]);
        }

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
        });

        $customers = \Illuminate\Support\Facades\DB::table('customers')->get();
        foreach ($customers as $customer) {
            \Illuminate\Support\Facades\DB::table('customers')
                ->where('id', $customer->id)
                ->update([
                    'name' => trim($customer->first_name . ' ' . $customer->last_name),
                ]);
        }

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }
};
