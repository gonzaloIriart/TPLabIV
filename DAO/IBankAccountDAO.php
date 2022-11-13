<?php 
    namespace DAO;
    use Models\Keeper as Keeper;
    use Models\BankAccount as BankAccount;

    interface IBankAccountDAO 
    {
        function Add(BankAccount $bankAccount);
        function GetByKeeperId($id);
        function GetById($id);
    }

?>