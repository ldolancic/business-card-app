<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Knp\Snappy\Pdf;

class BusinessCardGeneratePdfCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('business-card:generate-pdf')
            ->setDescription('Generates PDF file for a business card')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'ID of a wanted business card')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $businessCardId = $input->getOption('id');

        $entityManager = $this
            ->getContainer()
            ->get('doctrine')
            ->getEntityManager();

        $businessCard = $entityManager
            ->getRepository('AppBundle:BusinessCard')
            ->findOneById($businessCardId);

        $router = $this->getContainer()->get('router');
        $scheme = $router->getContext()->getScheme();
        $host = $router->getContext()->getHost();
        $baseUrl = $scheme . '://' . $host . '/';

        $html = $this
            ->getContainer()
            ->get('twig')
            ->render('businessCard/pdf.html.twig', array(
                'businessCard' => $businessCard,
                'baseUrl' => $baseUrl
            ));

        $rootDir = $this->getContainer()->get('kernel')->getRootDir();
        $rootDir = rtrim($rootDir,"app");

        $snappy = new Pdf($rootDir . 'vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');

        $pdfOutputFilePath = $rootDir . 'web/businessCardPdfs/' . $businessCard->getId() . '.pdf';

        $snappy->generateFromHtml(
            $html,
            $pdfOutputFilePath,
            array(),
            true
        );

        $output->writeln('Business Card pdf sucessfully generated in ' . $pdfOutputFilePath);
    }

}
