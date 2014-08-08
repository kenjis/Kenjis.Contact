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

class SwiftMailer
{
    private $mailer;
    private $twig;

    private $subject;
    private $from;
    private $to;

    private $template;
    private $templateVars;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;

        // logger for debug
//        $logger = new \Swift_Plugins_Loggers_EchoLogger();
//        $this->mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));
    }

    /**
     * @return \Swift_Message
     */
    private function build()
    {
        $body = $this->twig->render($this->template, $this->templateVars);

        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setBody($body);

        return $message;
    }

    /**
     * @param string $template template filename
     * @param array $vars variables to pass template
     */
    public function setTemplate($template, array $vars)
    {
        $this->template = $template;
        $this->templateVars = $vars;
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setFrom($address, $name)
    {
        $this->from = [$address => $name];
        return $this;
    }

    public function setTo($address, $name)
    {
        $this->to = [$address => $name];
        return $this;
    }

    /**
     * Send mail
     *
     * @return int the number of recipients who were accepted for delivery
     */
    public function send()
    {
        $message = $this->build();
        return $this->mailer->send($message);
    }

    /**
     * Get this message as a complete string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->build()->toString();
    }
}
