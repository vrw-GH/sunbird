<?php
#[\AllowDynamicProperties]
abstract class modelCfs extends baseObjectCfs {
    protected $_data = array();
	protected $_code = '';

	protected $_orderBy = '';
	protected $_sortOrder = '';
	protected $_groupBy = '';
	protected $_limit = '';
	protected $_where = array();
	protected $_stringWhere = '';
	protected $_selectFields = '*';
	protected $_tbl = '';
	protected $_lastGetCount = 0;
	protected $_idField = 'id';

    /*public function init() {

    }
    public function get($d = array()) {

    }
    public function put($d = array()) {

    }
    public function post($d = array()) {

    }
    public function delete($d = array()) {

    }
    public function store($d = array()) {

    }*/
	public function setCode($code) {
        $this->_code = $code;
    }
    public function getCode() {
        return $this->_code;
    }
	public function getModule() {
		return frameCfs::_()->getModule( $this->_code );
	}

	protected function _setTbl($tbl) {
		$this->_tbl = $tbl;
	}
	public function setOrderBy($orderBy) {
		$this->_orderBy = $orderBy;
		return $this;
	}
	/**
	 * ASC, DESC
	 */
	public function setSortOrder($sortOrder) {
		$this->_sortOrder = $sortOrder;
		return $this;
	}
	public function setLimit($limit) {
		$this->_limit = $limit;
		return $this;
	}
	public function setWhere($where) {
		$this->_where = $where;
		return $this;
	}
	public function addWhere($where) {
		if(empty($this->_where) && !is_string($where)) {
			$this->setWhere( $where );
		} elseif(is_array($this->_where) && is_array($where)) {
			$this->_where = array_merge($this->_where, $where);
		} elseif(is_string($where)) {
			if(!isset($this->_where['additionalCondition']))
				$this->_where['additionalCondition'] = '';
			if(!empty($this->_where['additionalCondition']))
				$this->_where['additionalCondition'] .= ' AND ';
			$this->_where['additionalCondition'] .= $where;
			//$this->_stringWhere .= $where;	// Unused for now
		}
		return $this;
	}
	public function setSelectFields($selectFields) {
		if(is_array($selectFields))
			$selectFields = implode(',', $selectFields);
		$this->_selectFields = $selectFields;
		return $this;
	}
	public function groupBy($groupBy) {
		$this->_groupBy = $groupBy;
		return $this;
	}
	public function getLastGetCount() {
		return $this->_lastGetCount;
	}
	public function getFromTbl($params = array()) {
		$this->_lastGetCount = 0;
		$tbl = isset($params['tbl']) ? $params['tbl'] : $this->_tbl;
		$table = frameCfs::_()->getTable( $tbl );
		$this->_buildQuery( $table );
		$return = isset($params['return']) ? $params['return'] : 'all';
		$data = $table->get($this->_selectFields, $this->_where, '', $return);
		if(!empty($data)) {
			switch($return) {
				case 'one':
					$this->_lastGetCount = 1;
					break;
				case 'row':
					$data = $this->_afterGetFromTbl( $data );
					$this->_lastGetCount = 1;
					break;
				default:
					foreach($data as $i => $row) {
						$data[ $i ] = $this->_afterGetFromTbl( $row );
					}
					$this->_lastGetCount = count( $data );
					break;
			}
		}
		$this->_clearQuery( $params );
		return $data;
	}
	protected function _clearQuery($params = array()) {
		$clear = isset($params['clear']) ? $params['clear'] : array();
		if(!is_array($clear))
			$clear = array($clear);
		if(empty($clear) || in_array('limit', $clear))
			$this->_limit = '';
		if(empty($clear) || in_array('orderBy', $clear))
			$this->_orderBy = '';
		if(empty($clear) || in_array('sortOrder', $clear))
			$this->_sortOrder = '';
		if(empty($clear) || in_array('where', $clear))
			$this->_where = '';
		if(empty($clear) || in_array('selectFields', $clear))
			$this->_selectFields = '*';
		if(empty($clear) || in_array('groupBy', $clear))
			$this->_groupBy = '';
	}
	public function getCount($params = array()) {
		$tbl = isset($params['tbl']) ? $params['tbl'] : $this->_tbl;
		$table = frameCfs::_()->getTable( $tbl );
		$this->setSelectFields('COUNT(*) AS total');
		$this->_buildQuery( $table );
		$data = (int) $table->get($this->_selectFields, $this->_where, '', 'one');
		$this->_clearQuery($params);
		return $data;
	}
	protected function _afterGetFromTbl( $row ) {	// You can re-define this method in your own model
		return $row;
	}
	protected function _buildQuery($table = null) {
		if(!$table)
			$table = frameCfs::_()->getTable( $this->_tbl );
		if(!empty($this->_orderBy)) {
			$order = $this->_orderBy;
			if(!empty($this->_sortOrder))
				$order .= ' '. strtoupper($this->_sortOrder);
			$table->orderBy( $order );
		}
		if(!empty($this->_groupBy)) {
			$table->groupBy( $this->_groupBy );
		}
		if(!empty($this->_limit)) {
			$table->setLimit( $this->_limit );
		}
	}
	public function removeGroup($ids) {
		if(!is_array($ids))
			$ids = array($ids);
		// Remove all empty values
		$ids = array_filter(array_map('intval', $ids));
		if(!empty($ids)) {
      if ($this->supRemoveGroup($ids)) {
			//if(frameCfs::_()->getTable( $this->_tbl )->delete(array('additionalCondition' => 'id IN ('. implode(',', $ids). ')'))) {
				return true;
			} else
				$this->pushError (__('Database error detected', CFS_LANG_CODE));
		} else
			$this->pushError(__('Invalid ID', CFS_LANG_CODE));
		return false;
	}
	public function clear() {
		return $this->delete();	// Just delete all
	}
	public function delete($params = array()) {
		if($this->supDelete($params)) {
			return true;
		} else
			$this->pushError (__('Database error detected', CFS_LANG_CODE));
		return false;
	}
	// public function getById($id, $customTable = '') {
	// 	$data = $this->setWhere(array($this->_idField => $id))->getFromTbl();
	// 	return empty($data) ? false : array_shift($data);
	// }
  public function supGetById($id, $customTable = '') {
    global $wpdb;
    $tableName = $wpdb->prefix . "cfs_" . $this->_tbl;
  	return $res = $wpdb->get_results(
  		$wpdb->prepare("SELECT {$this->_idField} FROM %1s WHERE id = %s", $tableName, $id), ARRAY_A  // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
  	);
  }
  public function supDelete($params, $customTable = '') {
    global $wpdb;
    $tableName = $wpdb->prefix . "cfs_" . $this->_tbl;
    if (!empty($customTable)) {
      $tableName = $wpdb->prefix . "cfs_" . $customTable;
    }
    $data_where = $params;
    $res = $wpdb->delete( $tableName, $data_where );
    if ($res) {
      return true;
    }
    return false;
  }
  public function supRemoveGroup($ids, $customTable = '') {
    global $wpdb;
    $tableName = $wpdb->prefix . "cfs_" . $this->_tbl;
    if (!empty($customTable)) {
      $tableName = $wpdb->prefix . "cfs_" . $customTable;
    }
    if (!empty($ids)) {
      foreach ($ids as $id) {
        $data_where = array($this->_idField => $id);
        $res = $wpdb->delete( $tableName, $data_where );
      }
    }
    if ($res) {
      return true;
    }
    return false;
  }
  public function supInsert($data, $customTable = '') {
    global $wpdb;
    $table = !empty($customTable) ? $customTable : $this->_tbl;
    switch ($table) {
      case 'contacts':
        $table = $wpdb->prefix.'cfs_contacts';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_contacts", 0);
      break;
      case 'countries':
        $table = $wpdb->prefix.'cfs_countries';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_countries", 0);
      break;
      case 'files':
        $table = $wpdb->prefix.'cfs_files';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_files", 0);
      break;
      case 'forms':
        $table = $wpdb->prefix.'cfs_forms';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_forms", 0);
      break;
      case 'forms_rating':
        $table = $wpdb->prefix.'cfs_forms_rating';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_forms_rating", 0);
      break;
      case 'membership_presets':
        $table = $wpdb->prefix.'cfs_membership_presets';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_membership_presets", 0);
      break;
      case 'modules':
        $table = $wpdb->prefix.'cfs_modules';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_modules", 0);
      break;
      case 'statistics':
        $table = $wpdb->prefix.'cfs_statistics';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_statistics", 0);
      break;
      case 'modules_type':
        $table = $wpdb->prefix.'cfs_modules_type';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_modules_type", 0);
      break;
      case 'subscribers':
        $table = $wpdb->prefix.'cfs_subscribers';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_subscribers", 0);
      break;
      case 'usage_stat':
        $table = $wpdb->prefix.'cfs_usage_stat';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_usage_stat", 0);
      break;
    }
    $data = array_intersect_key($data, array_flip($tableCols));
    unset($data['filter']);
    $res = $wpdb->insert($table, $data);
    if ($res) {
			return $wpdb->insert_id;;
		}
    return false;
  }
  public function supUpdateById($data, $id = 0) {
    global $wpdb;
    if(!$id) {
			$id = isset($data[ $this->_idField ]) ? (int) $data[ $this->_idField ] : 0;
		}
		if($id) {
      $data = $this->_dataSave($data, true);
      $table = !empty($customTable) ? $customTable : $this->_tbl;
      switch ($table) {
        case 'contacts':
          $table = $wpdb->prefix.'cfs_contacts';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_contacts", 0);
        break;
        case 'countries':
          $table = $wpdb->prefix.'cfs_countries';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_countries", 0);
        break;
        case 'files':
          $table = $wpdb->prefix.'cfs_files';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_files", 0);
        break;
        case 'forms':
          $table = $wpdb->prefix.'cfs_forms';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_forms", 0);
        break;
        case 'forms_rating':
          $table = $wpdb->prefix.'cfs_forms_rating';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_forms_rating", 0);
        break;
        case 'membership_presets':
          $table = $wpdb->prefix.'cfs_membership_presets';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_membership_presets", 0);
        break;
        case 'modules':
          $table = $wpdb->prefix.'cfs_modules';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_modules", 0);
        break;
        case 'statistics':
          $table = $wpdb->prefix.'cfs_statistics';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_statistics", 0);
        break;
        case 'modules_type':
          $table = $wpdb->prefix.'cfs_modules_type';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_modules_type", 0);
        break;
        case 'subscribers':
          $table = $wpdb->prefix.'cfs_subscribers';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_subscribers", 0);
        break;
        case 'usage_stat':
          $table = $wpdb->prefix.'cfs_usage_stat';
          $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_usage_stat", 0);
        break;
      }
      if (!is_array($data)) {
        $data = array($data);
      }
      $data = array_intersect_key($data, array_flip($tableCols));
  		$data_update = $data;
  		$data_where = array($this->_idField => $id);
  		return $res = $wpdb->update($table , $data_update, $data_where);
		} else
			$this->pushError(__('Empty or invalid ID', CFS_LANG_CODE));
		return false;
  }
  public function supUpdate($data, $where, $customTable = '') {
    global $wpdb;
    if(is_numeric($where)) {
      $where = array($this->_idField => $where);
    }
    $table = !empty($customTable) ? $customTable : $this->_tbl;
    switch ($table) {
      case 'contacts':
        $table = $wpdb->prefix.'cfs_contacts';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_contacts", 0);
      break;
      case 'countries':
        $table = $wpdb->prefix.'cfs_countries';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_countries", 0);
      break;
      case 'files':
        $table = $wpdb->prefix.'cfs_files';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_files", 0);
      break;
      case 'forms':
        $table = $wpdb->prefix.'cfs_forms';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_forms", 0);
      break;
      case 'forms_rating':
        $table = $wpdb->prefix.'cfs_forms_rating';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_forms_rating", 0);
      break;
      case 'membership_presets':
        $table = $wpdb->prefix.'cfs_membership_presets';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_membership_presets", 0);
      break;
      case 'modules':
        $table = $wpdb->prefix.'cfs_modules';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_modules", 0);
      break;
      case 'statistics':
        $table = $wpdb->prefix.'cfs_statistics';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_statistics", 0);
      break;
      case 'modules_type':
        $table = $wpdb->prefix.'cfs_modules_type';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_modules_type", 0);
      break;
      case 'subscribers':
        $table = $wpdb->prefix.'cfs_subscribers';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_subscribers", 0);
      break;
      case 'usage_stat':
        $table = $wpdb->prefix.'cfs_usage_stat';
        $tableCols = $wpdb->get_col("DESC {$wpdb->prefix}cfs_usage_stat", 0);
      break;
    }
    if (!is_array($data)) {
      $data = array($data);
    }
    $data = array_intersect_key($data, array_flip($tableCols));
  	$data_update = $data;
  	$data_where = $where;
  	$res = $wpdb->update($table, $data_update, $data_where);
    if ($res) {
      return $where;
    }
    return false;
  }
	public function insert($data) {
		$data = $this->_dataSave($data, false);
		//$id = frameCfs::_()->getTable( $this->_tbl )->insert( $data );
    $id = $this->supInsert($data);
		if($id) {
			return $id;
		}
		$this->pushError(frameCfs::_()->getTable( $this->_tbl )->getErrors());
		return false;
	}
	public function updateById($data, $id = 0) {
		if(!$id) {
			$id = isset($data[ $this->_idField ]) ? (int) $data[ $this->_idField ] : 0;
		}
		if($id) {
      return $this->supUpdateById($data, $id);
			//return $this->update($data, array($this->_idField => $id));
		} else
			$this->pushError(__('Empty or invalid ID', CFS_LANG_CODE));
		return false;
	}
	public function update($data, $where) {
		$data = $this->_dataSave($data, true);
    if ($this->supUpdate($data, $where)) {
		//if(frameCfs::_()->getTable( $this->_tbl )->update( $data, $where )) {
			return true;
		}
		$this->pushError(frameCfs::_()->getTable( $this->_tbl )->getErrors());
		return false;
	}
	protected function _dataSave($data, $update = false) {
		return $data;
	}
	public function getTbl() {
		return $this->_tbl;
	}
	/**
	 * We can re-define this method to not retrive all data - for simple tables
	 */
	public function setSimpleGetFields() {
		return $this;
	}
}
