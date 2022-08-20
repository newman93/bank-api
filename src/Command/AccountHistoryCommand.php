<?php
namespace App\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;

use App\Service\AccountService;

class AccountHistoryCommand extends Command {
    protected static $defaultName = 'app:account-history';

    private $accountService;

    public function __construct(AccountService $accountService) {
        parent::__construct();
        $this->accountService = $accountService;
    }

    protected function configure()
    {
 /*       $this
            ->setName('app:account-hisotry')
            ->setDescription('Account history')
            ->addArgument('number', InputArgument::REQUIRED, 'Provide a number')
            ->addArgument('pin', InputArgument::OPTIONAL, 'Provide a pinm')
        ;
        */
    }

    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question1 = new Question('Provide a number: ');
        $question2 = new Question('Provide a pin: ');
    
        $number = $helper->ask($input, $output, $question1);
        $pin = $helper->ask($input, $output, $question2);
        $accountHistory = $this->accountService->findAccountHistory($number, $pin);

        if ($accountHistory != []) {
            $output->writeln('Accounnt Hisotry: '. json_encode($accountHistory));
        } else {

                $output->writeln('Wrong number or pin or history is empty. ');

       }
       
        return Command::SUCCESS;
    }
}

?>