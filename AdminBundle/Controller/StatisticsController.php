<?php
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
 * @Route("/statistics")
 * @Security("has_role('ROLE_ADMIN')")
 */
class StatisticsController extends Controller
{

    /**
     * Lists all system statistics and metrics
     * 
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/list", name="statistics_list_action")
     */
    public function listAction()
    {
        
    }

    /**
     * Renders statistics view / table
     * 
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/update", name="statistics_view_action")
     */
    public function viewAction()
    {
        
    }

    /**
     * Constructs and returns a detailed report for a statistic
     * 
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/report", name="statistics_report_action")
     */
    public function reportAction()
    {
        
    }
}
