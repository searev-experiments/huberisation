<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 07/02/2018
 * Time: 16:00
 */

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Project;
use App\Form\ArticleType;
use App\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminController extends Controller
{

    /**
     * @Route("/admin")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function adminAction(Environment $twig)
    {

        $articles = $this->getDoctrine()->getRepository('App:Article')->createQueryBuilder('article')
            ->orderBy('article.date', 'DESC')
            ->getQuery()
            ->getResult();

        return new Response($twig->render('admin/list.html.twig', array('articles' => $articles)));
    }

    /**
     * @Route("/admin/articles/create")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function writeArticleAction(Environment $twig, Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $article->getVignette();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('article_upload_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $article->setVignette($fileName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('app_admin_admin');
        }

        return new Response($twig->render('admin/create.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/admin/articles/{id}/edit")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editArticleAction(Environment $twig, Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository('App:Article')->find($id);
        $article->setVignette(new File($this->getParameter('vignette_upload_directory') . '/' . $article->getVignette()));
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $article->getVignette();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('article_upload_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $article->setVignette($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_admin_admin');
        }

        return new Response($twig->render('admin/edit.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/admin/projects/create")
     *
     * @param Environment $twig
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function createProjectAction(Environment $twig, Request $request)
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $project->getLogo();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('project_upload_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $project->setLogo($fileName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('app_admin_admin');
        }

        return new Response($twig->render('admin/create-project.html.twig', array('form' => $form->createView())));
    }

}