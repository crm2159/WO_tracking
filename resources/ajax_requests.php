<?php
include 'init.php';

protect(0, true, false); //protect the site for access logged in members, all access, die on failure, no timeout\

if(isset($_POST['action'])){
	switch ($_POST['action']){
		case 'search_table':
			unset($_POST['action']);
			$table = $_POST['table'];
			unset($_POST['table']);
			$return_columns = $_POST['columns'];
			unset($_POST['columns']);
			$params = $_POST;
			echo json_encode(search_table($table, $return_columns, $params));
			break;
			
		case 'site_name':
			header('Content-Type: application/json');
			echo json_encode(get_list_from_db('sites', 'site_name', '`site_name` LIKE("%' . $_POST['value'] . '%")'));
			break;
	
		case 'ac_assignee':
			echo json_encode(get_list_from_db('rir_assignees', 'firstname', '`firstname` LIKE("%' . $_POST['value'] . '%")'));
		
		case 'add_site':
			//do something to only allow admins to call this function
			//do some sql to add a site
			global $dbh;
			echo '';
			break;
		
		case 'new_rir_num':
			echo json_encode(get_new_rir_num());
			break;
		
		case 'new_list_item':
			//do some sql i.e. add_item_to_list($table, $values)
			$data = $_POST;
			$table = $_POST['table'];
			unset($data['action'],$data['table']);
			echo json_encode(insert_in_table($table, $data)); 
			break;
		
		case 'doc_type_list':
			echo json_encode(get_list_from_db('doc_types, type'));
			break;
		
		case 'doc_search':
			//echo json_encode(get_list_from_db('design_docs', '*', '`doc_title` LIKE("%"'  . $_POST['value'] . '%")');
			echo json_encode('I am a test search result');
			break;
		
		case 'new_doc_num':
			//query different tables based on document type
			echo json_encode(new_doc_num($_POST['doc_type'])); 
			break;
		
		case 'get_list_from_db':
			echo json_encode(get_list_from_db($_POST[$table], $_POST[$column]));
			break;
		case 'search_rirs':
			unset($_POST['action']);
			unset($_POST['table']);
			echo json_encode(search_rirs($_POST));
			break;
		
		//just for testing
		case 'test':
			echo json_encode($_POST);
			break;
	}
}