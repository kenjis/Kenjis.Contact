<?php

namespace Kenjis\Contact\Module\App;

use BEAR\Package;
use Ray\Di\AbstractModule;

class Aspect extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        /*
        $this->bindInterceptor(
             $this->matcher->any(),
             $this->matcher->annotatedWith('Kenjis\Contact\Annotation\Bar'),
             [$this->requestInjection('Kenjis\Contact\Interceptor\FooInterceptor')]
        );
        */
    }
}
