<?php
// Stefan Erakovic 3086/2016
namespace Psi\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Psi\AdminBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends Controller
{

    /**
     * Renders dashboard
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/dashboard", name="admin_dashboard_action")
     */
    public function dashboardAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render(
                'PsiAdminBundle:Admin:dashboard.html.php', [
                'router' => $this->container->get('router'),
                'user' => $user,
        ]);
    }

    /**
     * Renders admin login page
     * @Route("/", name="admin_login_action")
     */
    public function loginAction(Request $request)
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_dashboard_action');
        }

        $loginForm = new LoginForm();

        $form = $this->createFormBuilder($loginForm)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Log In'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $loginForm = $form->getData();

            $email = $loginForm->getEmail();
            $password = $loginForm->getPassword();

            $manager = $this->get('psi.admin.user.manager');

            $user = $manager->validateCredentials($email, $password);
            if ($user) {
                $roles = $user->getRoles()->toArray();

                if ($manager->hasAdminPrivileges($user)) {
                    $token = new UsernamePasswordToken($user, $user->getPassword(), "main", $roles);
                    $this->get("security.token_storage")->setToken($token);

                    $event = new InteractiveLoginEvent($request, $token);
                    $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

                    return $this->redirectToRoute('admin_dashboard_action');
                }
            } else {

            }
        }

        return $this->render(
                'PsiAdminBundle:Admin:login.html.php', [
                'router' => $this->container->get('router'),
                'form' => $form->createView()
        ]);
    }
}
