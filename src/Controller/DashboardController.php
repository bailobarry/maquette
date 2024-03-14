<?php
    // src/Controller/LuckyController.php
    namespace App\Controller;

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

        public function utilisateur(): Response
        {
            return $this-> render('admin/utilisateurs/utilisateur.html.twig');
        }

        public function diplomes(): Response
        {
            return $this-> render('admin/maquettes/diplomes/ajouter.html.twig');
        }

        public function parcours(): Response
        {
            return $this-> render('admin/maquettes/parcours/index.html.twig');
        }

        public function mcc(): Response
        {
            return $this-> render('admin/maquettes/modalites_controles/index.html.twig');
        }

        public function ues(): Response
        {
            return $this-> render('admin/maquettes/ues/index.html.twig');
        }

        public function blocs_competences(): Response
        {
            return $this-> render('admin/maquettes/blocs_competences/index.html.twig');
        }

        public function competence(): Response
        {
            return $this-> render('admin/maquettes/competences/index.html.twig');
        }

        public function blocs_connaissances(): Response
        {
            return $this-> render('admin/maquettes/blocs_connaissances/index.html.twig');
        }

        public function connaissance(): Response
        {
            return $this-> render('admin/maquettes/connaissances/index.html.twig');
        }
    }
?>