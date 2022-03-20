<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
use App\Document\Account;
use App\Document\Metric;


class CreateEntriesCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    private DocumentManager $dm ;

    protected function configure(): void
    {
        $this->setDescription('Create new fake accounts and stats');
    }

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $account = new Account();
        $account->setName('Employee');
        $account->setStatus(true);

        $account2 = new Account();
        $account2->setName('Luis');
        $account2->setStatus(true);

        $account3 = new Account();
        $account3->setName('Miguel');
        $account3->setStatus(false);

        $this->dm->persist($account);
        $this->dm->persist($account2);
        $this->dm->persist($account3);

        $this->dm->flush();
        // metrics
        $metric = new Metric();
        $metric->setDate('2021-01-01');
        $metric->setAccountId($account->getId());
        $metric->setimpressions(100);
        $metric->setClicks(20);
        $metric->setSpent(300);

        $metric2 = new Metric();
        $metric2->setDate('2021-02-01');
        $metric2->setAccountId($account->getId());
        $metric2->setimpressions(40);
        $metric2->setClicks(40);
        $metric2->setSpent(660);

        $metric3 = new Metric();
        $metric3->setDate('2021-02-01');
        $metric3->setAccountId($account2->getId());
        $metric3->setimpressions(60);
        $metric3->setClicks(20);
        $metric3->setSpent(860);

        $metric4 = new Metric();
        $metric4->setDate('2021-02-01');
        $metric4->setAccountId($account3->getId());
        $metric4->setimpressions(80);
        $metric4->setClicks(10);
        $metric4->setSpent(360);

        $this->dm->persist($metric);
        $this->dm->persist($metric2);
        $this->dm->persist($metric3);
        $this->dm->persist($metric4);
        $this->dm->flush();

        return Command::SUCCESS;
    }
}