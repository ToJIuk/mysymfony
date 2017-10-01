<?php
/**
 * Created by PhpStorm.
 * User: ToJIuk
 * Date: 30.09.2017
 * Time: 22:49
 */

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TolikForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class PagesAdminController extends Controller
{
    /**
     * @Route("/pages", name = "admin_pages")
     */
    public function indexAction()
    {
        $pages = $this->getDoctrine()->getRepository('AppBundle:Pages')
        ->findAll();
        return $this->render('admin/pages/list.html.twig', array(
            'pages' => $pages
        ));
    }

    /**
     * @Route("/pages/new", name = "admin_pages_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TolikForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $pages = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($pages);
            $em->flush();
            $this->addFlash('success', 'Page created!');
            return $this->redirectToRoute('admin_pages');
        }
        return $this->render('admin/pages/new.html.twig', [
            'pagesForm' => $form->createView()
        ]);
    }

}