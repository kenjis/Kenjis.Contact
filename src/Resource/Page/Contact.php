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
        $data = [
            'name'    => 'BEAR.Sunday',
            'email'   => 'bear@example.jp',
            'comment' => 'テストメールです。',
        ];

        $mailer = $this->mailer->create();
        $mailer->setSubject('テストメール')
            ->setFrom($data['email'], $data['name'])
            ->setTo('admin@example.org', '管理者')
            ->setTemplate('mailer/contact_form.twig', $data);

        echo '<pre>'
            . htmlspecialchars($mailer, ENT_QUOTES, 'UTF-8')
            . '</pre>';

        $result = $mailer->send();
        return (string) $result;
    }
}
