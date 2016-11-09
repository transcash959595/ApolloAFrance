<?php

class CreatetableModel extends CI_Model {

public function getAccountDetails($username,$password)
{

			 
			 
			 
			 
$this->db->select('userprofile.cardnumberdetails, 
	userprofile.status,
	userprofile.pan,
	userprofile.firstname,
	userprofile.lastname,
	userprofile.address1,
	userprofile.address2,
	userprofile.city,
	userprofile.state,
	userprofile.zip,
	userprofile.country,   
    userprofile.dob,
	userprofile.accountactivation,
	userprofile.phone,
	userprofile.email ');
$this->db->from('userprofile');

$this->db->where('userprofile.username',$username);
$this->db->where('userprofile.password',$password);
$queryCardDetails = $this->db->get();
			   
$result = $queryCardDetails->result();			   
return $queryCardDetails->result();
//echo "<pre>";
//print_r($result);



}


public function createNoOfAccount()
{

$this->load->dbforge();
$fields1 = array(
                        'accountname' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100',
                                                 'unsigned' => TRUE,
                                                 'auto_increment' => TRUE
                                          ),
                        'dateofcreation' => array(
                                                 'type' => 'DATE',
                                                 
                                          ),
                        'createdby' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20',
                                                 
												 
												 
                                          ),
                        'type' => array(
                                                 'type' => 'VARCHAR',
                                                 
												 'constraint' =>'20',
                                          ), 
										  
										  
										  
										  
					  
                );



	
	
	$this->dbforge->add_field($fields1);
    
    $this->dbforge->create_table('noofaccounts', TRUE); 
	
	

}


public function alterTable($newtablearray)
{
$this->load->database();
$sql_alter_table_primary_key = "ALTER TABLE ".$newtablearray." ADD CONSTRAINT pk_Date_Description_Req_code_debit_credit".$newtablearray." PRIMARY KEY (Date,Description,Req_code,debit,credit) "; 
echo $sql_alter_table_primay_key;
$this->db->query($sql_alter_table_primary_key);
}

public function createtable($account)

{
  $this->load->helper('date');
 
 $date = date('Y-m-d H:i:s'); 
 $data = array(
   'accountname' => $account ,
   'dateofcreation' => $date ,
   'createdby' => 'admin',
   'type' => 'reconciliation'
);

$this->db->insert('noofaccounts', $data); 

$this->load->dbforge();

$table_list_array = array($account,$account.'notreconciled',$account.'notreconciledstore',
$account.'notreconciled_temp',$account.'_check_change',$account.'_reconcile',$account.'_reconcile_temp',$account.'_tempundo',$account.'_temp');

foreach($table_list_array as $tablearray)
{


$fields = array(
                        'Date' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '20',
                                                 'unsigned' => TRUE,
                                                 'auto_increment' => TRUE
                                          ),
                        'Description' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '140',
                                          ),
                        'Req_code' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '20',
                                                 
												 
												 
                                          ),
                        'debit' => array(
                                                 'type' => 'VARCHAR',
                                                 
												 'constraint' =>'20',
                                          ), 
										  
										  
										  
										  
					  'credit' => array(
							 'type' => 'VARCHAR',
							 
							 'constraint' =>'20',
					  ),
                );



	$this->dbforge->add_field($fields);
	
	if($tablearray== $account.'notreconciled' || $tablearray == $account.'notreconciledstore')
	{
	
    $this->dbforge->add_key('Date', TRUE);
	$this->dbforge->add_key('Description', TRUE);
	$this->dbforge->add_key('Req_code', TRUE);
	$this->dbforge->add_key('debit', TRUE);
	$this->dbforge->add_key('credit', TRUE);
    $this->dbforge->create_table($tablearray, TRUE); 
	
	
	
    }
	
	else 
	{
	$this->dbforge->create_table($tablearray, TRUE);
	}

 	
		}	




		
				
			
				}


}