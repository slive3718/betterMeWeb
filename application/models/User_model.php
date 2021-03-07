<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
      
        $this->load->library('form_validation');
    }

    public function index(){

        
    }

    public function signUpUser($username,$password,$email,$account_type){
        
        $data = [
            'username'=> $username,
            'email'=>$email,
            'password'=>password_hash($password, PASSWORD_DEFAULT),
            'account_type'=>$account_type
            ];
            return $this->db->insert('tblusers', $data);
    }

    public function loginValidation($uname, $pword)
    {
        $query = $this->db->query("SELECT * FROM tblusers where username='$uname' && account_type='U'");


        if ($query->num_rows()>0) {
            $row = $query->row_array();
            
           
    
            if (password_verify($pword, $row['password'])) {
                return true;
      
            } else {
        
                $this->session->set_flashdata('error','Invalid Username or Password !');
                return false;
            }
        } else {
            $this->session->set_flashdata('error','Invalid Username or Password !');
            return false;
        }
    }



    public function check_user($username,$email)
        {
            $qstr=$this->db->query("SELECT * FROM tblusers WHERE username='$username' && email='$email' LIMIT 1");
                
            if ($qstr->num_rows() > 0) {
                $result=$qstr->result_array();
            } else {
                $result=null;
            }
            return $result;
        }

        
public function get_session_data(){

    $sess_uname=$this->session->userdata('uname');

    $qstr=$this->db->get('tblusers');
    $qstr=$this->db->get_where('tblusers', array('username'=> $sess_uname));
    //$query=$this->db->query($qstr);
    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}
       


        public function get_dietPlan(){
            // $qstr=$this->db->get('tblposts');
            // $qstr=$this->db->get_where('tblposts', array('post_type'=> 'Diet_Plan'));
            //$query=$this->db->query($qstr);
            $qstr=$this->db->query("SELECT * FROM tblposts LEFT JOIN tblusers on tblposts.post_user_id=tblusers.userId where tblposts.archive != 1 order by tblposts.date_posted desc");
            $sess_id=$this->session->userdata('id');
            // $qstr=$this->db->query("SELECT * from tblposts where archive!=1 order by date_posted desc");
        
            if ($qstr->num_rows() > 0) {
                $result=$qstr->result_array();
            } else {
                $result=null;
            }
            return $result;
        }
        
public function model_show_profilepic()
{
    $qstr=$this->db->query('SELECT * from profilepic');


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}


  
public function get_community_post(){

    $qstr=$this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.archive_status !=1 order by tblcommunity.thread_date desc");

    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
    
}


public function get_dietPlanFull($post_id){
    $qstr=$this->db->get('tblposts');
    $qstr=$this->db->get_where('tblposts', array('post_type'=> 'Diet_Plan', 'post_id'=>$post_id));
    //$query=$this->db->query($qstr);


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}


public function get_my_Profileinfo($current_user){

    $qstr=$this->db->get('tblusers');
    $qstr=$this->db->get_where('tblusers', array('userId'=> $current_user));
    //$query=$this->db->query($qstr);
    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}


public function updateMyProfileInfo($field, $id){
   
    $this->db->where('userId', $id);
    $this->db->update('tblusers', $field);
   // echo $this->db->last_query();

    if ($this->db->affected_rows() == 1) {
        return true;
    } else {
        return false;
    }
}


public function add_profilePic($id, $date_picuploaded, $file_name){
    $qstr = $this->db->query("SELECT * FROM profilepic where p_user_id = $id");
   
   
    if ($qstr->num_rows() > 0) {
        $data = [
           'p_user_id'=> $id,
           'p_name'=> $file_name,
       
           'p_dateuploaded'=> $date_picuploaded,
        
           ];
   
        return $this->db->update('profilepic', $data);
           
        $data['userpic']=[
               'user_picture_status'=>'1'
           ];
               
        return $this->db->update('tblusers', $data['userpic']);
        $this->session->set_flashdata('msgerror', 'Fields cannot be empty');
        exit;
    } else {
        $data = [
           'p_user_id'=> $id,
           'p_name'=> $file_name,
       
           'p_dateuploaded'=> $date_picuploaded,
        
           ];
   
        return $this->db->insert('profilepic', $data);
           
        $data['userpic']=[
               'user_picture_status'=>'1'
           ];
               
        return $this->db->insert('tblusers', $data['userpic']);
        $this->session->set_flashdata('msgerror', 'Fields cannot be empty');
        exit;
    }
}


public function profilePic_Status($id){
    $data=[
        'user_picture_status'=>'1'
    ];
        
    $this->db->where('userId', $id);
        return $this->db->update('tblusers', $data);

        $this->session->set_flashdata('msgerror','Fields cannot be empty');
        exit;
}


public function post_thread($title,$desciption,$date_created){
    $id=$this->session->userdata('id');
    $data = [
        'thread_user_id'=>$id,
        'thread_title'=> $title,
        'thread_content'=>$desciption,
        'thread_date'=>$date_created
        ];  
        print_r($data);
        return $this->db->insert('tblcommunity', $data);
}

public function get_this_community_post($community_post_id){

    $qstr=$this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.community_id='$community_post_id'");

    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}


