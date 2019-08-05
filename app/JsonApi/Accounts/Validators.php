<?php

namespace App\JsonApi\Accounts;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{
	
	protected $messages = [
		'account_type.required' => 'El tipo de cuenta debe ser especificado.',
		'account_type.string' => 'El tipo de cuenta no debe contener números ni carácteres especiales.',
		'balance.numeric' => 'El campo balance no debe contener letras ni carácteres especiales.',
		'balance.required' => 'El campo balance es requerido.',
		'is_active.required' => 'El campo is_active es requerido.',
		'is_active.boolean' => 'El campo is_active debe ser booleano. solo TRUE o FALSE.',
	];
    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = [];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = [];

    /**
     * Get resource validation rules.
     *
     * @param mixed|null $record
     *      the record being updated, or null if creating a resource.
     * @return mixed
     */
    protected function rules($record = null): array
    {
        return [
            'account_type' => 'string|required',
			'balance' => 'numeric|required',
			'is_active' => 'boolean|required'
        ];
    }

    /**
     * Get query parameter validation rules.
     *
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            //
        ];
    }

}
