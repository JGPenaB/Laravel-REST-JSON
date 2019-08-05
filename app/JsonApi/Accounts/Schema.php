<?php

namespace App\JsonApi\Accounts;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'accounts';

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
            'account_type' => $resource->account_type,
			'balance' => $resource->balance,
			'is_active' => $resource->is_active,
			'created-at' => $resource->created_at->toAtomString(),
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
