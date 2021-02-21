<?php

namespace Boot\Env;

final class Definitions {

    public static function getHashAlgorithms() 
    {   
        // Hash a plain password
        // $hash = $passwordHasher->hash('plain'); // returns a bcrypt hash

        // // Verify that a given plain password matches the hash
        // $passwordHasher->verify($hash, 'wrong'); // returns false
        // $passwordHasher->verify($hash, 'plain'); // returns true (valid)
        return [
            'common' => ['algorithm' => 'bcrypt'],
            'memory-hard' => ['algorithm' => 'sodium'],
        ]
    }
}