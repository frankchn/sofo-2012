<?php

class Photostream implements Iterator {
	
	private $uids;
	private $uid_string;
	private $current_index = null;
	
	public function __construct($uids = array()) {
		global $user;
		
		if(count($uids) == 0) {
			$this->uids[] = $user->id;
		} else {
			$this->uids = $uids;
		}
		
		$this->uid_string = implode(',', $this->uids);
		$this->rewind();
	}
	
	public function current() {
		if(!is_null($this->current_index))
			return new Photo($this->current_index);
		else
			return null;
	}
	
	public function key() {
		return $this->current_index;
	}

	public function prev() {
		$g = mysql_fetch_assoc(mysql_query('SELECT `id` FROM `photos` WHERE `id` > '.$this->current_index.' AND `user_id` IN ('.$this->uid_string.') ORDER BY `id` ASC LIMIT 0,1'));
		if(is_array($g)) {
			$this->current_index = $g['id'];
		} else {
			$this->current_index = null;
		}
	}
	
	public function next() {
		$g = mysql_fetch_assoc(mysql_query('SELECT `id` FROM `photos` WHERE `id` < '.$this->current_index.' AND `user_id` IN ('.$this->uid_string.') ORDER BY `id` DESC LIMIT 0,1'));
		if(is_array($g)) {
			$this->current_index = $g['id'];
		} else {
			$this->current_index = null;
		}
	}
	
	public function rewind() {
		$g = mysql_fetch_assoc(mysql_query('SELECT `id` FROM `photos` WHERE `user_id` IN ('.$this->uid_string.') ORDER BY `id` DESC LIMIT 0,1'));
		if(is_array($g)) {
			$this->current_index = $g['id'];
		} else {
			$this->current_index = null;
		}
	}
	
	public function valid() {
		return !is_null($this->current_index);
	}
	
}
