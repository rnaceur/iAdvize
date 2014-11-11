<?php
header('Content-type: text/html; charset=UTF-8'); 

class Post extends AppModel {
	public $validate = array(
        'author' => array(
            'rule' => 'notEmpty'
        ),
        'content' => array(
            'rule' => 'notEmpty'
        ),		
		'date' => array (
			'rule'    => array('datetime', 'ymd'),
            'allowEmpty' => true
			)
		);
	
	public function insert() {
		$sql = "INSERT INTO `posts`(`author`, `content`, `date`) VALUES ";
		$cptpage = 1;
		$cptpost = 0;
		
		while($cptpost<200) {
			$html = file_get_html('http://www.viedemerde.fr/?page' . $cptpage);
			$res = $html->find('div[class=post article]'); 
			
			foreach($res as $element) {
				if($cptpost<200) {
					//Recuperation du contenu (la phrase)
					$content = $element->firstchild()->plaintext;
					
					//Recuperation de la date
					$right_div = $element->find('div[class=right_part]',0);
					$paragraphe = $right_div->children[1];
					$datepart = substr($paragraphe->plaintext,2,20);
					$newdate = str_replace('à','',$datepart) . ':00';
					$newdate = str_replace('/','-',$newdate);
					$date = date("Y-m-d H:i:s", strtotime($newdate));
						
					//Recuperation de l'auteur
					$authorsexe = substr($paragraphe->plaintext,strpos($paragraphe->plaintext, "par") + 3); //isoler la premiere partie : nom auteur + sexe 
					$author = substr($authorsexe,1,strpos($authorsexe, "(")-1);
					
					$row = " (\"" . $author . "\",\"" . $content . "\",date('" . $date . "')) ";
					$sql = $sql . $row . ",";
					$cptpost++;
				}
			}
			$cptpage++;
		}
		$sql = substr($sql,0,-1);
		$this->query($sql);
	}
	
	public function suppr() {
		$this->query("DELETE FROM posts");
		$this->query("ALTER TABLE `posts` AUTO_INCREMENT=1");
	}
}
?>