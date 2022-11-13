<?php 
    namespace DAO;
    use Models\Keeper as Keeper;
    use Models\BankAccount as BankAccount;
    use Models\Payment as Payment;

    class PaymentDAO implements IPaymentDAO 
    {
        function Add(Payment $payment){

        }
        function GetPendingPayByOwnerId($Id){

         
        
            $query = "CALL Payment_GetPendingPayByOwner(?)";

            $this->connection = Connection::GetInstance();
            $parameters["Id"] = $Id;

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $results = array();
            foreach($results as $paymentItem)
            {
                array_push($results, ParameterHelper::decodePayment($paymentItem));
            }

            return $results;
         


        }
        function AddReceipt($id, $receipt){

        }
    }

?>