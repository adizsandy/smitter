<?php

namespace App\Module\Main\Module\Controller;

use App\Module\Main\Module\Model\User;

class UserController {
    
    public function login() 
    {   
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try {
            $user = $this->auth->entity('users'); // Get auth instance for users table
            $data = $this->request->request->all(); // $_POST data, but much secure
            if (! empty($data)) {
                $login_data = [ 'email' => $data['email'], 'password' => $data['password'] ];
                if ( $user->check() ) {
                    $response['message'] = 'Already Logged In';
                } else {
                    $resp = $user->login($login_data); // Perform Login Process, Returns users data if logged in
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

        return $this->response->json($response);
    }

    public function register() 
    {
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try { 
            
            $data = $this->request->request->all();  // $_POST data, but much secure
            // $files = $this->request->files->all(); // $_FILES data, All the files attached in the request

            if (! empty($data)) { 
                if ( $this->auth->entity('users')->check() ) { // Check for possible login
                    $response['message'] = 'Already Logged In, Cannot Register';
                } else {
                    $user_check = User::where(['email' => $data['email']])->first();
                    if (empty($user_check)) {
                        $user = new User(); // ORM part begins, user entity instance
                        $user->password = $this->auth->hash($data['password']); // Hash the password
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

        return $this->response->json($response);
    }

    public function logout () 
    {
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try { 
            $this->auth->entity('users')->logout();
            $response['success'] = true;
            $response['message'] = 'Logged out successfully';
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        } 

        return $this->response->json($response);
    }

    public function update() 
    {
        $response = [ 'success' => false, 'message' => '', 'data' => null ];

        try { 
            
            $data = $this->request->request->all();  // $_POST data, but much secure
            // $files = $this->request->files->all(); // $_FILES data, All the files attached in the request

            if (! empty($data)) { 
                if ( $this->auth->entity('users')->check() ) { // Check for possible login
                    $response['message'] = 'Already Logged In, Cannot Register';
                } else {
                    $user_check = User::where(['email' => $data['email']])->first();
                    if (empty($user_check)) {
                        $response['message'] = 'User with email not exists';
                    } else { 
                        $user = $user_check; // ORM part begins, user entity instance
                        if(isset($data['password'])) $user->password = $this->auth->hash($data['password']); // Hash the password
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

        return $this->response->json($response);
    }
    
}