<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function init()
    {
        date_default_timezone_set( 'Europe/Paris' );
        parent::init();
    }

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new MZ\MailChimpBundle\MZMailChimpBundle(),

            new RocketChef\DataBundle\RocketChefDataBundle(),
            new RocketChef\RecipeBookBundle\RocketChefRecipeBookBundle(),
            new RocketChef\DashboardBundle\RocketChefDashboardBundle(),
            new RocketChef\UserBundle\RocketChefUserBundle(),
            new RocketChef\MenuBundle\RocketChefMenuBundle(),
            new RocketChef\SettingBundle\RocketChefSettingBundle(),
            new RocketChef\IngredientBundle\RocketChefIngredientBundle(),
            new RocketChef\SellingBundle\RocketChefSellingBundle(),

            new Utils\WidgetBundle\WidgetBundle(),
            new Utils\NotifyMessengerBundle\UtilsNotifyMessengerBundle(),

            new Site\SiteBundle\SiteSiteBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new CoreSphere\ConsoleBundle\CoreSphereConsoleBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
