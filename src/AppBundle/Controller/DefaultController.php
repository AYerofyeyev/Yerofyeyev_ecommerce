<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
        return $this->render('@App/Default/index.html.twig');
    }

    /**
     * @Route("/mobile", name="mobile")
     */
    public function mobileAction(Request $request)
    {
        $products = [
            ['id' => 120393],
            ['id' => 120394]
        ];
        return $this->render('@App/Default/mobile.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/mobile/{id}", name="mobile_item", requirements={})
     */
    public function showAction($id)
    {
        $product = [

        ];
    }
}
