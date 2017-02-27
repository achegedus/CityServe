<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class GroupTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['group_type'];

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
			'number_of_people' => (int) $resource->members,
			'group_type_id' => (int) $resource->group_type_id,
			'person_id' => (int) $resource->person_id,
            'project_id' => (int) $resource->group_id,
            'members' => (int) $resource->members,
			'created_at' => $resource->created_at,
			'updated_at' => $resource->updated_at,
        ];
    }


    public function includeGroupType($resource)
    {
        $gt = $resource->group_type;

        return $this->item($gt, new GroupTypeTransformer());
    }
}
