<?php

namespace App\Controllers;

use App\Controller;

class User
	extends Controller
{
	/**
	* @throws \App\DbException
	*/
	public function actionDefault()
	{
		$users = \App\Model\User::findAll();
		$this->view->users = $users;
		$this->view->display(__DIR__ . '/../../../views/users.php');
	}

	public function getUser()
	{
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$id = $_GET['id'];
			$user = \App\Model\User::findById($id);
		} else {
			$user = new \App\Model\User();
		}
		return $user;
	}
}