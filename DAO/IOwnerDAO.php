<?php 
    namespace DAO;

    use Models\Owner as Owner;
    use Models\Pet as Pet;

    interface IOwnerDAO 
    {
        function Add(Owner $owner);
        function GetById($id);
        function GetPetListByOwner($id);
        function AddPetToOwner(Owner $owner, Pet $pet);
    }

?>