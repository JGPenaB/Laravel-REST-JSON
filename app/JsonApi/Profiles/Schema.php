<?php

namespace App\JsonApi\Profiles;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'profiles';

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
		    'first_name' => $resource->first_name,
			'last_name' => $resource->last_name,
			'address' => $resource->address,
			'country' => $resource->country,
			'phone_number' => $resource->phone_number,
			'zip_code' => $resource->zip_code,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }
	
	public function getRelationships($resource, $isPrimary, array $includeRelationships){
		return [
			'users' => [
				self::SHOW_RELATED => true,
			],
		];
	}
}
