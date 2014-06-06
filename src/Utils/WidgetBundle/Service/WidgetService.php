<?php
/**
 * User: floran
 * Date: 28/05/2014
 * Time: 21:29
 */

namespace Utils\WidgetBundle\Service;


class WidgetService {

    private $widgets;

    /**
     * Add widget to your current rendering
     *
     * Add a widget to your current rendring,
     * then call getWidget() for getting an array
     * that contains all the current widget
     *
     * @param array $param
     * @example    array('link'=>'acme_index','name'=>'price','value'=>'42 €', color=>'blue');
     */
    public function addWidget($param = array())
    {
        $this->widgets[] = array(
            'link' => !isset($param['link']) ? '#' : $param['link'],
            'name' => !isset($param['name']) ? '' : $param['name'],
            'value' => !isset($param['value']) ? '' : $param['value'],
            'color' => !isset($param['color']) ? 'blue' : $param['color'],
            'textcolor' => !isset($param['textcolor']) ? 'text-faded' : $param['textcolor'],
            'icon' => !isset($param['icon']) ? '' : $param['icon'],
            'footerText' => !isset($param['footerText']) ? '' : $param['footerText']);
    }

    public function getWidgets()
    {
        return $this->widgets;
    }
} 