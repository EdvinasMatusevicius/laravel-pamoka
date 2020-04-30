<?php

declare(strict_types = 1);

namespace App\Enum\Abstracts;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * Class Enumerable
 * @package App\Enum\Abstracts
 */
abstract class Enumerable
{
    /**
     * @var
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    private static $instances = [];

    /**
     * Enumerable constructor.
     * @param $id
     * @param string $name
     * @param string $description
     */
    public function __construct($id, string $name, string $description = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;

        self::$instances[get_called_class()][$id] = $this;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    public static function enum():array {
        $reflection =new ReflectionClass(get_called_class());
        $finalMethods = $reflection->getMethods(ReflectionMethod::IS_FINAL);
        $return = [];
        foreach($finalMethods as $method){
            $enum = $method->invoke(null);
            $return[$enum->id()]=$enum;
        }
        return $return;
    }

    public static function options():array{
        return array_map(function(Enumerable $enumerable){
            return $enumerable->name();
        },self::enum());
    }

    public static function enumIds(): array{
        return array_keys(self::enum());
    }
    /**
     * @param $id
     * @param string $name
     * @param string $description
     * @return $this|Enumerable|object
     * @throws ReflectionException
     */
    protected static function make(
        $id,
        string $name,
        string $description = ''
    ): Enumerable
    {
        $class = get_called_class();

        if (isset(self::$instances[$class][$id])) {
            return self::$instances[$class][$id];
        }

        $reflection = new ReflectionClass($class);

        $instance = $reflection->newInstance($id, $name, $description);

        return self::$instances[$class][$id] = $instance;
    }

} 