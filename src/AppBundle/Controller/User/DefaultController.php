<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\Feedback;
use AppBundle\Entity\Goods;
use AppBundle\Form\FeedbackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package AppBundle\Controller\User
 * @Route("/user")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="user_homepage")
     * @Template()
     */
    public function indexAction()
    {
    }

    /**
     * @Route("/mobile", name="user_mobile")
     * @Template()
     */
//    public function mobileAction()
//    {
//        $products = $this
//            ->getDoctrine()
//            ->getRepository('AppBundle:Goods')
//            ->findBy(['category' => 1])
//        ;
//        return ['products' => $products];
//    }

    /**
     * @Route("/tablet", name="user_tablet")
     * @Template()
     */
//    public function tabletAction()
//    {
//        $products = $this
//            ->getDoctrine()
//            ->getRepository('AppBundle:Goods')
//            ->findBy(['category' => 2])
//        ;
//        return ['products' => $products];
//    }

    /**
     * @Route("/{id}", name="user_show_item", requirements={"id": "[0-9]+"})
     */
    public function showAction(Goods $goods)
    {
        $products = [1 => $goods];
        return $this->render('@App/Default/mobile.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/feedback", name="user_feedback")
     * @Template()
     */
//    public function feedbackAction(Request $request)
//    {
//        $feedback = new Feedback();
//        $feedback->setIpAddress($request->getClientIp());
//        $form = $this->createForm(FeedbackType::class, $feedback);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            //Email message
//            $message = (new \Swift_Message('Site Feedback'))
//                ->setFrom(['a.yerofeyev@nlg.kiev.ua' => 'Feedback'])
//                ->setTo('a.yerofeyev@nlg.kiev.ua')
//                ->setBody( 'From: ' . $feedback->getEmail()
//                    . PHP_EOL
//                    . 'With IP address: ' . $feedback->getIpAddress()
//                    . PHP_EOL
//                    . 'Sent: ' . $feedback->getCreatedAt()->format('d/m/Y')
//                    . PHP_EOL
//                    . $feedback->getMessage());
//
//            $result = $this->get('mailer')->send($message);
//
//            $em = $this->getDoctrine()->getManager();
//
//            $em->persist($feedback);
//            $em->flush();
//
//            $this->addFlash('success', $result . ' message(s) sent.');
//
//
//            return $this->redirectToRoute('feedback');
//        }
//
//        return ['feedback_form' => $form->createView()];
//    }
}
