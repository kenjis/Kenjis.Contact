<?php

namespace Kenjis\Contact\Module;

use BEAR\Package\Module\Package\StandardPackageModule;
use Ray\Di\AbstractModule;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;
use BEAR\Package\Module\Session\AuraSession\SessionModule;

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

        // install aura.session
        $this->install(new SessionModule());

        // aspect @Form annotaion
        $this->bindInterceptor(
            $this->matcher->subclassesOf('Kenjis\Contact\Resource\App\Contact\Form'),
            $this->matcher->annotatedWith('BEAR\Sunday\Annotation\Form'),
            [$this->requestInjection('Kenjis\Contact\Interceptor\Contact\Form')]
        );

        // override module
        // $this->install(new SmartyModule($this));

        // $this->install(new AuraViewModule($this));

        // install application dependency
        // $this->install(new App\Dependency);

        // install application aspect
        // $this->install(new App\Aspect($this));
    }
}
