<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AccountService;

class AccountController extends AbstractController
{
    /**
     * @Route("/api/create/account/{pin}", name="app_account")
     */
    public function createAccount(AccountService $accountService, string $pin): JsonResponse
    {

        $message = $accountService->validatePin($pin);

        if ($message == '') {
           $account =  $accountService->createAccount($pin);        

            return new JsonResponse(['status' => 'success', 'account-number' => $account->getNumber(), 'pin' => $account->getPin()]);
        } else {
           return new JsonResponse(['status' => 'error', 'message' => $message]);     
        }
    }

    /**
     * @Route("/api/operation/{operation}/cash/{cash}/number/{number}/pin/{pin}", name="app_add_cash")
     */
    public function oparationCash(AccountService $accountService, int $operation, string $cash, string $number, string $pin): JsonResponse
    {
        
        $message = $accountService->validateOperation($operation);
        $message .= $accountService->validateCash($cash);
        $account =  $accountService->findAccount($number, $pin);        
 
        if ($message == '' && $account != null) {

           $accountService->operationCash($operation, $cash, $account);        

            return new JsonResponse(['status' => 'success', 'account-number' => $account->getNumber(),
             'pin' => $account->getPin(), 'cash' => $cash, 'operation' => ($operation == 1)? 'income' : 'outcome']);
        } else {
            if ($account == null) {
                $message .= 'Wrong number or pin. ';
            }

           return new JsonResponse(['status' => 'error', 'message' => $message]);     
        }
    }

    /**
     * @Route("/api/balance/number/{number}/pin/{pin}", name="app_balance")
     */
    public function getBalanace(AccountService $accountService, string $number, string $pin): JsonResponse
    {

        $account =  $accountService->findAccount($number, $pin);        

        if ($account != null) {
             return new JsonResponse(['status' => 'success', 'account-number' => $account->getNumber(),
              'pin' => $account->getPin(), 'balance' => $account->getCash()]);
         } else {
            $message = 'Wrong number or pin. ';
             
            return new JsonResponse(['status' => 'error', 'message' => $message]);     
        }
    }

     /**
     * @Route("/api/account/history/number/{number}/pin/{pin}", name="app_history")
     */
    public function getAccountHistory(AccountService $accountService, string $number, string $pin): JsonResponse
    {

        $accountHistory =  $accountService->findAccountHistory($number, $pin);        

        if ($accountHistory != []) {
             return new JsonResponse(['status' => 'success', 'accountHistory' => $accountHistory]);
         } else {

                 $message = 'Wrong number or pin or history is empty. ';
             return new JsonResponse(['status' => 'error', 'message' => $message]);     

        }
    }
}

?>
