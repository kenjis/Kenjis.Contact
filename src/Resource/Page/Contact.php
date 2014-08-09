<?php
/**
 * Kenjis.Contact
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2014 Kenji Suzuki
 * @link       https://github.com/kenjis/Kenjis.Contact
 */

namespace Kenjis\Contact\Resource\Page;

use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Kenjis\Contact\Service\SwiftMailerFactory;
use BEAR\Resource\Code;

class Contact extends ResourceObject
{
    /**
     * @Inject
     */
    public function __construct(SwiftMailerFactory $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onGet()
    {
        return $this;
    }

    public function onPost($name, $email, $comment)
    {
        if (! $this->validation($name, $email, $comment)) {
            return $this;
        }

        $this->sendmail($name, $email, $comment);

        $this['code'] = $this->code = Code::CREATED;
        $this['name']    = $name;
        $this['email']   = $email;
        $this['comment'] = $comment;

        return $this;
    }

    private function validation($name, $email, $comment)
    {
        $pass = true;

        if ((mb_strlen($name) == 0) || (mb_strlen($name) > 50)) {
            $this->body['form']['name']['error'] = 'Enter your name (max 50 letters).';
            $pass = false;
        }

        if ((mb_strlen($email) > 100) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->body['form']['email']['error'] = 'Enter your email adrress (max 100 letters).';
            $pass = false;
        }

        if ((mb_strlen($comment) == 0) || (mb_strlen($comment) > 400)) {
            $this->body['form']['comment']['error'] = 'Enter comment (max 400 letters).';
            $pass = false;
        }

        if (! $pass) {
            $this->body['form']['name']['value']    = $name;
            $this->body['form']['email']['value']   = $email;
            $this->body['form']['comment']['value'] = $comment;
        }

        return $pass;
    }

    private function sendmail($name, $email, $comment)
    {
        $data = [
            'name'    => $name,
            'email'   => $email,
            'comment' => $comment,
        ];

        $mailer = $this->mailer->create();
        $mailer->setSubject('コンタクトフォーム')
            ->setFrom($data['email'], $data['name'])
            ->setTo('admin@example.org', '管理者')
            ->setTemplate('mailer/contact_form.twig', $data);

//        echo '<pre>'
//            . htmlspecialchars($mailer, ENT_QUOTES, 'UTF-8')
//            . '</pre>';

        $result = $mailer->send();
        return $result;
    }
}
