<?php

class Photostream implements Iterator {
	
	private $uids;
	private $uid_string;
	private $current_index = null;
	
	public function __construct($uids = array()) {
		global $user;
		
		if(count($uids) == 0) {
			$this->uids[] = $user->id;
		} else if(is_array($uids)) {
			$this->uids = $uids;
		} else {
			$this->uids = array($uids);
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
	
	public function setIndex($id) {
		$this->current_index = $id;
	}
	
	public function getPrev() {
		$g = mysql_fetch_assoc(mysql_query('SELECT `id` FROM `photos` WHERE `id` > '.$this->current_index.' AND `user_id` IN ('.$this->uid_string.') ORDER BY `id` ASC LIMIT 0,1'));
		if(is_array($g)) {
			return new Photo($g['id']);
		} else {
			return null;
		}
	}
	
	public function getNext() {
		$g = mysql_fetch_assoc(mysql_query('SELECT `id` FROM `photos` WHERE `id` < '.$this->current_index.' AND `user_id` IN ('.$this->uid_string.') ORDER BY `id` DESC LIMIT 0,1'));
		if(is_array($g)) {
			return new Photo($g['id']);
		} else {
			return null;
		}
	}

	public function prev() {
		$object = $this->getPrev();
		$this->current_index = is_object($object) ? $object->id : null;
	}
	
	public function next() {
		$object = $this->getNext();
		$this->current_index = is_object($object) ? $object->id : null;
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
