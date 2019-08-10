<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 3/31/2018
 * Time: 10:34 AM
 */

namespace henrik\container;


use henrik\container\exceptions\IdAlreadyExistsException;
use henrik\container\exceptions\ServiceNotFoundException;
use henrik\container\exceptions\TypeException;
use henrik\component\Component;

/**
 * Class Container
 * @package henrik\container
 */
class Container extends Component implements ContainerInterface
{
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var integer
     */
    private $mode;
    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function get($id)
    {
        if ($this->has($id)) {
            return $this->data[$id];
        }
        throw new ServiceNotFoundException(sprintf('service by "%s" id not found', $id));
    }

    /**
     * @param $id
     * @return boolean
     */
    public function has($id)
    {
        return isset($this->data[$id]);
    }

    /**
     * @param $id
     * @param $value
     * @return mixed|void
     * @throws IdAlreadyExistsException
     * @throws TypeException
     */
    public function set($id, $value)
    {
        if (is_string($id)) {
            if ($this->mode == ContainerModes::SINGLE_VALUE_MODE) {
                if ($this->has($id)) {
                    throw new IdAlreadyExistsException(sprintf('"%s" id is already exists please choose another name', $id));
                } else {
                    $this->data[$id] = $value;
                }
            } else {
                $this->data[$id][] = $value;
            }

        } else {
            throw new TypeException(sprintf('id must  be type of string %s given', gettype($id)));
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        unset($this->data[$id]);
    }

    /**
     * @return void
     */
    public function deleteAll()
    {
        $this->data = [];
    }

}