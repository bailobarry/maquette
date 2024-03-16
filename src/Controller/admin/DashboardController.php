<?php
    // src/Controller/LuckyController.php
    namespace App\Controller\admin;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;

    class DashboardController extends AbstractController
    {
        public function dashboard(): Response
        {
            return $this -> render('admin/dashboard.html.twig');
        }
        public function login(): Response
        {
            return $this -> render('authentification/login.html.twig');
        }

        public function register(): Response
        {
            return $this -> render('authentification/register.html.twig');
        }
    }
?>