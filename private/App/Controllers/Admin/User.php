<?php

namespace App\Controllers\Admin;

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
		$this->view->display(__DIR__ . '/../../../../views/admin/users.php');
	}

	/**
	* @throws \App\DbException
	*/
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

	/**
     * @throws \App\DbException
     */
	public function actionSave()
	{
		$user = $this->getUser();
		if (!empty($_POST)) {
			$user->login = strip_tags($_POST['login']);
			$user->password = strip_tags($_POST['password']);
			$user->first_name = strip_tags($_POST['first-name']);
			$user->last_name = strip_tags($_POST['last-name']);
			$user->second_name = strip_tags($_POST['second-name']);
			$user->role = strip_tags($_POST['role']);
			$user->save();
		}
	}

	/**
     * @throws \App\DbException
     */
	public function actionEdit()
	{
		$this->view->user = $this->getUser();

		if($_GET['ajax'] === 'true') {
			echo json_encode($this->view->user);
		} else {
			$this->view->display(__DIR__ . '/../../../../views/admin/users.php');
		}
	}

	/**
     * @throws \App\DbException
     */
	public function actionDelete()
	{
		$user = $this->getUser();

		if (null !== $user->id) {
			$user->delete();
		}
	}

	public function actionExists()
	{
		if (!empty($_POST['login'])) {
			$user = \App\Model\User::login($_POST['login']);
			if (!empty($user)) {
				echo json_encode($user);
			} else {
				echo 0;
			}
		}
	}
}