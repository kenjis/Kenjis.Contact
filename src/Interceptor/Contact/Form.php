<?php
/**
 * Kenjis.Contact
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2014 Kenji Suzuki
 * @link       https://github.com/kenjis/Kenjis.Contact
 */

namespace Kenjis\Contact\Interceptor\Contact;

use Ray\Aop\MethodInterceptor;
use Aura\Input\FilterInterface;
use BEAR\Package\Module\Form\AuraForm\AuraFormTrait;

/**
 * Aura.Input form
 *
 * @see https://github.com/auraphp/Aura.Input
 */
class Form implements MethodInterceptor
{
    use AuraFormTrait;

    /**
     * Set form
     *
     * @param FilterInterface $filter
     */
    private function setForm(FilterInterface &$filter)
    {
        $this->form
            ->setField('name')
            ->setAttribs(
                [
                    'class' => 'form-control',
                    'id' => 'name',
                    'name' => 'name',
                    'size' => 20,
                    'maxlength' => 50,
                    'required' => 'required'
                ]
            );
        $filter->setRule(
            'name',
            'Enter your name (max 50 letters).',
            function ($value) {
                if (mb_strlen($value) == 0) return false;
                if (mb_strlen($value) > 50) return false;
                return true;
            }
        );

        $this->form
            ->setField('email')
            ->setAttribs(
                [
                    'class' => 'form-control',
                    'id' => 'email',
                    'name' => 'email',
                    'size' => 20,
                    'maxlength' => 100,
                    'required' => 'required'
                ]
            );
        $filter->setRule(
            'email',
            'Enter your email adrress (max 100 letters).',
            function ($value) {
                if (mb_strlen($value) > 100) return false;
                return filter_var($value, FILTER_VALIDATE_EMAIL);
            }
        );

        $this->form
            ->setField('comment', 'textarea')
            ->setAttribs(
                [
                    'class' => 'form-control',
                    'id' => 'comment',
                    'name' => 'comment',
                    'cols' => 40,
                    'rows' => 5,
                    'required' => 'required'
                ]
            );
        $filter->setRule(
            'comment',
            'Enter comment (max 400 letters).',
            function ($value) {
                if (mb_strlen($value) == 0) return false;
                if (mb_strlen($value) > 400) return false;
                return true;
            }
        );
    }
}
