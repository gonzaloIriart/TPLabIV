<?php 
    namespace DAO;
    use Models\Keeper as Keeper;
    use Models\BankAccount as BankAccount;
    use Models\Payment as Payment;
    use Helpers\ParameterHelper;

    class PaymentDAO implements IPaymentDAO 
    {
        function Add(Payment $payment){

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

        }
    }

?>