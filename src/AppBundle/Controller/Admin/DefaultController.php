<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Feedback;
use AppBundle\Entity\Goods;
use AppBundle\Entity\Category;
use AppBundle\Form\FeedbackType;
use AppBundle\Form\CategoryType;
use AppBundle\Form\GoodsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package AppBundle\Controller\Admin
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_homepage")
     * @Template()
     */
    public function indexAction()
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll()
        ;

        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Goods')
            ->findAll()
        ;

        return ['categories' => $categories, 'products' => $products];
    }

    /**
     * @Route("/category/{id}", name="admin_category")
     * @Template()
     */
    public function categoryAction($id, Request $request)
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll()
        ;

        if (!$id) {
            $category = new Category();
        } else {
            $category = $this
                ->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findOneById($id)
            ;
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'New category has been added.');

            return $this->redirectToRoute('admin_category', ['id' => 0]);
        }

        return ['categories' => $categories, 'category_form' => $form->createView()];
    }

    /**
     * @Route("/goods/{id}", name="admin_goods", requirements={"id": "[0-9]+"})
     * @Template()
     */
    public function goodsAction($id, Request $request)
    {
        if (!$id) {
            $product = new Goods();
        } else {
            $product = $this
                ->getDoctrine()
                ->getRepository('AppBundle:Goods')
                ->findOneById($id)
            ;
        }

        $form = $this->createForm(GoodsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Product has been added.');

            return $this->redirectToRoute('admin_goods', ['id' => 0]);
        }


        return ['product' => $product, 'goods_form' => $form->createView()];
    }

    /**
     * @Route("/feedback", name="admin_feedback")
     * @Template()
     */
    public function feedbackAction(Request $request)
    {
        $feedback = new Feedback();
        $feedback->setIpAddress($request->getClientIp());
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Email message
            $message = (new \Swift_Message('Site Feedback'))
                ->setFrom(['a.yerofeyev@nlg.kiev.ua' => 'Feedback'])
                ->setTo('a.yerofeyev@nlg.kiev.ua')
                ->setBody( 'From: ' . $feedback->getEmail()
                    . PHP_EOL
                    . 'With IP address: ' . $feedback->getIpAddress()
                    . PHP_EOL
                    . 'Sent: ' . $feedback->getCreatedAt()->format('d/m/Y')
                    . PHP_EOL
                    . $feedback->getMessage());

            $result = $this->get('mailer')->send($message);

            $em = $this->getDoctrine()->getManager();

            $em->persist($feedback);
            $em->flush();

            $this->addFlash('success', $result . ' message(s) sent.');


            return $this->redirectToRoute('feedback');
        }

        return ['feedback_form' => $form->createView()];
    }
}
