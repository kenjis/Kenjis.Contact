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

class Form extends ResourceObject
{
    private $mailerFactory;

    // Email account info to receive posted data
    private $adminEmail = 'admin@example.org';
    private $adminName = 'Administrator';

    /**
     * @Inject
     */
    public function __construct(SwiftMailerFactory $mailerFactory)
    {
        $this->mailerFactory = $mailerFactory;
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
        $mailer->setSubject('Contact Form')
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
