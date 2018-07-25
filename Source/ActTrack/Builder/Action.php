<?php
namespace ActTrack\Builder;

use ActTrack\Container;

class Action
{
    /** @var Container */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $isin
     * @return mixed
     */
    public function get($isin)
    {
        $key = 'action.'.$isin;
        $cache = $this->container->getCache();
        if ($cache->has($key) === false) {
            $cache->set($key, new \ActTrack\Entity\Action($this->container, $isin));
        }

        return $cache->get($key);
    }

    /*public function set()
    {
        fore
    }*/
}
