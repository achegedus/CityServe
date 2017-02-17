<?php

/**
 * Created by PhpStorm.
 * User: adamh
 * Date: 2/16/17
 * Time: 11:37 AM
 */
trait Factory
{
    protected $times = 1;

    /**
     * @param $count
     * @return $this
     */
    protected function times($count)
    {
        $this->times = $count;
        return $this;
    }

    /**
     * @param $type
     * @param array $fields
     */
    protected function make($type, array $fields = [])
    {
        $type = "\\App\\Models\\" . $type;

        while($this->times--) {
            $stub = array_merge($this->getStub(), $fields);
            $type::create($stub);
        }
    }

    /**
     * @return mixed
     */
    public function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your fields.');
    }
}