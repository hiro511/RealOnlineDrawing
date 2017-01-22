<?php

class Controller_Rooms extends Controller
{
	public function action_index()
	{
		$id_query = Input::get('id');
		if (isset($id_query)) {
			$room = Model_Room::find($id_query);
			$data['room'] = $room;
			return Response::forge(View::forge('rooms/canvas', $data));
		}
		
		// nameがセットされていたら，DBに追加
		$name_query = Input::post('name');
		if (isset($name_query)) {
			$room = new Model_Room();
			$room->name = $name_query;
			$room->delete_pass = "1234";
			$room->is_deleted = false;
			$room->save();
		}
		
		// DBから削除されてないものを取得
		$rooms = Model_Room::find('all', array(
			'where' => array(
				array('is_deleted', false)
			),
		));
		
		$data['rooms'] = $rooms;
		return Response::forge(View::forge('rooms/index', $data));
	}
	
	public function action_create()
	{
		$name_query = Input::post('name');
		if (isset($name_query)) {
			
		}
	}
}