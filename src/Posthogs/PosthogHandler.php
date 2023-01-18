<?php
    declare(strict_types=1);
    
    namespace App\Posthogs;
    
    //use PostHog\PostHog;
    use App\User\User;
    
    class PosthogHandler
    {
        public function __construct($env, string $key, string $baseUrl)
        {
    
            PostHog::init($key,
                array('host' => $baseUrl,
                    "debug" => true)
            );
    dump('post hog');
        }
    
        public function addEvent(string $eventName, User $user){
    
            PostHog::capture(array(
                'distinctId' => $user->getId()->id(),
                'event' => $eventName
            ));
        }
    
    }
