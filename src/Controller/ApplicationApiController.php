<?php
/**
 * @file
 * Contains \Drupal\application_api\Controller\ApplicationApiController.
 */
namespace Drupal\application_api\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class ApplicationApiController{
    // Call method
	public function getAccess($key, NodeInterface $node){
		// Key configuration value
        $defaultKey = \Drupal::config('siteapikey.configuration')->get('siteapikey');
		//print_r($site_api_key_saved);die;
		if($node->getType() == 'advise_query' && $defaultKey != 'No API Key yet' && $defaultKey == $key){
            // JSON Return if true
            return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
        }

        // Access Denied if false
        return new JsonResponse(array("error" => "Access Denied"), 401, ['Content-Type'=> 'application/json']);
    }
}