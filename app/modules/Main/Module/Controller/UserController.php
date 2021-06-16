<?php

namespace App\Module\Main\Module\Controller;

use App\Module\Main\Module\Model\User;
use App\Module\Main\Module\Auth\Entity\UserAuth;

class UserController {
    
    public function login() 
    {   
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try {
            // Get user auth instance
            $userAuth = new UserAuth; 

            // All $_POST data, but much secure
            $data = request()->allPost(); 

            if (! empty($data)) { 
                if ( $userAuth->loggedIn() ) {
                    $response['message'] = 'Already Logged In';
                } else {
                    // Perform Login Process, Returns users data if logged in
                    $resp = $userAuth->tryLogin(); 
                    if ($resp) {
                        $response['success'] = true;
                        $response['message'] = 'Login Successfull';
                        $response['data'] = $resp->id;
                    } else {
                        $response['message'] = 'Login Failed!';
                    }
                }   
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        } 

        return response()->getJson($response);
    }

    public function register() 
    {
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try { 
            
            $data = request()->allPost();  // $_POST data, but much secure

            if (! empty($data)) {  
                // Get user auth instance
                $userAuth = new UserAuth;
                // Alternatively we may use :
                // $userAuth = auth()->entity(UserAuth::class);
                if ( $userAuth->loggedIn() ) { // Check for possible login
                    $response['message'] = 'Already Logged In, Cannot Register';
                } else {
                    $user_check = User::where(['email' => $data['email']])->first(); 
                    if (empty($user_check)) {
                        $user = new User(); // ORM part begins, user entity instance
                        $user->password = auth()->hash($data['password']); // Hash the password
                        $user->email = $data['email']; 
                        if ( $user->save($data) ) { // Save the data
                            $response['success'] = true;
                            $response['message'] = 'Registered successfully';
                            $response['data'] = User::select('email', 'id')->where(['email' => $data['email']])->first();
                        }
                    } else {
                        $response['message'] = 'User with email already exists';
                    } 
                }   
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        } 

        return response()->getJson($response);
    }

    public function logout () 
    {
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try { 
            auth()->entity(UserAuth::class)->tryLogout();
            $response['success'] = true;
            $response['message'] = 'Logged out successfully';
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        } 

        return response()->getJson($response);
    }

    public function update() 
    {
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try { 
            
            $data = request()->allPost();  // $_POST data, but much secure
            // $files = request()->allFiles(); // $_FILES data, All the files attached in the request

            if (! empty($data)) { 
                if ( auth()->entity(UserAuth::class)->loggedIn() ) { // Check for possible login
                    $response['message'] = 'Already Logged In, Cannot Register';
                } else {
                    $user_check = User::where(['email' => $data['email']])->first();
                    if (empty($user_check)) {
                        $response['message'] = 'User with email not exists';
                    } else { 
                        $user = $user_check; // ORM part begins, user entity instance
                        if(isset($data['password'])) $user->password = auth()->hash($data['password']); // Hash the password
                        $user->email = $data['email']; 
                        if ( $user->save($data) ) { // Save the data ( Actually updates here )
                            $response['success'] = true;
                            $response['message'] = 'Registered successfully';
                            $response['data'] = User::select('email', 'id')->where(['id' => $user_check->id])->first();
                        }
                    } 
                }   
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        } 

        return response()->getJson($response);
    }
    
}