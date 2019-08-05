<?php

namespace App\JsonApi\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'email' => $resource->email,
        ];
    }
	
	public function getRelationships($resource, $isPrimary, array $includeRelationships){
		return [
			'profiles' => [
				self::SHOW_RELATED => true,
			],
			'accounts' => [
				self::SHOW_RELATED => true,
			],
		];
	}
}
