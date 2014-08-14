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
use BEAR\Sunday\Inject\ResourceInject;

class Contact extends ResourceObject
{
    use ResourceInject;

    public function onGet()
    {
        $this['contact_form'] = $this->resource->get
            ->uri('app://self/contact/form')
            ->eager->request();

        return $this;
    }

    public function onPost($name, $email, $comment)
    {
        $this['contact_form'] = $this->resource->post
            ->uri('app://self/contact/form')
            ->withQuery(['name' => $name, 'email' => $email, 'comment' => $comment])
            ->eager->request();

        $this->code = $this['contact_form']->code;

        return $this;
    }
}
