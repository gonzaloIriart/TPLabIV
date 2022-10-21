<?php
    namespace Helpers;

    use Models\User;
    use Models\UserRol;
    use Models\Keeper;
    use Models\Owner;
    use Models\Pet;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PetDAO as PetDAO;

    class JsonHelper {


        public function __construct()
        {
            $this->ownerDAO = new OwnerDAO();
            $this->petDAO = new PetDAO();
        }

        static function encodeUser($user){
            $encodedUser["userId"] = $user->getUserId();
            $encodedUser["email"] = $user->getEmail();
            $encodedUser["password"] = $user->getPassword();
            $encodedUser["name"] = $user->getName();
            $encodedUser["roles"] = array();
            
            foreach($user->getRoles() as $userRol) {
                $encodedUserRol["userRolId"] = $userRol->getUserRolId();
                $encodedUserRol["rol"] = $userRol->getRol();
                $encodedUserRol["user"] = null;
                array_push($encodedUser["roles"], $encodedUserRol);
            }
            return $encodedUser;
        }

        static function decodeUser($encodedUser){
            $roles = array();
            $user = new User();
            $user->setUserId($encodedUser["userId"]);
            $user->setEmail($encodedUser["email"]);
            $user->setPassword($encodedUser["password"]);
            $user->setName($encodedUser["name"]);
            $user->setRole($encodedUser["role"]);
            return $user;
        }

        // static function fromOwnerIdToOwnerObject($ownerId)
        // {
        //     $owner = new Owner();
        //     $owner = $this->ownerDAO->GetById($ownerId);
        //     return $owner;
        // }

        static function fromPetsIdToPetsObject($petList)
        {
            $petDAO = new PetDAO();
            $objects = array();
            $petList = explode(', ', $petList);
            array_shift($petList);
            foreach($petList as $listItem)
            {   
                $pet = $petDAO->GetById($listItem);
                array_push($objects, $pet);
            }

            return $objects;
        }
    }
?>