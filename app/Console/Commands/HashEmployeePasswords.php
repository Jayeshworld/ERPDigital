<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashEmployeePasswords extends Command
{
    protected $signature = 'employee:hash-passwords';
    protected $description = 'Hash existing employee passwords using Bcrypt';

    public function handle()
    {
        $employees = DB::table('employeeDetails')->get();

        foreach ($employees as $employee) {
            DB::table('employeeDetails')
                ->where('id', $employee->id)
                ->update([
                    'password' => Hash::make($employee->vpassword) // Using the old password column for reference
                ]);
        }

        $this->info('Passwords have been hashed successfully!');
    }
}