<?php

namespace Utils\WidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WidgetController extends Controller
{

    /**
     * @param $link
     * @param $name
     * @param $value
     * @param $color
     * @param $textcolor
     * @param $icon
     * @param $footerText
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function generateAction($link, $name, $value, $color, $textcolor, $icon, $footerText)
    {
        $paramsRender = array(
            'link' => $link,
            'name' => $name,
            'color' => $color,
            'value' => $value,
            'textcolor' => $textcolor,
            'icon' => $icon,
            'footerText' => $footerText);

        return $this->render('WidgetBundle:Widget:widget.html.twig', $paramsRender);
    }
}
