<?php

namespace Kenjis\Contact\Module\Provider;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class TwigModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->bind('BEAR\Sunday\Extension\TemplateEngine\TemplateEngineAdapterInterface')
            ->to('BEAR\Package\Provide\TemplateEngine\Twig\TwigAdapter')
            ->in(Scope::SINGLETON);
        $this
            ->bind('Twig_Environment')
            ->toProvider(__NAMESPACE__ . '\TwigProvider')
            ->in(Scope::SINGLETON);
    }
}
