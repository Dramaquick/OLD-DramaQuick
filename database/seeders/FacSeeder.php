<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DAnswer;
use App\Models\DQuestion;
use App\Models\DSession;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 100,
            'name' => 'testadmin',
            'email' => 'testadmin@test.test',
            'password' => Hash::make('testadmin'),
            'user_role' => 'ADMIN',
        ]);

        User::create([
            'id' => 101,
            'name' => 'testuser',
            'email' => 'testuser@test.test',
            'password' => Hash::make('testuser'),
        ]);

        DSession::create([
            'Session_Id' => 102,
            'Session_Title' => 'Test Session',
            'Session_Description' => 'This is a test session',
            'Session_MinUser' => 1,
            'Session_MaxUser' => 10,
            'Session_Speed' => 1,
            'Owner_Id' => 100,
            'Session_Status' => 'pending_start',
        ]);

        DQuestion::create([
            'Question_Title' => 'Test Question',
            'Question_Description' => 'This is a test question',
            'Question_Type' => 1,
            'Session_Id' => 102,
            'Question_Options' => 'option1,option2,option3',
        ]);

        DQuestion::create([
            'Question_Title' => 'Test Question',
            'Question_Description' => 'This is a test question',
            'Question_Type' => 2,
            'Session_Id' => 102,
            'Question_Options' => 'Null',
        ]);

        DQuestion::create([
            'Question_Title' => 'Test Question',
            'Question_Description' => 'This is a test question',
            'Question_Type' => 3,
            'Session_Id' => 102,
            'Question_Options' => 'Null',
        ]);

        DQuestion::create([
            'Question_Title' => 'Test Question',
            'Question_Description' => 'This is a test question',
            'Question_Type' => 4,
            'Session_Id' => 102,
            'Question_Options' => 'option1,option2,option3',
        ]);

        DQuestion::create([
            'Question_Title' => 'Test Question',
            'Question_Description' => 'This is a test question',
            'Question_Type' => 5,
            'Session_Id' => 102,
            'Question_Options' => 'option1,option2,option3',
        ]);

        DQuestion::create([
            'Question_Title' => 'Test Question',
            'Question_Description' => 'This is a test question',
            'Question_Type' => 6,
            'Session_Id' => 102,
            'Question_Options' => 'Null',
        ]);

        DQuestion::create([
            'Question_Title' => 'Test Question',
            'Question_Description' => 'This is a test question',
            'Question_Type' => 7,
            'Session_Id' => 102,
            'Question_Options' => '0,10,1',
        ]);
    }
}
