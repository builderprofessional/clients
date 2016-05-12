<?php
/**
 * This class gives the ability to clean a site out of the database.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Command;


use Clients\TurnKeyBundle\Model\SiteQuery;

use Engine\EngineBundle\Command\EngineCommand;

use ThirdEngine\Factory\Factory;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CleanSiteCommand extends EngineCommand
{
  protected function configure()
  {
    $this
      ->setName('turnkey:cleansite')
      ->setDescription('This command will completely remove a site\'s data from the database')
      ->addArgument('code', InputArgument::REQUIRED, 'What is the site code you want to remove?');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $this->input = $input;
    $this->output = $output;

    $siteCode = $input->getArgument('code');

    $site = Factory::createNewQueryObject(SiteQuery::class)->findOneByCode($siteCode);
    $site->removeAllData();
  }
}