<?php

namespace Kenjis\Contact\Module\Provider;

use BEAR\Sunday\Inject\LibDirInject;
use BEAR\Sunday\Inject\TmpDirInject;
use Ray\Di\ProviderInterface as Provide;
use Twig_Environment;
use Twig_Loader_Filesystem;
use BEAR\Package\Provide\TemplateEngine\Twig\Extension\AuraForm_Twig_Extension;

/**
 * Twig
 *
 * @see http://twig.sensiolabs.org/
 */
class TwigProvider implements Provide
{
    use TmpDirInject;
    use LibDirInject;

    /**
     * Return instance
     *
     * @return \Twig_Environment
     */
    public function get()
    {
        $loader = new Twig_Loader_Filesystem(array('/', $this->libDir . '/twig/template'));
        $twig = new Twig_Environment($loader, [
            'cache' => $this->tmpDir . '/twig/cache',
            'debug' => true,
            'autoescape' => true,
        ]);

        $twig->addExtension(new \Twig_Extension_Debug());
        $twig->addExtension(new AuraForm_Twig_Extension());

        $function = new \Twig_SimpleFunction(
            'href',
            [$this, 'href'],
            ['needs_context' => true]
        );
        $twig->addFunction($function);

        return $twig;
    }

    public function href($context, $varName, $varValue)
    {
        /** @todo not yet implemented */
        return 'href:' . $varValue;
    }
}
