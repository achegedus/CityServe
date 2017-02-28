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
    protected $availableIncludes = ['church', 'roles'];

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
            'first_name' => $resource->first_name,
            'last_name' => $resource->last_name,
            'address' => $resource->address,
            'city' => $resource->city,
            'state' => $resource->state,
            'zipcode' => $resource->zipcode,
            'phone' => $resource->phone,
            'email' => $resource->email,
            'church_id' => (int) $resource->church_id,
            'isSuperAdmin' => $resource->isSuperAdmin(),
            'isReviewer' => $resource->isReviewer(),
            'isAdmin' => $resource->isAdmin(),
            'selected_roles' => $resource->selected_roles(),
			'created_at' => $resource->created_at,
			'updated_at' => $resource->updated_at,
        ];
    }

    /**
     * Include Author
     *
     */
    public function includeChurch($resource)
    {
        $church = $resource->church;

        return $this->item($church, new ChurchTransformer());
    }

    /**
     * Include Author
     *
     */
    public function includeRoles($resource)
    {
        $filters = $resource->roles;

        return $this->collection($filters, new RoleTransformer());
    }
}
