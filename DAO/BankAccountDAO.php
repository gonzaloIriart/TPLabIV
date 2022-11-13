<?php 
    namespace DAO;
    use DAO\IBankAccountDAO;
    use DAO\UserDAO;
    use Models\Keeper as Keeper;
    use Models\BankAccount as BankAccount;
    use Helpers\ParameterHelper;

    class BankAccountDAO implements IBankAccountDAO {

        public function __construct()
        {
            $this->UserDAO = new UserDAO;

        }

        function Add(BankAccount $bankAccount){
            $query = "CALL BankAccount_Add(?, ?, ?, ?)";

            $this->connection = Connection::GetInstance();
            $parameters = ParameterHelper::encodeBankAccount($bankAccount);
            
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        function GetByKeeperId($id){
            $query = "CALL BankAccount_GetByKeeperId(?)";

            $this->connection = Connection::GetInstance();
            $parameters["id"] = $id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
        }
        
        function GetById($id){
            $query = "CALL BankAccount_GetById(?)";

            $this->connection = Connection::GetInstance();
            $parameters["id"] = $id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);}
    }
    ?>