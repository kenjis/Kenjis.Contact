<?php

namespace Kenjis\Contact\Module;

use BEAR\Package\Module\Package\StandardPackageModule;
use Ray\Di\AbstractModule;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class AppModule extends AbstractModule
{
    /**
     * @var string
     */
    private $context;

    /**
     * @param string $context
     *
     * @Inject
     * @Named("app_context")
     */
    public function __construct($context = 'prod')
    {
        $this->context = $context;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new StandardPackageModule('Kenjis\Contact', $this->context, dirname(dirname(__DIR__))));

        // override twig module
        $this->install(new Provider\TwigModule($this));

        // override module
        // $this->install(new SmartyModule($this));

        // $this->install(new AuraViewModule($this));

        // install application dependency
        // $this->install(new App\Dependency);

        // install application aspect
        // $this->install(new App\Aspect($this));
    }
}
