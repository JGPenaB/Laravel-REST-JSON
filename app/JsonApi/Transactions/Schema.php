<?php

namespace App\JsonApi\Transactions;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'transactions';

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
			'amount' => $resource->amount,
			'description' => $resource->description,
            'created-at' => $resource->created_at->toAtomString(),
        ];
    }
	
	public function getRelationships($resource, $isPrimary, array $includeRelationships){
		return [
			'accounts' => [
				self::SHOW_RELATED => true,
			],
		];
	}
}
