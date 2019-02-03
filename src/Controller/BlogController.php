<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 02/02/2018
 * Time: 17:51
 */

namespace App\Controller;


use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BlogController extends AbstractController
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

        $repository = $this
            ->getDoctrine()
            ->getRepository('App:Article');

        /** @var Article[] $articles */
        $articles = $repository->findLatestArticles();

        /** @var Article[] $tutorials */
        $tutorials = $repository->findLatestTutorials();

        $nbArticles = sizeof($articles);
        $nbTutorials = sizeof($tutorials);

        if ($nbTutorials == 0 && $nbArticles == 0) {
            $featured = null;
        } else {
            if ($nbTutorials == 0) {
                $featured = $articles[0];
                $articles = array_splice($articles, 1);
            } elseif ($nbArticles == 0) {
                $featured = $tutorials[0];
                $tutorials = array_splice($tutorials, 1);
            } else {
                $lastArticle = $articles[0];
                $lastTutorial = $tutorials[0];

                if ($lastArticle->getDate() > $lastTutorial->getDate()) {
                    $featured = $lastArticle;
                    $articles = array_splice($articles, 1);
                } else {
                    $featured = $tutorials[0];
                    $tutorials = array_splice($tutorials, 1);
                }
            }
        }

        return new Response(
            $twig->render(
                'pages/home.html.twig',
                array(
                    'articles' => $articles,
                    'featured' => $featured,
                    'tutorials' => $tutorials
                )
            )
        );
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

        $articles = $this
            ->getDoctrine()
            ->getRepository('App:Article')
            ->findArticles(0);

        if (sizeof($articles) > 0) {
            $featured = $articles[0];
            $articles = array_splice($articles, 1);
        } else {
            $featured = null;
        }

        return new Response(
            $twig->render('pages/blog.html.twig',
                array(
                    'articles' => $articles,
                    'featured' => $featured)
            )
        );
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

        $projects = $this
            ->getDoctrine()
            ->getRepository('App:Project')
            ->findProjects(0);

        return new Response(
            $twig->render('pages/projets.html.twig',
                array('projects' => $projects)
            )
        );
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
    public function getTutorialAction(Environment $twig) {

        $tutorial = $this
            ->getDoctrine()
            ->getRepository('App:Article')
            ->findTutorials(0);

        return new Response(
            $twig->render(
                'pages/tutorials.html.twig',
                array('tutorials' => $tutorial)
            )
        );
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

        throw $this->createNotFoundException("L'article n'existe pas ou a été déplacé");

    }

    /**
     * Ensures backward compatibility with the routes generated by the previous version of the blog (Jekyll)
     *
     * @Route("/{year}/{month}/{day}/{uri}/")
     *
     * @param $uri
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getCompatibilityAction($uri)
    {
        return $this->redirectToRoute('app_blog_getarticle', array('uri' => $uri));
    }

}