<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 3/31/2018
 * Time: 10:34 AM.
 */
declare(strict_types=1);

namespace henrik\container;

use henrik\component\Component;
use henrik\container\exceptions\IdAlreadyExistsException;
use henrik\container\exceptions\ServiceNotFoundException;
use henrik\container\exceptions\UndefinedModeException;

/**
 * Class Container.
 */
class Container extends Component implements ContainerInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $data = [];
    /**
     * @var ContainerModes
     */
    private ContainerModes $mode = ContainerModes::SINGLE_VALUE_MODE;

    /**
     * @param string $id
     *
     * @throws ServiceNotFoundException
     *
     * @return mixed
     */
    public function get(string $id): mixed
    {
        if ($this->has($id)) {
            return $this->data[$id];
        }

        throw new ServiceNotFoundException($id);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->data[$id]);
    }

    /**
     * @param string $id
     * @param mixed  $value
     *
     * @throws IdAlreadyExistsException
     *
     * @return void
     */
    public function set(string $id, mixed $value): void
    {
        if ($this->mode == ContainerModes::SINGLE_VALUE_MODE) {

            if ($this->has($id)) {
                throw new IdAlreadyExistsException($id);
            }

            $this->data[$id] = $value;

            return;

        }

        $this->data[$id][] = $value; // @phpstan-ignore-line
    }

    /**
     * @param $id
     *
     * @return void
     */
    public function delete($id): void
    {
        unset($this->data[$id]);
    }

    /**
     * @return void
     */
    public function deleteAll(): void
    {
        $this->data = [];
    }

    /**
     * @return array<string, mixed>
     */
    public function getAll(): array
    {
        return $this->data;
    }

    /**
     * @param ContainerModes $mode
     *
     * @throws UndefinedModeException
     */
    public function changeMode(ContainerModes $mode): void
    {
        if (!in_array($mode, ContainerModes::cases())) {
            throw new UndefinedModeException();
        }
        $this->mode = $mode;
    }
}