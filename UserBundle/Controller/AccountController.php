<?php
// Stefan Erakovic 3086/2016
namespace Psi\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Psi\UserBundle\Form\LoginForm;
use Psi\UserBundle\Form\RegisterForm;
use Psi\UserBundle\Form\ResetForm;
use Psi\UserBundle\Model\TokenStatus;
use Psi\UserBundle\Model\UserStatus;
use Psi\UserBundle\Entity\AccessToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AccountController extends Controller
{

    /**
     * User my account dashboard
     * @param Request $request
     * @Route("/", name="user_index_action")
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_search_action');
        }

        return $this->render(
                'PsiUserBundle:Account:login.html.php', [
                'router' => $this->container->get('router')
        ]);
    }

    /**
     * @Route("/reset", name="user_reset_action")
     */
    public function resetAction(Request $request)
    {
        $resetForm = new ResetForm();
        $form = $this->createFormBuilder($resetForm)
            ->add('email', EmailType::class)
            ->getForm();

        $form->handleRequest($request);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $resetForm = $form->getData();
            $userManager = $this->get('psi.user.manager');

            $user = $userManager->findUser(['email' => $resetForm->getEmail()]);
            if ($user) {
                $password = bin2hex(openssl_random_pseudo_bytes(4));
                $userManager->updatePassword($user, $password);

                $message = new \Swift_Message(null);
                $message->setSubject('N2M Reset password');
                $message->setFrom('support@n2m.psi.test.com')
                    ->setTo($resetForm->getEmail())
                    ->setBody(
                        $this->renderView(
                            'PsiUserBundle:Account:_partial/reset_email.html.php', array('password' => $password)
                        ), 'text/html'
                );
                if (!$this->get('mailer')->send($message, $failures)) {}

                $this->addFlash('success', "An email with your new password has been sent.");
            } else {
                $this->addFlash('error', "A user with the specified email address doesn't exist.");
            }

            //echo success message
        } else {
            $errors = $form->getErrors();
            if ($errors->count() > 0) {
                $this->addFlash('error', (string) $errors);
            }
        }

        return $this->indexAction($request);
    }

    /**
     * @Route("/login", name="user_login_action")
     */
    public function loginAction(Request $request)
    {
        $loginForm = new LoginForm();

        $form = $this->createFormBuilder($loginForm)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Login'))
            ->getForm();
        $form->handleRequest($request);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $loginForm = $form->getData();

            $email = $loginForm->getEmail();
            $password = $loginForm->getPassword();

            $manager = $this->get('psi.user.manager');

            $user = $manager->validateCredentials($email, $password);
            if ($user) {
                $roles = $user->getRoles()->toArray();
                $roles[] = "IS_AUTHENTICATED_FULLY";

                $token = new UsernamePasswordToken($user, $user->getPassword(), "main", $roles);
                $this->get("security.token_storage")->setToken($token);

                $event = new InteractiveLoginEvent($request, $token);
                $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

                return $this->render(
                        'PsiUserBundle:Account:success.html.php', [
                        'router' => $this->container->get('router'),
                        'message' => "You have been logged in.",
                ]);
            } else {
                // echo fail message
                $this->addFlash('error', "Invalid login information.");
            }
        } elseif (!$form->isValid()) {
            $errors = $form->getErrors();
            if ($errors->count() > 0) {
                $this->addFlash('error', (string) $errors);
            }
        }

        return $this->indexAction($request);
    }

    /**
     * @Route("/register", name="user_register_action")
     */
    public function registerAction(Request $request)
    {
        $registerForm = new RegisterForm();
        $form = $this->createFormBuilder($registerForm)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Register'))
            ->getForm();

        $form->handleRequest($request);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $registerForm = $form->getData();

            $userManager = $this->get('psi.user.manager');

            $firstname = $registerForm->getFirstname();
            $lastname = $registerForm->getLastname();
            $email = $registerForm->getEmail();
            $username = $email;
            $password = $registerForm->getPassword();

            try {
                $user = $userManager->newUser($username, $email, $password);
            } catch (\Exception $e) {
                $user = false;
            }

            if ($user) {
                $additionalData = serialize([
                    'firstname' => $firstname,
                    'lastname' => $lastname
                ]);
                $user->getEntity()
                    ->setAdditionalData($additionalData);
                $userManager->saveUser($user);

                // echo success message
                $this->addFlash('success', "Your account has been registered. We will contact you on your email address further instructions.");
                return $this->render(
                        'PsiUserBundle:Account:success.html.php', [
                        'router' => $this->container->get('router'),
                        'message' => "Your account has been registered. Please wait further instructions.",
                ]);
            } else {
                // echo fail message
                $this->addFlash('error', "A user with this email allready exists.");
            }
        } else {
            $errors = $form->getErrors();
            if ($errors->count() > 0) {
                $this->addFlash('error', (string) $errors);
            }
        }
        return $this->indexAction($request);
    }

    /**
     * @Route("/confirm/{token}", name="user_confirm_action")
     * @param Request $request
     * @return Response
     */
    public function confirmAction(Request $request)
    {
        $token = $request->get("token");
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository(AccessToken::class);
        $tokenManager = $this->get("psi.user.access.token.manager");

        // expire old tokens
        $tokenManager->expireTokens();

        $result = $repository->findOneBy([
            'token' => $token,
            'state' => TokenStatus::STATUS_VALID
        ]);

        if ($result) {
            // activate user
            $user = $result->getUser();
            $user->setStatus(UserStatus::STATUS_ENABLED);
            $result->setState(TokenStatus::STATUS_INVALID);
            $manager->persist($result);
            $manager->persist($user);
            $manager->flush();

            return $this->render(
                    'PsiUserBundle:Account:success.html.php', [
                    'router' => $this->container->get('router'),
                    'message' => "Your account has been activated. You may now login.",
            ]);
        } else {
            $this->addFlash('error', "The confirmation url you used is no longer valid.");
        }
        // invalid token
        return $this->indexAction($request);
    }
}
