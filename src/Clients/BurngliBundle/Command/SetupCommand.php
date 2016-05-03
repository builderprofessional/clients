<?php
/**
 * This class sets up the initial data for Burghli.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\BurngliBundle\Command;


use Clients\TurnKeyBundle\Base\Setup;
use Engine\EngineBundle\Command\EngineCommand;

use ThirdEngine\Factory\Factory;

use stdClass;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SetupCommand extends EngineCommand
{
  protected function configure()
  {
    $this
      ->setName('burghli:setup')
      ->setDescription('Set the initial data for Burghli homes.');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $builderSetup = Factory::createNewObject(Setup::class);
    $builderSetup->setupNewBuilder('burghli', 'Burghli Homes', '4615 N. Freeway', null, 'Houston', 'TX', '77022', '(713) 691-3948', '(713) 692-6063');

    $descriptions = $this->getTeamMemberDescriptions();

    $builderSetup->setupTeamMember('burghli', 'Brenda', 'Orozco', 'General Manager', $descriptions->brendaOrozco, 'brenda_orozco.jpg');
    $builderSetup->setupTeamMember('burghli', 'Jessica', 'Torres', 'Production Manager', $descriptions->jessicaTorres, 'jessica_torres.jpg');
    $builderSetup->setupTeamMember('burghli', 'Deanna', 'Burghli', 'Director', $descriptions->deannaBurghli, 'deanna_burghli.jpg');
    $builderSetup->setupTeamMember('burghli', 'Zack', 'Burghli', 'President and CEO', $descriptions->zackBurghli, 'zack_burghli.jpg');
    $builderSetup->setupTeamMember('burghli', 'Ola', 'Burghli', 'Purchasing Director', $descriptions->olaBurghli, 'ola_burghli.jpg');
    $builderSetup->setupTeamMember('burghli', 'Monica', 'Montoya', 'CSR Specialist', $descriptions->monicaMontoya, 'monica_montoya.jpg');
  }

  protected function getTeamMemberDescriptions()
  {
    $teamDescriptions = new stdClass();

    $teamDescriptions->brendaOrozco = <<<DESC
<ul>
  <li>Increases management's effectiveness by recruiting, selecting, orienting, training, coaching, counseling, and disciplining managers;
communicating values, strategies, and objectives; assigning accountabilities; planning, monitoring, and assess job results,
 developing a climate for offering information and opinions; providing educational opportunities.</li>
 <li>Coordinates efforts by establishing procurement, production, marketing, field, and technical services policies and practices;
 coordinating actions with corporate staff. Builds company image by collaborating with customers, government, community organizations,
 and employees; enforcing ethical business practices.</li>
 <li>Maintains quality service by establishing and enforcing organization standards.</li>
 <li>Contributes to team effort by accomplishing related results as needed.</li>
</ul>
DESC;

    $teamDescriptions->jessicaTorres = <<<DESC
<ul>
  <li>Planning and organizing production schedules.</li>
  <li>Assessing project and resources requirements.</li>
  <li>Estimating, negotiating and agreeing budgets and timescales with clients and managers.</li>
  <li>Determining quality controls standards.</li>
  <li>Overseeing production processes.</li>
  <li>Re-negotiating timescales or schedules as necessary.</li>
  <li>Selecting, ordering, and purchasing materials.</li>
  <li>Organizing the repair and routine maintenance of production equipment.</li>
  <li>Liaison with buyers, marketing and sales staff.</li>
  <li>Supervising the work of junior staff.</li>
</ul>
DESC;


    $teamDescriptions->deannaBurghli = <<<DESC
<ul>
  <li>Direct the activities and productivity of a department or entire organization.</li>
  <li>Provide training and guidance.</li>
  <li>Delegate duties.</li>
  <li>Create schedules.</li>
  <li>Work with the Assistant Director to sustain and grow programs and service.</li>
  <li>Manage administrative functions to ensure smooth and efficient operations of the organization.</li>
  <li>Support the organization's strategic alliances and partnership.</li>
  <li>Ensure performance goals are met and set.</li>
  <li>Fulfill duties delegated.</li>
  <li>Attend and preside over meetings.</li>
  <li>Participate in strategic planning.</li>
  <li>Represent the organization to the public, key stakeholders, and business partner.</li>
  <li>Plan and implement the annual calendar of activities.</li>
  <li>Help create budgets and track expenditures.</li>
  <li>Create presentations for meetings.</li>
</ul>
DESC;

    $teamDescriptions->jerryBrooks = <<<DESC
<ul>
  <li>Prepares work to be accomplished by gathering and sorting documents and related information.</li>
  <li>Pays invoices by verifying transaction information; scheduling and preparing dispursements; obtaining authorization of payment.</li>
  <li>Obtains revenue by verifying transaction information; computing charges and refunds; preparing and mailing invoices;
  identifying delinquent accounts and insufficient payments.</li>
  <li>Prepares financial reports by collecting, analyzing, and summarizing account information and trends.</li>
  <li>Maintains accounting ledgers by posting account transactions.</li>
  <li>Verifies accounts by reconciling statements and transactions.</li>
  <li>Maintains financial security by following internal accounting controls.</li>
  <li>Secures financial information by completing database backups.</li>
</ul>
DESC;

    $teamDescriptions->zackBurghli = <<<DESC
<ul>
  <li>Plan, develop, organize, implement, direct, and evaluate the organization's fiscal function and performance.</li>
  <li>Participate in the development of the corporation's plans and programs as a strategic partner.</li>
  <li>Evaluate and advise on the impact of long range planning, introduction of new programs/strategies and regulatory action.</li>
  <li>Develop credibility for the finance group by providing timely and accurate nalysis of budgets, financial reports and financial trends.</li>
  <li>Enhance and/or develop, implement and enforce policies and procedures of the organization by way of systems that will improve
  the overall operation and effectiveness of the corporation.</li>
  <li>Establish credibility throughout the organization as an effective developer of solutions to business challenges.</li>
  <li>Improve the budgeting process on a continual basis through education of department managers on financial issues impacting their budgets.</li>
  <li>Act as an advisor from the financial perspective on any contracts into which the corporation may enter.</li>
  <li>Evaluate the finance division structure and team plan for continual improvement of the efficiency and effectiveness
  of the group as well as providing individuals with professional and personal growth with emphasis on opportunities (where possible)
  of individuals.</li>
</ul>
DESC;


    $teamDescriptions->olaBurghli = <<<DESC
<ul>
  <li>Establishing relationships with vendors.</li>
  <li>Negotiating purchasing contracts.</li>
  <li>Solving order grievances and discrepancies.</li>
  <li>Managing the purchasing process from the request for proposal (RFP) stage through delivery.</li>
  <li>Review and analyze processes to reduce waste and errors.</li>
  <li>Partner with departments such as production, customer service, sales and safety on supply chain matters.</li>
</ul>
DESC;


    $teamDescriptions->monicaMontoya = <<<DESC
<ul>
  <li>Attracts potential customers by answering product and service questions; suggesting information about other products and services.</li>
  <li>Maintains customer records by updating account information.</li>
  <li>Resolves product or service problems by clarifying the customer's complaint; determining the cause of the problem; selecting
  and explaining the best solution to solve the problem; expediting correction or adjustment; following up to ensure resolution.</li>
  <li>Maintains financial accounts by processing customer adjustments.</li>
  <li>Prepares product or service reports by collecting and analyzing customer information.</li>
  <li>Contributes to team effort by accomplishing related results as needed.</li>
</ul>
DESC;


    $teamDescriptions->cesarRuiz = <<<DESC
<ul>
  <li>Build relationships daily with homeowners, trade partners, and vendors.</li>
  <li>Be responsible for completion of all warranty repair work, reactive or proactive, performed in the home that you are assigned to.</li>
  <li>Communicate daily with your team leader.</li>
  <li>Inspect all work for quality and completion, and have the home owner sign off on your work order.</li>
  <li>Responsible for using the computer systems and technologies provided to maintain your work order schedule, as well as to
  schedule trade partners as needed.</li>
  <li>Develop an organizational system that allows you to be efficient and responsive.</li>
  <li>Have a working knowledge of and to adhere to all standards set forth in the third party warranty guidelines.</li>
  <li></li>
</ul>
DESC;


    return $teamDescriptions;
  }
}
