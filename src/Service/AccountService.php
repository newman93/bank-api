<?php
namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Account;
use App\Entity\AccountHistory;

class AccountService {
    private $entityManager;

    public function __construct(ManagerRegistry $doctrine) {
        $this->entityManager = $doctrine->getManager();

    }

    public function validatePin($pin) {
        $message = '';

        if (strlen($pin) != 4 ) {
            $message = 'Pin can contain only 4 numbers. ';        
        } else if (!(is_numeric(substr($pin, 0, 1)) && is_numeric(substr($pin, -1, 1)) && is_numeric(substr($pin, -2, 1))  && is_numeric(substr($pin, -3, 1)) )) {
            $message .= 'Pin can contain only numbers. ';    

        }
        
        return $message;
    }

    public function createAccount($pin) {
        $account = new Account();
        $account->setPin($pin);
  
        $account->setNumber($this->randomNumber(26));
        $account->setCash(0);
        $account->setCreated(new \DateTime());
        $this->entityManager->persist($account);
        $this->entityManager->flush();

        return $account;
    }

    public function validateOperation($operation) {
        $message = '';

        if (!($operation == 1 || $operation == -1)) {
            $message = 'Opoaration 1 income. Operation -1 outcome. ';  
        }

        return $message;
    }

    public function validateCash($cash) {
        $message = '';

        if (!(is_float($cash))) {
            $message = 'Valid cash is float number. ';
        } 

        return $message;
    }

    public function findAccount($number, $pin) {
        $account = $this->entityManager->getRepository(AccountHistory::class)->findOneByNumberAndPin($number, $pin);
        
        return $account;
    }

    public function operationCash($operation, $cash, $account) {
        $accountHistory = new AccountHistory();
        
        $accountHistory->setCash($cash);
        $accountHistory->setOperation($operation);
        $accountHistory->setCreated(new \DateTime());
        $accountHistory->setAccount($account);

        if ($operation == 1) {
            $bilance = $account->getCash() + $cash;
            $account->setCash($bilance); 
        } else {
            $bilance = $account->getCash() - $cash;
            $account->setCash($bilance); 
        };

        $this->entityManager->persist($accountHistory);
        $this->entityManager->persist($account);

        $this->entityManager->flush();
    }

    public function findAccountHistory($number, $pin) {
        $accountHistory = $this->entityManager->getRepository(AccountHistory::class)->findAccountHistoryByNumberAndPin($number, $pin);
        
        $hisotry = [];

        foreach ($accountHistory as $h) {
            $hisotry[] =
            [
                'account-number' => $h->getAccount()->getNumber(),
                'pin' => $h->getAccount()->getPin(),
                'operation' => $h->getOperation() == 1 ? 'income' : 'outcome',
                'cash' => $h->getCash(),
                'created' => $h->getCreated()->format('y-m-d H:i:s')
            ];
        }

        return $hisotry;
    }

    private function randomNumber($length) {
        $result = '';
    
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
    
        return $result;
    }

}
?>