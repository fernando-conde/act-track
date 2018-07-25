<?php
namespace ActTrack;

use ActTrack\Builder\Action;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Debug\Debug as DebugReference;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\DebugClassLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Stopwatch\Stopwatch;

class Container
{
    /** @var Logger */
    private $log;

    /** @var FilesystemCache */
    private $cache;

    /** @var Action */
    private $builderAction;

    /** @var Serializer */
    private $serializer;

    /** @var Stopwatch */
    private $stopwatch;

    /** @var Request */
    private $request;

    public function __construct()
    {
        $this->stopwatch = new Stopwatch();
        $this->stopwatch->start('start');

        $this->log = new Logger('ActTrack');
        $this->log->pushHandler(new StreamHandler('/var/logs/act-track/error.log', Logger::ERROR));
        $this->log->pushHandler(new StreamHandler('/var/logs/act-track/warning.log', Logger::WARNING));
        $this->log->pushHandler(new StreamHandler('/var/logs/act-track/notice.log', Logger::NOTICE));
        $this->log->pushHandler(new StreamHandler('/var/logs/act-track/info.log', Logger::INFO));
        $this->log->pushHandler(new StreamHandler('/var/logs/act-track/debug.log', Logger::DEBUG));

        DebugReference::enable();
        ErrorHandler::register();
        ExceptionHandler::register();
        DebugClassLoader::enable();

        $this->cache = new FilesystemCache();

        $encoder = array(new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizer, $encoder);

        $this->builderAction = new Action($this);

        $this->request = Request::createFromGlobals();

        $this->stopwatch->lap('start');
    }

    /**
     * @return Logger
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @return Action
     */
    public function getBuilderAction()
    {
        return $this->builderAction;
    }

    /**
     * @return FilesystemCache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @return Stopwatch
     */
    public function getStopwatch()
    {
        return $this->stopwatch;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}