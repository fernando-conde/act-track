<?php
namespace ActTrack\Entity;

use ActTrack\Container;

class Action
{
    /** @var string */
    private $name;

    /**
     * @var string
     */
    private $isin;

    /** @var Container */
    private $container;

    /** @var bool */
    private $isInit;

    /**
     * @param Container $container
     */
    public function __construct(Container $container, $isin)
    {
        $this->container = $container;
        $this->isin = $isin;
    }

    /**
     * @param string $name
     */
    public function set($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        if ($this->isInit() === false) {
            $this->container->getBuilderAction()->init();
        }

        return $this->name;
    }

    /**
     * @return string
     */
    public function getIsin()
    {
        return $this->isin;
    }

    public function isInit()
    {
        return $this->isInit;
    }
}