public function get_this_community_comment($community_post_id){
    $qstr=$this->db->query('SELECT * FROM tblcommunitycomments JOIN tblcommunity on tblcommunitycomments.community_id=tblcommunity.community_id left JOIN tblusers on tblcommunitycomments.comment_user_id=tblusers.userId ');

    
    
    

    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}

public function get_myComment($comment_id){
    
    $qstr=$this->db->query("SELECT * from tblcommunitycomments where comment_id = $comment_id");


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result; 
}



public function updateMyComment($comment_id,$field){
    $this->db->where('comment_id', $comment_id);
    $this->db->update('tblcommunitycomments', $field);
   // echo $this->db->last_query();

    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}



public function add_community_comment($community_comment,$date_created,$community_post_id){


    $data = [
        'comment_content'=> $community_comment,
        'comment_date'=>$date_created,
        'comment_user_id'=>$this->session->userdata('id'),
        'community_id'=>$community_post_id,
  
        ];

        print_r($data);
    return $this->db->insert('tblcommunitycomments', $data);   
        
}



public function get_myCommunityThread($community_id){
    $qstr=$this->db->query("SELECT * from tblcommunity where community_id = $community_id");


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;  
}



public function updateMyThread($thread_id, $field){
    $this->db->where('community_id', $thread_id);
    $this->db->update('tblcommunity', $field);
   // echo $this->db->last_query();

    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

function getAllProfileInfo(){
    $userid=$this->session->userdata['id'];
    $this->db->select('*');
    $this->db->from('tblusers');
    $this->db->where('userId',$userid);
    $qstr=$this->db->get();
    //$query=$this->db->query($qstr);
    if ($qstr->num_rows() > 0) {
        $return_array= array();
        foreach ($qstr->result() as $val){
            $val->getAllProfilePost= $this->getAllProfilePost($val->userId);
            $val->getAllusersToFollow=$this->getAllusersToFollow();
            $val->getFollowtbl=$this->getFollowtbl($val->userId);
           
            // $val->getAllImages=$this->getAllImages($val->userId);
            $return_array[] = $val;
        }
         return $return_array;
    } else {
        $result=null;
    }
    return '';

}

 function getAllProfilePost($userid){
    
    $this->db->select('*');
    $this->db->from('profile_post');
    $this->db->where('user_id', $userid);
    $qstr=$this->db->get();  
    if ($qstr->num_rows()>0) {
        return $qstr->result();
    } else {
        return '';
    }
}


// function getAllImages($userid){
   
//     $this->db->select('*');
//     $this->db->from('tblimages');
//     $this->db->where('user_id', $userid);
//     $qstr=$this->db->get();  
//     if ($qstr->num_rows()>0) {
//         return $qstr->result();
//     } else {
//         return '';
//     }
// }

function get_post_id($userid){
   
    $this->db->select('*');
    $this->db->from('tblpost_id');
    $this->db->where('user_id', $userid);
    $qstr=$this->db->get();  
    if ($qstr->num_rows()>0) {
        return $qstr->result();
    } else {
        return '';
    }
}

function getAllusersToFollow(){
    $sessId=$this->session->userdata['id'];
    $this->db->select('*');
    $this->db->from('tblusers');
    $this->db->where('account_type!=','1');
    $this->db->where('userId!=',$sessId);
    $qstr=$this->db->get();  
    if ($qstr->num_rows()>0) {
        return $qstr->result();
    } else {
        return '';
    }
}

function getAllusers(){
   
    $this->db->select('*');
    $this->db->from('tblusers');
    // $this->db->where('account_type!=');
    $qstr=$this->db->get();  
    if ($qstr->num_rows()>0) {
        return $qstr->result();
    } else {
        return '';
    }
}


function getVisitProfileInfo($profile_id){
    $sessId=$this->session->userdata['id'];
    $this->db->select('*');
    $this->db->from('tblusers');
    $this->db->where('userId',$profile_id);
    $qstr=$this->db->get();
    //$query=$this->db->query($qstr);
    if ($qstr->num_rows() > 0) {
        $return_array= array();
        foreach ($qstr->result() as $val){
            $val->getAllProfilePost= $this->getAllProfilePost($profile_id);
            $val->getAllusersToFollow=$this->getAllusersToFollow();
            // $val->getAllImages=$this->getAllImages($val->userId);
            $return_array[] = $val;
        }
         return $return_array;
    } else {
        $result=null;
    }
    return '';

}

function followUser($userId){
    $sessId=$this->session->userdata['id'];
    $this->db->select('*');
    $this->db->from('tblfollow');
    $this->db->where('follower_id',$sessId);
    $this->db->where('following_id',$userId);
    $qstr=$this->db->get();
    // print_r($qstr);exit;
    if ($qstr->num_rows() >=1){
        // print_r("here");exit;
        echo "duplicate";
        exit;
    }else{
        $set=array('follower_id'=>$sessId,'following_id'=>$userId,'subscribe'=>'1');
        return $this->db->insert('tblfollow', $set); 
    }
            
}

function getFollowtbl($sessId){
    
    $this->db->select('*');
    $this->db->from('tblfollow');
    $this->db->where('follower_id',$sessId);
    $qstr= $this->db->get();

    return $qstr->result();
}

}