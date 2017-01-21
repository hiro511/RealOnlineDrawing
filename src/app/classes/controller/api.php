<?php
class Controller_Api extends Controller_Rest
{   
	private function convert_orm_to_ary($orm_objs){
		$ary = array();
		foreach ($orm_objs as $obj) {
        	array_push($ary, $obj->to_array());
      	}
      	return $ary;
	}
	
	private function get_error_response($id){
	    return array(
			'error' => array(
				'code' => $id,
			),
	    );
    }
	
    public function post_draw()
    {
	    $start_x_param = Input::post('start_x');
	    $start_y_param = Input::post('start_y');
	    $end_x_param = Input::post('end_x');
	    $end_y_param = Input::post('end_y');
	    $color_param = Input::post('color');
	    $alpha_param = Input::post('alpha');
	    $diameter_param = Input::post('diameter');
	    $room_id_param = Input::post('room_id');
	    $status_id_param = Input::post('status_id');
	    $session_id_param = Input::post('session_id');
	    
	    if (!isset($room_id_param) || !isset($status_id_param)){
		    return $this->response($this->get_error_response(1));
	    }

	    $canvas = new Model_Canvas();
	    $canvas->start_x = $start_x_param;
	    $canvas->start_y = $start_y_param;
	    $canvas->end_x = $end_x_param;
	    $canvas->end_y = $end_y_param;
	    $canvas->color = $color_param;
	    $canvas->alpha = $alpha_param;
	    $canvas->diameter = $diameter_param;
	    $canvas->room_id = $room_id_param;
	    $canvas->status_id = $status_id_param;
	    $canvas->session_id = $session_id_param;
	    $canvas->save();
	    
	    return $this->response($canvas->to_array());
    }
    
    public function get_draw()
    {
	    $id_param = Input::get('id');
	    $min_param = Input::get('min');
	    $session_id_param = Input::get('session_id');
	    
	    $canvases = Model_Canvas::find('all', array(
		    'where' => array(
				array('room_id', $id_param),
				array('id', '>', $min_param),
				array('session_id', '!=', $session_id_param),
				array('is_deleted', 0),
			),
	    ));
	    
	    if (empty($canvases)) {
		    return $this->response($this->get_error_response(1));
	    }
	    
	    return $this->response($this->convert_orm_to_ary($canvases));
    }
}
