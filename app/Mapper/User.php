<?php
namespace Notes\Mapper;

use Notes\Model\User as UserModel;

use Notes\Database\Database as Database;


class User
{
    
    public function delete($id)
    {
        
            $user     = new UserModel();
            $user->id = $id;

            $db = new Database();
            $sql = "delete from user where id=:id";
            
            $resultset = $db->delete($id,$sql);
            return $resultset;
        }
    public function create($input)
    {
            
            $user = new UserModel();
            $user->firstName = $input['firstName'];

            $user->lastName  = $input['lastName'];
            $user->email     = $input['email'];
            
            $sql = "INSERT INTO user (firstName,lastName,email) VALUES ('$user->firstName', '$user->lastName', '$user->email')";
            $db = new Database();
            $resultset = $db->put($sql);
            $user->id = $resultset;
            return $user;
       }
    
    
    public function read($id)
    {
        
            $user     = new UserModel();
            $user->id = $id;
            
            $sql = "SELECT id, firstName, lastName,email FROM user where id=$id";
            
            $db = new Database();
            $resultset = $db->get($sql);
             $user->firstName = $resultset['firstName'];
             $user->lastName  = $resultset['lastName'];
             $user->email     = $resultset['email'];
             
                return $user;
            }
}     
