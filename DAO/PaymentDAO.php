<?php 
    namespace DAO;

    use Models\Keeper as Keeper;
    use Models\BankAccount as BankAccount;
    use Models\Payment as Payment;
    use Helpers\ParameterHelper;

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

            $payments = array();

            foreach($results as $paymentItem)
            {
                array_push($payments, ParameterHelper::decodePayment($paymentItem));
            }

            return $payments;
         


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