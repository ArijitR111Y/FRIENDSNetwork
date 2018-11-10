<?php
class User
{
	private $user;
	private $con;

	public function __construct($con,$user)
	{
		$this->con=$con;
		$userDetailsQuery = mysqli_query($con,"SELECT * FROM user WHERE username='$user'");
		if (!$userDetailsQuery)
	{
    	printf("Error: %s\n", mysqli_error($con));
    	exit();
	}
		$this->user=mysqli_fetch_array($userDetailsQuery); 
	}


	public function getUsername()
	{
		return $this->user['username'];
	}
	public function getFirstAndLastName()
	{
		$username=$this->user['username'];
		$query=mysqli_query($this->con,"SELECT first_name,last_name from user where username='$username'");
		$row=mysqli_fetch_array($query);
		return $row['first_name']." ".$row['last_name'];
	}

	 public function getNumPosts() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT num_posts FROM user WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }
    
    public function isFriend($username_to_check) {
        $usernameComma = "," . $username_to_check . ",";

        if((strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username'])) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getFriendArray() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT friend_array FROM user WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['friend_array'];
    }
    
    public function getProfilePic() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT profile_pic FROM user WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_pic'];
    }

    public function isClosed(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT user_closed from user WHERE username='$username'");
        $row = mysqli_fetch_array($query);

        if($row['user_closed']=='yes')
            return true;
        else
            return false;
    }

    public function didRecieveRequest($user_from)
    {
        $user_to = $this->user['username'];
        $check_request_query = mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to = '$user_to' and user_from = '$user_from' ");
        if (mysqli_num_rows($check_request_query)>0) {
            return true;
        }
        else{
            return false;
        }
    }

    public function didSendRequest($user_to)
    {
        $user_from = $this->user['username'];
        $check_request_query = mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to = '$user_to' and user_from = '$user_from' ");
        if (mysqli_num_rows($check_request_query)>0) {
            return true;
        }
        else{
            return false;
        }
    }
    public function removeFriend($user_to_remove)
    {
        $logged_in_user = $this->user['username'];

        $query = mysqli_query($this->con, "SELECT friend_array from user where username='$user_to_remove'");
        $row = mysqli_fetch_array($query);
        $friend_array_username = $row['friend_array'];
        $new_friend_array = str_replace($user_to_remove.',', "", $this->user['friend_array'] );
        $remove_friend_query = mysqli_query($this->con, "UPDATE user SET friend_array='$new_friend_array' where username='$logged_in_user'");

        $new_friend_array = str_replace($this->user['username'].',', "", $friend_array_username);
        $remove_friend_query = mysqli_query($this->con, "UPDATE user SET friend_array='$new_friend_array' where username='$user_to_remove'");

    }

    public function sendRequest($user_to) {
        $user_from = $this->user['username'];
        $query = mysqli_query($this->con, "INSERT INTO friend_requests VALUES('', '$user_to', '$user_from')");
    }

    public function getMutualFriends($user_to_check) {
        $mutualFriends = 0;
        $user_array = $this->user['friend_array'];
        $user_array_explode = explode(",", $user_array);

        $query = mysqli_query($this->con, "SELECT friend_array FROM user  WHERE username='$user_to_check'");
        $row = mysqli_fetch_array($query);
        $user_to_check_array = $row['friend_array'];
        $user_to_check_array_explode = explode(",", $user_to_check_array);

        foreach($user_array_explode as $i) {

            foreach($user_to_check_array_explode as $j) {

                if($i == $j && $i != "") {
                    $mutualFriends++;
                }
            }
        }
        return $mutualFriends;

    }
}
?>