<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 02/02/2018
 * Time: 17:51
 */

namespace App\Controller;


use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BlogController extends Controller
{

    /**
     * Displays Homepage.
     *
     * @Route("/")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getHomeAction(Environment $twig) {

        /** @var Article[] $articles */
        $articles = $this->getDoctrine()->getRepository('App:Article')->createQueryBuilder('article')
            ->andWhere('article.tutoriel = FALSE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        /** @var Article[] $articles */
        $tutoriels = $this->getDoctrine()->getRepository('App:Article')->createQueryBuilder('article')
            ->andWhere('article.tutoriel = TRUE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();



        if (sizeof($articles) > 0) {
            $featured = $articles[0];
            $articles = array_splice($articles, 1);
        } else {
            $featured = new Article();
        }

        return new Response($twig->render('pages/accueil.html.twig', array('articles' => $articles, 'featured' => $featured, 'tutoriels' => $tutoriels)));
    }

    /**
     * Displays Homepage.
     *
     * @Route("/blog")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getBlogAction(Environment $twig) {

        $articles = $this->getDoctrine()->getRepository('App:Article')->createQueryBuilder('article')
            ->andWhere('article.blog = TRUE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();

        if (sizeof($articles) > 0) {
            $featured = $articles[0];
            $articles = array_splice($articles, 1);
        } else {
            $featured = new Article();
        }

        return new Response($twig->render('pages/blog.html.twig', array('articles' => $articles, 'featured' => $featured)));
    }

    /**
     * Displays Homepage.
     *
     * @Route("/projets")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getProjectsAction(Environment $twig) {

        $projects = $this->getDoctrine()->getRepository('App:Project')->createQueryBuilder('project')
            ->orderBy('project.id', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();

        return new Response($twig->render('pages/projets.html.twig', array('projects' => $projects)));
    }

    /**
     * Displays Homepage.
     *
     * @Route("/tutoriels")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getTutoAction(Environment $twig) {

        $tutoriels = $this->getDoctrine()->getRepository('App:Article')->createQueryBuilder('article')
            ->andWhere('article.tutoriel = TRUE')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();

        return new Response($twig->render('pages/tutoriels.html.twig', array('tutoriels' => $tutoriels)));
    }

    /**
     * Displays Homepage.
     *
     * @Route("/a-propos")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getAboutAction(Environment $twig) {
        return new Response($twig->render('pages/a-propos.html.twig'));
    }


    /**
     * Displays an article.
     *
     * @Route("/articles/{uri}")
     *
     * @param Environment $twig
     * @param $uri
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getArticleAction(Environment $twig, $uri)
    {
        $article = $this->getDoctrine()->getRepository('App:Article')->findOneBy(array('url' => $uri));

        if ($article) {
            return new Response($twig->render('pages/article.html.twig', array('article' => $article)));
        }

        return $this->redirectToRoute('app_home_get404');

    }

    /**
     * @Route("/404")
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function get404Action(Environment $twig)
    {
        return new Response($twig->render('pages/404.html.twig'));
    }


}