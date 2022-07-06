<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;


class ExampleTest extends TestCase
{
    use RefreshDatabase;


    private function createUser($role='user', $email='test2@test.com') {
        $user = new User();
        $user->name='Bipahu';
        $user->email=$email;
        $user->password=Hash::make('password');
        $user->is_verified = true;
        $user->verification_code=sha1(time());
       
       
        $user->role=$role;
        
        $user->save();
        return $user;
    }

    private function loginUser($email='test2@test.com') {
        $response = $this->post('login', [
            'email' => $email,
            'password' => 'password'
        ]);
    }

    private function createAdmin() {
        $user = new User();
        $user->name='Bipahu';
        $user->email='admin@test.com';
        $user->password=Hash::make('password');
        $user->is_verified = true;
        $user->verification_code=sha1(time());
       
       
        $user->role='admin';
        
        $user->save();
        return $user;
    }

    private function loginAdmin() {
        $response = $this->post('login', [
            'email' => 'admin@test.com',
            'password' => 'password'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_user()
    { 

        $user = $this->createUser();

        $user =  User::where('email','test2@test.com')->first();
        // $user =  User::find(1);

        
        $this->assertTrue(!!$user);
    }
    public function test_user_login() {

        $user = $this->createUser();

        $this->loginUser();
        
        $this->assertAuthenticated();
    }

    public function test_agent_login() 
    {
        Agent::create([
            'fullname' => 'Bipashu Thakur',
            'email' => 'aa@aa.aa',
            'password' => Hash::make('pass')
        ]);


        $response = $this->post('loggedin', ['email' => 'aa@aa.aa', 'password' => 'pass']);

        $response->assertStatus(200);
    }


    public function test_render_login_page() {
        $response = $this->get('agentlogin');
        $response->assertStatus(200);
    }
    

    public function test_render_property_page_unauthenticated() {
        $response = $this->get('property');
        $response->assertStatus(302);
    }


    public function test_render_property_page_authenticated() {
        $this->createUser();
        $this->loginUser();

        $response = $this->get('property');
        $response->assertStatus(200);
    }

    public function test_login_admin() {
        $this->createAdmin();
        $this->loginAdmin();
        $this->assertAuthenticated();
    }

    public function test_render_property_models_as_user() {
        $this->createUser();
        $this->loginUser();

        $response = $this->get('property-models');
        $response->assertStatus(302);
    }

    public function test_render_property_models_as_admin() {
        $this->createAdmin();
        $this->loginAdmin();

        $response = $this->get('property-models');
        $response->assertStatus(200);
    }


    public function test_login_premium_user() {
        $this->createUser($role='premiumUser', $email='premium@test.com');
        $this->loginUser($email='premium@test.com');
        $this->assertAuthenticated();
    }

    public function test_render_rent_property_models_page_as_premium_user() {
        $this->createUser($role='premiumUser', $email='premium@test.com');
        $this->loginUser($email='premium@test.com');

        $response = $this->get('rent-property-models');
        $response->assertStatus(200);
    }
    public function test_render_sell_property_models_page_as_premium_user() {
        $this->createUser($role='premiumUser', $email='premium@test.com');
        $this->loginUser($email='premium@test.com');

        $response = $this->get('sell-property-models');
        $response->assertStatus(200);
    }
    
    

    public function test_render_rent_property_models_page_as_user() {
        $this->createUser();
        $this->loginUser();

        $response = $this->get('rent-property-models');
        $response->assertStatus(302);
    }

    
}
