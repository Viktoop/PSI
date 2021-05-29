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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Psi\AdminBundle\Form\UserForm;
use Psi\UserBundle\Entity\User;

/**
 * @Route("/user")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserController extends Controller
{

    /**
     * Lists all users in the system
     * 
     * @Route("/list", name="admin_user_list_action")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(User::class);

        $page = $request->get('page') ? $request->get('page') : 1;
        $pageSize = 30;
        $users = $repository->findAll();

        $data = [];

        foreach ($users as $user) {
            if ($user->getAdditionalData()) {
                $additional = unserialize($user->getAdditionalData());
            } else {
                $additional['summonerName'] = "";
                $additional['firstname'] = "";
                $additional['lastname'] = "";
            }

            $_data = [];
            $_data['id'] = $user->getId();
            $_data['email'] = $user->getEmail();
            $_data['summonerName'] = isset($additional['summonerName']) ? $additional['summonerName'] : "";
            $_data['firstname'] = $additional['firstname'];
            $_data['lastname'] = $additional['lastname'];
            $_data['status'] = $user->getStatus();

            $data[] = $_data;
        }

        return $this->render(
                'PsiAdminBundle:User:list.html.php', [
                'userData' => $data,
                'router' => $this->container->get('router')
        ]);
    }

    protected function buildUserForm(UserForm $userForm, $statusRegistry, $isNew = true, $action = "")
    {
        $formBuilder = $this->createFormBuilder($userForm)
            ->add('email', EmailType::class, ['attr' => ['class' => 'form-control']])
            ->add('firstname', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('lastname', TextType::class, ['attr' => ['class' => 'form-control']]);
        if ($isNew) {
            $formBuilder->setAction($this->generateUrl('admin_user_new_action'));
            $formBuilder->add('password', PasswordType::class, ['attr' => ['class' => 'form-control']]);
        } else {
            $formBuilder->setAction($action);
        }
        return $formBuilder
                ->add('status', ChoiceType::class, [
                    'choices' => $statusRegistry->toFormOptions(),
                    'attr' => ['class' => 'form-control']
                ])
                ->add('summonerName', TextType::class, ['required' => false, 'attr' => ['class' => 'form-control']])
                ->add('purchaseOrderNumber', TextType::class, ['required' => false, 'attr' => ['class' => 'form-control']])
                ->add('additionalData', TextareaType::class, ['required' => false, 'attr' => ['class' => 'form-control']])
                ->add('save', SubmitType::class, ['label' => 'Save', 'attr' => ['class' => 'btn btn-primary']])
                ->getForm();
    }

    protected function extractAdditionalData(UserForm $userForm)
    {
        return serialize([
            'firstname' => $userForm->getFirstname(),
            'lastname' => $userForm->getLastname(),
            'purchaseOrderNumber' => $userForm->getPurchaseOrderNumber(),
            'additional' => $userForm->getAdditionalData(),
            'summonerName' => $userForm->getSummonerName()
        ]);
    }

    /**
     * User new action
     * 
     * @Route("/new", name="admin_user_new_action")
     */
    public function newAction(Request $request)
    {
        $manager = $this->get('psi.user.manager');
        $statusRegistry = $this->get('psi.user.model.user.status');

        $userForm = new UserForm();

        $form = $this->buildUserForm($userForm, $statusRegistry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userForm = $form->getData();

            if (!$userForm->getPassword()) {
                $this->addFlash('error', "Password is mandatory.");
            } else {
                $additionalData = $this->extractAdditionalData($userForm);
                $user = $manager->newUser($userForm->getEmail(), $userForm->getEmail(), $userForm->getPassword());
                $user->getEntity()
                    ->setStatus($userForm->getStatus())
                    ->setAdditionalData($additionalData);

                $manager->saveUser($user);

                $this->addFlash('success', 'User added.');
                return $this->redirectToRoute('admin_user_edit_action', ['user' => $user->getId()]);
            }
        } elseif ($form->isSubmitted()) {
            $this->addFlash('error', $form->getErrors());
        }

        return $this->render(
                'PsiAdminBundle:User:new.html.php', [
                'form' => $form->createView(),
                'router' => $this->container->get('router')
        ]);
    }

    /**
     * User edit action
     * 
     * @Route("/edit/{user}", name="admin_user_edit_action", defaults={"user" = 0})
     */
    public function editAction(Request $request)
    {
        $manager = $this->get('psi.user.manager');
        $statusRegistry = $this->get('psi.user.model.user.status');

        if (!$request->get('user')) {
            $this->addFlash('error', "Requested user doesn't exist");
            return $this->redirectToRoute('admin_user_list_action');
        }

        $user = $manager->findUser(['id' => $request->get('user')]);

        if (!$user || !$user->getId()) {
            $this->addFlash('error', "Requested user doesn't exist");
            return $this->redirectToRoute('admin_user_list_action');
        }

        $userForm = new UserForm();

        $additionalData = unserialize($user->getEntity()->getAdditionalData());

        $userForm->setEmail($user->getEmail())
            ->setFirstname(isset($additionalData['firstname']) ? $additionalData['firstname'] : "")
            ->setLastname(isset($additionalData['lastname']) ? $additionalData['lastname'] : "")
            ->setStatus($user->getStatus())
            ->setPurchaseOrderNumber(isset($additionalData['purchaseOrderNumber']) ? $additionalData['purchaseOrderNumber'] : "")
            ->setAdditionalData(isset($additionalData['additional']) ? $additionalData['additional'] : "")
            ->setSummonerName(isset($additionalData['summonerName']) ? $additionalData['summonerName'] : "");

        $form = $this->buildUserForm($userForm, $statusRegistry, false, $this->generateUrl('admin_user_edit_action', ['user' => $request->get('user')]));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userForm = $form->getData();

            $additionalData = $this->extractAdditionalData($userForm);

            $user->getEntity()
                ->setUsername($userForm->getEmail())
                ->setEmail($userForm->getEmail())
                ->setStatus($userForm->getStatus())
                ->setAdditionalData($additionalData);

            if ($manager->saveUser($user)) {
                $this->addFlash('success', 'User updated.');
            } else {
                $this->addFlash('error', "Couldn't update user.");
            }
        }


        return $this->render(
                'PsiAdminBundle:User:edit.html.php', [
                'user' => $user,
                'form' => $form->createView(),
                'router' => $this->container->get('router')
        ]);
    }
}
