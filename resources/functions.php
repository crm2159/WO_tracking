<?php
//searches a table of choice. \
//params is assoc_array [column:like, column:like]
function search_table($table, $return_columns, $params){
	//setup query
	$query = 'SELECT `' . implode("`, `", $return_columns) . '` from `' . $table . '` WHERE 1';
	//add where clauses
	foreach($params as $k=>$v){
		//run a regex to make sure the sn is not contained within another sn
		if($k == 'sn' && $v !=""){
			$query .= ' AND `' . $k . '` = ' . $v;
		} else{
			if(is_array($v)){
				$query .= ' AND (`' . $k . '` LIKE "%'. implode('%" OR `' . $k . '` LIKE "%', $v) . '%")';
			} else {
				$query .= ' AND `' . $k . '` LIKE "%' . $v . '%"';
			}
		}
		
	}
	global $dbh;
	//echo $query;
	$query = $dbh->prepare($query);
	$query->execute();
	return $query->fetchall();
}


function get_column_list($table){
	global $dbh;
	$stmt = 'SHOW COLUMNS FROM `' . $table . '`';
	$stmt = $dbh->prepare($stmt);
	$stmt->execute();
	return $stmt->fetchall();
}

function search_rirs($params){
	global $dbh;
	/*
	possible available search params are: 
	seach_term 		[string]
	start_date 		[date-string]
	end_date		[date_string]
	assoc_product	[array]
	market			[array]
	*/
	$query = 'SELECT * FROM `rirs_view` WHERE 1';
	
	if(isset($params['search_term']) && !empty($params['search_term'])){
		$query .= ' AND `description` LIKE "%' . $params['search_term'] . '%"';
	}
	if(isset($params['start_date'])  && !empty($params['start_date'])){
		$query .= ' AND `date` >= "' .  $params['start_date'] . '"';
	}
	if(isset($params['end_date'])  && !empty($params['end_date'])){
		$query .= ' AND `date` <= "' .  $params['end_date'] . '"';
	}
	if(isset($params['assoc_item'])  && !empty($params['assoc_item'])){
		foreach($params['assoc_item'] as $product){
			$query .= ' AND `assoc_products` LIKE "%' .  $product . '%"';
		}
	}
	if(isset($params['market'])  && !empty($params['market'])){
		foreach($params['market'] as $market){
			$query .= ' AND `market` LIKE "%' .  $market . '%"';
		}
	}
	return $query;
	
}

//#unfinished
function get_new_rir_num(){
	global $dbh;
	$stmt = "INSERT INTO `rirs` (`description`, `user`) VALUES ('reserved by user_id: " . $_SESSION['user_id'] . "', '" . $_SESSION['user_id']. "')";
	$stmt = $dbh->prepare($stmt);
	$stmt->execute();
	return $dbh->lastInsertId();
}

function new_doc_num($doc_type){
	global $dbh;
	/* update query
	$stmt = ("INSERT INTO $doc_type$column FROM $table WHERE $where");
	$stmt = $dbh->prepare($stmt);
	$stmt->execute();
	return $stmt->fetchall();
	*/
	return '12345'; 
}

function get_list_from_db($table, $column, $where='0'){
	global $dbh;
	$where == "" ? $where = '1' : $where=$where;
	$stmt = ("SELECT $column FROM $table WHERE $where");
	$stmt = $dbh->prepare($stmt);
	$stmt->execute();
	return $stmt->fetchall();
}

function read_qr(){
	echo '<image src="resources/php-qrs/qrcodes/qr-code1.jpg">';
	include_once ('resources/php-qrs/lib/QrReader.php');
	$qr = new QrReader('resources/php-qrs/qrcodes/qr-code1.jpg');
	$text = $qr->text(); //return decoded text from QR Code
	return $text;
}


function insert_in_table($table, $assoc_array){
	global $dbh;
	$columns = implode(', ', array_keys($assoc_array));
	foreach($assoc_array as $k=> $v){
		$assoc_array[':'.$k] = $v;
		unset($assoc_array[$k]);		
	}
	$val_placeholders = implode(', ',array_keys($assoc_array));
	$stmt = $dbh->prepare("INSERT INTO `$table` ($columns) VALUES ($val_placeholders)");
	foreach($assoc_array as $k=>$v){
		$stmt->bindValue($k,$v);
		
	}
	$stmt->execute();
	return $dbh->lastInsertId();
}

function add_attr_if_exists($key, $assoc_array){
	$html = '';
	if (array_key_exists($key, $assoc_array)){
		$html .= " " . $key . '="' . $assoc_array[$key] . '"';
	}
	return $html;
}

function create_input($input){
	$html ='';
	if(array_key_exists('div_wrapper', $input)) {
			$html .="<div";
			if(array_key_exists('div_id', $input)){
				$html .=' id="' . $input['div_id'] . '"';
			}
			if(array_key_exists('div_class', $input)){
				$html .=' class="' . $input['div_class'] . '"';
			}
			$html .=">";
		}
	foreach($input as $key=>$value){
		
		switch ($key){
			case 'label':
				$html .= '<label for="' . $input['name']. '"';
				if(array_key_exists("label_class", $input)){
						$html .= ' class="' . $input['label_class'] . '"';
				}
				$html .='>' . $input['label'] . '</label>';
				break;
			case 'type':
				if($value == 'text' || $value == 'number' || $value == 'checkbox' || $value == 'date' || $value == 'time' || $value== 'password'){
					$html .= '<input type="' . $input['type'] . '" name="' . $input['name'] .'"';
					
					$html .= add_attr_if_exists('class', $input);
					$html .= add_attr_if_exists('min', $input);
					$html .= add_attr_if_exists('max', $input);
					$html .= add_attr_if_exists('inputValue', $input);
					$html .= add_attr_if_exists('id', $input);
					$html .= add_attr_if_exists('readonly', $input);
					$html .= add_attr_if_exists('placeholder', $input);
					$html .= add_attr_if_exists('value', $input);
				}
				if($input['type'] == 'textarea'){
					$html .= '<textarea name="' . $input['name'] . '"></textarea'; 
				}
				
				if($input['type'] == 'select'){
					$html .= '<select name="' . $input['name'] . '">';
					$html .= '<option value disabled selected></option>';
					foreach($input['select'] as $sel_text=>$sel_value){
						$html .= '<option value="' . $sel_value . '">' . $sel_text . '</option>';
					}
					$html .='</select';
				}
				$html .= add_attr_if_exists('onchange', $input);
				$html .= ">";
				//add help button content if help-tip-content key exists
				if (array_key_exists('help_tip_content', $input)) {
						$html .= '<button class = "toggle-help-tip" type="button">?</button>';	//add button
						$html .= '<div class="help-tip">' . $input['help_tip_content'] . '</div>';
				}
				break;
			case '':
			//do something to handle other input types here
				break;
 		}
		
	}
	if(array_key_exists('div_wrapper', $input)) {
			$html .="</div>";
		}
	return $html;
}
?>
