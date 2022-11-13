<?php 
    namespace DAO;

use Helpers\ParameterHelper;
use Models\Keeper as Keeper;
    use Models\BankAccount as BankAccount;
    use Models\Payment as Payment;

    class PaymentDAO implements IPaymentDAO 
    {
        function Add(Payment $payment){
            $query = "CALL Payment_Add(?, ?, ?)";

            $this->connection = Connection::GetInstance();
            $parameters = ParameterHelper::encodePayment($payment);
            
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        function GetPendingPayByOwnerId($Id){
            $query = "CALL Payment_GetPendingPayByOwner(?)";

            $this->connection = Connection::GetInstance();
            $parameters["Id"] = $Id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            var_dump($results);


            foreach($results as $paymentItem)
            {
                array_push($results, ParameterHelper::decodePayment($paymentItem));
            }

            return $results;
         


        }
        function AddReceipt($id, $receipt){
            $query = "CALL Payment_AddReceipt(?, ?)";
            $this->connection = Connection::GetInstance();

            $parameters["paymentId"] = $id;
            $parameters["receipt"] = $receipt;
            
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);

        }
    }

?>