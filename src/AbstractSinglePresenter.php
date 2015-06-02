<?php namespace Motty\Presenter;

use ArrayAccess;

abstract class AbstractSinglePresenter implements ArrayAccess
{
    /**
     * The object to present
     *
     * @var mixed
     */
    protected $object;

    /**
     * Inject the object to be presented
     *
     * @param mixed
     */
    public function set($object)
    {
        $this->object = $object;
    }

    /**
     * Check to see if there is a presenter method. If not pass to the object
     *
     * @param string $key
     */
    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->{$key}();
        }

        return $this->object->$key;
    }

    /**
     * Check to see if the offset exists on the current object
     *
     * e.g. isset($object['name']); // true / false
     *
     * @param string $key
     * @return boolean
     */
    public function offsetExists($key)
    {
        return isset($this->object[$key]);
    }

    /**
     * Retrieve the key from the object as if it were an array
     *
     * e.g. echo $object['name']; // Jon Doe
     *
     * @param string $key
     * @return boolean
     */
    public function offsetGet($key)
    {
        return $this->object[$key];
    }

    /**
     * Set a property on the object as if it were any array
     *
     * e.g. $object['name'] = 'Jon Doe';
     *
     * @param string $key
     * @param mixed $value
     */
    public function offsetSet($key, $value)
    {
        $this->object[$key] = $value;
    }

    /**
     * Unset a key on the object as if it were an array
     *
     * e.g. unset($object['name']);
     *
     * @param string $key
     */
    public function offsetUnset($key)
    {
        unset($this->object[$key]);
    }
}
