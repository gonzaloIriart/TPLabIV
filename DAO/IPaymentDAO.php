<?php 
    namespace DAO;
    use Models\Keeper as Keeper;
    use Models\BankAccount as BankAccount;
    use Models\Payment as Payment;

    interface IPaymentDAO 
    {
        function Add(Payment $payment);
        function GetPendingPayByOwnerId($id);
        function AddReceipt($id, $receipt);
    }

?>