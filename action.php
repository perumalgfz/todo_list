<?php
include_once 'class/Task.php';
$task = new Task();
$post = $_POST;
$json = array();

// Create Task functionality
if (!empty($post['action']) && $post['action'] == "create") {
	$task->setItem($post['item']);
	$task->setTitle($post['title']);
	$task->setStatus(0);

	$status = $task->createTask();
	if (!empty($status)) {
		$json['msg'] = 'success';
		$json['task_id'] = $status;
	} else {
		$json['msg'] = 'failed';
		$json['task_id'] = '';
	}
	header('Content-Type: application/json');
	echo json_encode($json);
}

// Update Task Status functionality
if (!empty($post['action']) && $post['action'] == "updateTaskStatus") {
	$task->setTaskID($post['task_id']);
	$task->setStatus($post['status']);

	$status = $task->updateTaskStatus();
	if (!empty($status)) {
		$json['msg'] = 'success';
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');
	echo json_encode($json);
}

// update functionality
if (!empty($post['action']) && $post['action'] == "update") {
	$task->setTaskID($post['task_id']);
	$task->setTitle($post['title']);
	$task->setTask($post['task']);

	$status = $task->updateTask();
	if (!empty($status)) {
		$json['msg'] = 'success';
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');
	echo json_encode($json);
}

// get by Id functionality
if (!empty($post['action']) && $post['action'] == "edit") {
	$task->setTaskID($post['task_id']);

	$status = $task->getOneTask();
	if (!empty($status)) {
		$json['msg'] = $status;
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');
	echo json_encode($json);
}

// delete functionality
if (!empty($post['action']) && $post['action'] == "delete") {
	$task->setTaskID($post['task_id']);

	$status = $task->deleteTask();
	if (!empty($status)) {
		$json['msg'] = 'success';
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');
	echo json_encode($json);
}
