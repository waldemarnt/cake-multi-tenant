<?php

App::uses('HtmlHelper', 'View/Helper');

/**
 * Extend the HtmlHelper from core with new mwthods usually related with
 * bootstrap from twitter.
 */
class MultiTenantHtmlHelper extends HtmlHelper
{
    public $helpers = array(
        'Html',
        'Form',
    );

    public function link($title, $url = null, $options = array(), $confirmMessage = false)
    {
        if (is_array($url) && !isset($url['current_tenant'])) {
            $url['current_tenant'] = Configure::read('Config.current_tenant');
        } else {
            $url = '/'.Configure::read('Config.current_tenant').$url;
        }

        $escapeTitle = true;
        if ($url !== null) {
            $url = $this->url($url);
        } else {
            $url = $this->url($title);
            $title = htmlspecialchars_decode($url, ENT_QUOTES);
            $title = h(urldecode($title));
            $escapeTitle = false;
        }

        if (isset($options['escapeTitle'])) {
            $escapeTitle = $options['escapeTitle'];
            unset($options['escapeTitle']);
        } elseif (isset($options['escape'])) {
            $escapeTitle = $options['escape'];
        }

        if ($escapeTitle === true) {
            $title = h($title);
        } elseif (is_string($escapeTitle)) {
            $title = htmlentities($title, ENT_QUOTES, $escapeTitle);
        }

        if (!empty($options['confirm'])) {
            $confirmMessage = $options['confirm'];
            unset($options['confirm']);
        }
        if ($confirmMessage) {
            $options['onclick'] = $this->_confirm($confirmMessage, 'return true;', 'return false;', $options);
        } elseif (isset($options['default']) && !$options['default']) {
            if (isset($options['onclick'])) {
                $options['onclick'] .= ' ';
            } else {
                $options['onclick'] = '';
            }
            $options['onclick'] .= 'event.returnValue = false; return false;';
            unset($options['default']);
        }

        return sprintf($this->_tags['link'], $url, $this->_parseAttributes($options), $title);
    }
}
