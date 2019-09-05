<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 3/31/2018
 * Time: 1:47 PM
 */

namespace henrik\container;


/**
 * Interface ContainerInterface
 * @package henrik\container
 */
interface ContainerInterface extends \Psr\Container\ContainerInterface
{
    /**
     * @param string $id
     * @return mixed
     */
    public function get($id);

    /**
     * @param $id
     * @param $value
     * @return void
     */
    public function set($id, $value);

    /**
     * @param $id
     * @return boolean
     */
    public function has($id);
    /**
     * @param $id
     * @return void
     */
    public function delete($id);

    /**
     * @return void
     */
    public function deleteAll();

    /**
     * @return array
     */
    public function getAll();

    // public function update($id, $new_value);
}