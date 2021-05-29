<?php
// Marko Mrkonjic - 3139/2016
namespace Psi\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/configuration")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ConfigurationController extends Controller
{

    /**
     * Lists all system settings in a form
     * 
     * @Route("/", name="configuration_index_action")
     */
    public function indexAction()
    {
        $configurationRegistry = $this->get('psi.configuration.manager.registry');

        return $this->render(
                'PsiAdminBundle:Configuration:configuration.html.php', [
                'configurationRegistry' => $configurationRegistry,
                'router' => $this->get('router'),
                'action' => $this->generateUrl('configuration_update_action')
        ]);
    }

    /**
     * Updates system settings configuration
     * 
     * @Route("/update", name="configuration_update_action")
     */
    public function updateAction(Request $request)
    {
        $configurationData = $request->get('configuration');
        
        if ($configurationData) {
            foreach ($configurationData as $name => $value) {
                $configurationRegistry = $this->get('psi.configuration.manager.registry');
                $configuration = $configurationRegistry->getConfiguration($name);
                $configuration->setValue($value);
                $configuration->save();
            }

            $this->addFlash('success', "Updated system configuration.");
        }

        return $this->redirectToRoute('configuration_index_action');
    }
}
