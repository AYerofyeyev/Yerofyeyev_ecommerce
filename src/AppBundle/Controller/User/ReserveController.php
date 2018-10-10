<?php
/**
 * Created by PhpStorm.
 * User: ean
 * Date: 10.10.2018
 * Time: 11:04
 */

namespace AppBundle\Controller\User;


use AppBundle\Entity\Goods;
use AppBundle\Entity\Reserve;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class OrderController
 * @package AppBundle\Controller\User
 * @Route("/order")
 */
class ReserveController extends Controller
{
    /**
     * @param Security $security
     * @return array
     * @Route("/orders", name="user_orders")
     * @Template()
     */
    public function ordersAction(Security $security)
    {

        return ['username' => $security->getUser()->getUsername()];
    }

    /**
     * @param Security $security
     * @param Session $session
     * @return array
     * @Route("/cart", name="user_cart")
     * @Template()
     */
    public function cartAction(Security $security, Session $session)
    {
        return ['username' => $security->getUser()->getUsername(), 'cart' => $session->get('reserve')];
    }

    /**
     * @Route("/add{id}", name="user_add_to_cart")
     */
    public function addAction($id, SessionInterface $session)
    {
        if(!$session->get('reserve')) {
            $reserve = new Reserve();
            $session->set('reserve', $reserve);
        }

        $order = $session->get('reserve')->getBulk();
        if (!$order) {
            $order = [];
        }
        array_push(
            $order,
            $id
        );
        $session->get('reserve')->setBulk($order);

        return $this->redirectToRoute('user_cart');
    }
}