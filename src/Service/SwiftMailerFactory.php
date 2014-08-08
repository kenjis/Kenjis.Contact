<?php
/**
 * Kenjis.Contact
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2014 Kenji Suzuki
 * @link       https://github.com/kenjis/Kenjis.Contact
 */

namespace Kenjis\Contact\Service;

use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class SwiftMailerFactory
{
    /**
     * @var string
     */
    private $context;

    private $twig;

    /**
     * @Inject
     * @Named("context=app_context")
     */
    public function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * @Inject
     */
    public function setTwig(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return \Swift_Mailer
     */
    public function create()
    {
        if ($this->context === 'test') {
            $transport = \Swift_NullTransport::newInstance();
        } else {
            $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', '465', 'ssl')
                ->setUsername($_ENV['MAILER_GMAIL_ID'])
                ->setPassword($_ENV['MAILER_GMAIL_PASSWORD']);
        }

        $mailer = \Swift_Mailer::newInstance($transport);

        return new SwiftMailer($mailer, $this->twig);
    }
}
