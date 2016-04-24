<?php
/**
 * This controller publishes an API that will pull information about the builder's staff.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Controller;


use ThirdEngine\PropelSOABundle\Http\PropelSOASuccessResponse;
use ThirdEngine\PropelSOABundle\Controller\ServiceController;

use Symfony\Component\HttpFoundation\Request;



/**
 * @route /turnkey/team
 */
class TeamController extends ServiceController
{
  /**
   * @Route("/team")
   * @Method({"GET"})
   *
   * @param Request $request
   */
  public function getAction(Request $request)
  {
    $brendaOrozcoDescription = <<<DESC
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

    $jessicaTorresDescription = <<<DESC
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


    $deannaBurghliDescription = <<<DESC
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

    $jerryBrooksDescription = <<<DESC
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

    $zackBurghliDescription = <<<DESC
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


    $olaBurghliDescription = <<<DESC
<ul>
  <li>Establishing relationships with vendors.</li>
  <li>Negotiating purchasing contracts.</li>
  <li>Solving order grievances and discrepancies.</li>
  <li>Managing the purchasing process from the request for proposal (RFP) stage through delivery.</li>
  <li>Review and analyze processes to reduce waste and errors.</li>
  <li>Partner with departments such as production, customer service, sales and safety on supply chain matters.</li>
</ul>
DESC;


    $monicaMontoyaDescription = <<<DESC
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


    $cesarRuizDescription = <<<DESC
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



    $response = [
      [
        'name' => 'Brenda Orozco',
        'title' => 'General Manager',
        'description' => $brendaOrozcoDescription,
        'photo' => 'brenda_orozco.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
      [
        'name' => 'Jessica Torres',
        'title' => 'Production Manager',
        'description' => $jessicaTorresDescription,
        'photo' => 'jessica_torres.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
      [
        'name' => 'Deanna Burghli',
        'title' => 'Director',
        'description' => $deannaBurghliDescription,
        'photo' => 'deanna_burghli.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
      [
        'name' => 'Jerry Brooks',
        'title' => 'AP/AR',
        'description' => $jerryBrooksDescription,
        'photo' => 'jerry_brooks.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
      [
        'name' => 'Zack Burghli',
        'title' => 'President and CEO',
        'description' => $zackBurghliDescription,
        'photo' => 'zack_burghli.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
      [
        'name' => 'Ola Burghli',
        'title' => 'Purchasing Director',
        'description' => $olaBurghliDescription,
        'photo' => 'ola_burghli.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
      [
        'name' => 'Monica Montoya',
        'title' => 'CSR Specialist',
        'description' => $monicaMontoyaDescription,
        'photo' => 'monica_montoya.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
      [
        'name' => 'Cesar Ruiz',
        'title' => 'Warranty Service Tech',
        'description' => $cesarRuizDescription,
        'photo' => 'cesar_ruiz.jpg',

        'twitter' => '',
        'linkedin' => '',
      ],
    ];


    return new PropelSOASuccessResponse($response, 200);
  }
}