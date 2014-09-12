<?php
/**
 * Kenjis.Contact
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2014 Kenji Suzuki
 * @link       https://github.com/kenjis/Kenjis.Contact
 */

namespace Kenjis\Contact\Resource\App\Contact;

use BEAR\Resource\ResourceObject;
use BEAR\Resource\Code;
use Kenjis\Contact\Service\SwiftMailerFactory;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class Form extends ResourceObject
{
    private $mailerFactory;

    // Email subject
    private $subject;
    // Email account info to receive posted data
    private $adminEmail;
    private $adminName;

    /**
     * @Inject
     * @Named("config=contact_form")
     */
    public function __construct(SwiftMailerFactory $mailerFactory, $config)
    {
        $this->mailerFactory = $mailerFactory;

        $this->subject    = $config['subject'];
        $this->adminEmail = $config['admin_email'];
        $this->adminName  = $config['admin_name'];
    }

    /**
     * @BEAR\Sunday\Annotation\Form
     */
    public function onGet()
    {
        return $this;
    }

    /**
     * @BEAR\Sunday\Annotation\Form
     */
    public function onPost($name, $email, $comment)
    {
        $this->sendmail($name, $email, $comment);

        $this['code'] = $this->code = Code::CREATED;
        $this['name']    = $name;
        $this['email']   = $email;
        $this['comment'] = $comment;

        return $this;
    }

    private function sendmail($name, $email, $comment)
    {
        $data = [
            'name'    => $name,
            'email'   => $email,
            'comment' => $comment,
        ];

        $mailer = $this->mailerFactory->create();
        $mailer->setSubject($this->subject)
            ->setFrom($data['email'], $data['name'])
            ->setTo($this->adminEmail, $this->adminName)
            ->setTemplate('mailer/contact_form.twig', $data);

//        echo '<pre>'
//            . htmlspecialchars($mailer, ENT_QUOTES, 'UTF-8')
//            . '</pre>';

        $result = $mailer->send();
        return $result;
    }
}
