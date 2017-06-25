<?php 
function calculate_score ($db, $id){
	try{
		$stmt = $db->prepare('SELECT accepted, completed, value FROM challenge WHERE id_player = :id_player AND flag = :flag');
		$stmt->execute(array(':id_player' => $id,
							 ':flag' => CHALLENGE_CONFIRMED));
		$score = 0;
		
		while($row = $stmt->fetch()){
			$score += (CHALLENGE_CREATION_PRICE + $row['value']);
		}
		return $score;
	}
	catch (Exception $e){
		$e->getMessage();
	}
}

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}

function get_ladder($db){
	$stmt = $db->prepare('SELECT id, username, promo FROM member WHERE type = :type');
	$stmt->execute(array(':type' => USER_PLAYER));$ladder = array();
	
	while($row = $stmt->fetch()){
			$ladder[] = array("usr" => $row['username'],"promo" => $row['promo'],"score" => calculate_score($db, $row['id']));
	}
	array_sort_by_column($ladder, "score", SORT_DESC);
	return($ladder);	
}

function get_votes($db, $id){
	try {
		$stmt = $db->prepare('SELECT count(*) FROM challenge_votes WHERE id_challenge = :id');
		$stmt->execute(array(	':id' => $id));
		$row = $stmt->fetch();
		return $row['count(*)'];
	}
	catch (Exception $e) {
		echo $e->getMessage();
	}
}

function get_membercount($db){
	try{
		$stmt = $db->prepare('SELECT count(*) FROM member');
		$stmt->execute();
		$row = $stmt->fetch();

		return $row['count(*)'];
	}
	catch (Exeception $e) {
		echo $e->getMessage();
	}

}

function get_tokencount($db,$id){
	try{
		$stmt = $db->prepare('SELECT token FROM member WHERE id = :id');
		$stmt->execute(array(':id' => $id));
		$row = $stmt->fetch();
		return $row['token'];
	}
	catch (Exeception $e) {
		echo $e->getMessage();
	}
}
?>