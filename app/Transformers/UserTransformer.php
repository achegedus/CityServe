<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class UserTransformer extends TransformerAbstract
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
			'email' => $resource->email,
			'phone' => $resource->phone,
			'church_id' => (int) $resource->church_id,
            'isSuperAdmin' => $resource->isSuperAdmin(),
            'isReviewer' => $resource->isReviewer(),
            'isAdmin' => $resource->isAdmin(),
			'created_at' => $resource->created_at,
			'updated_at' => $resource->updated_at,
        ];
    }
}
