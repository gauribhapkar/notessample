<?

class Connect
{
    public function getconnection()
    {
        $host     = "localhost";
        $username = "root";
        $password = "Dbtest123";
        $db_name  = "user1";
        
        
        $conn = mysql_connect("$host", "$username", "$password") or die("cannot connect to server");
        mysql_select_db("$db_name") or die("cannot select db");
        
    }
}