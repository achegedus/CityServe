<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ChurchTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform($resource)
    {
        return [

            'id' => (int) $resource->id,
			'name' => $resource->name,
			'address' => $resource->address,
			'secondary_address' => $resource->address2,
			'city' => $resource->city,
			'state' => $resource->state,
			'zipcode' => $resource->zipcode,
			'url' => $resource->url,
            'phone' => $resource->phone,
			'created_at' => $resource->created_at,
			'updated_at' => $resource->updated_at,
			
        ];
    }
}
