<?php
/**
 * ActionController.php
 * User: floran.pagliai
 * Date: 21/07/14
 * Time: 14:26
 */

namespace RocketChef\SellingBundle\Controller;


use RocketChef\DataBundle\Entity\SellingDay;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class ActionController extends Controller
{
    public function getDataAction()
    {
        $sellingDays = $this->getUser()->getRestaurant()->getSellingDays();

        $data = array();
        foreach ($sellingDays as $sellingDay) {
            $data[] = array('date' => date_format($sellingDay->getDate(), 'Y-m-d'),
                            'CA' => round($sellingDay->getCA(), 2),
                            'cost' => round($sellingDay->getCost(), 2),

            );
        }
        return new JsonResponse($data);
    }
} 