<?php
class Admin_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	public function get_holistic_model_details($id ="")
	{
		$this->db->select('
		    s.id AS section_id,
		    s.title AS section_title,
		    s.description,
		    st.id AS strategy_id,
		    st.section_type,
		    st.pillar,
		    st.items,
		    l.id AS lever_id,
		    l.title AS lever_title
		');
		$this->db->from('tbl_holistic_model_sections s');
		$this->db->join('tbl_holistic_model_strategies st', '1=1', 'left'); // No direct FK, loose join
		$this->db->join('tbl_holistic_model_levers l', '1=1', 'left');        // Join to show all levers
		$this->db->where('s.id', $id);
		$this->db->where('s.is_delete', 1);
		$this->db->where('st.is_delete', 1);
		$this->db->where('l.is_delete', 1);
		$query = $this->db->get();
		$result = $query->result_array();

	}

	public function get_case_study_solution_details($id="")
	{
	    $this->db->select('s.*, h.main_title, h.main_description');
	    $this->db->from('tbl_case_study_solutions s');
	    $this->db->join('tbl_case_study_solution_header h', 's.fk_header_id = h.id', 'left');
	    $this->db->where('s.id',$id);
	    $query = $this->db->get();
	    $result = $query->row_array();	   
	    return $result;
	}

}
	