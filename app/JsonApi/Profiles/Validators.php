<?php

namespace App\JsonApi\Profiles;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{
	
	protected $messages = [
		'first_name.required' => 'El primer nombre es requerido.',
		'first_name.regex' => 'El primer nombre no debe contener números o símbolos.',
		'last_name.required' => 'El apellido es requerido.',
		'last_name.regex' => 'El apellido no debe contener números o símbolos.',
		'address.required' => 'La dirección es requerida.',
		'country.required' => 'El país es requerido.',
		'country.regex' => 'El país no debe contener números o carácteres especiales.',
		'phone_number.required' => 'El número telefónico es requerido.',
		'phone_number.numeric' => 'El número telefónico debe ser solo números.',
		'zip_code.numeric' => 'El código zip debe ser solo números.',
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
            'first_name' => 'regex:/^[a-zA-Z]+$/|required',
			'last_name' => 'regex:/^[a-zA-Z]+$/|required',
			'address' => 'required',
			'country' => 'regex:/^[a-zA-Z\s]+$/|required',
			'phone_number' => 'numeric|required',
			'zip_code' => 'numeric|required'
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
