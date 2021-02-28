<?php
include_once 'class/Task.php';
$task = new Task();
$task->setStatus(2);
$taskInfo = $task->getAllTask();

include('templates/header.php');
?>
<section class="showcase">
  <div class="container">
    <!-- <div class="pb-2 mt-4 mb-2 border-bottom">
      <h2>To-Dos List</h2>
    </div> -->
    <div class="page-content page-container" id="page-content">
      <div class="card">
        <div class="card-body">
          <div class="title-card" data-toggle="modal" data-target="#task-modal"><span class="add-plus">+</span> <span class="card-title">NEW TASK</span></div>
        </div>
        <div class="list-wrapper">
          <ul class="d-flex flex-column-reverse todo-list">
            <?php foreach ($taskInfo as $key => $element) {
              if (!empty($element['status']) && $element['status'] == 1) {
                $class = 'class="completed"';
                // $checked = 'checked="checked"';
              } else {
                $class = '';
                // $checked = '';
              }
            ?>

              <li <?php print $class; ?>>
                <div class="form-check">
                  <label class="form-check-label">
                    <?php print $element['title']; ?>
                  </label>
                  <label class="form-check-label">
                    <span class="txt-decoration" data-utaskid="<?php print $element['id']; ?>"> <?php print $element['task']; ?>
                      <i class="input-helper"></i> </span>
                  </label>
                </div>
                <div class="actions">
                  <i data-etaskid="<?php print $element['id']; ?>" class="edit fa fa-pen" data-toggle="modal" data-target="#task-modal-edit"></i>

                  <i data-dtaskid="<?php print $element['id']; ?>" class="remove fa fa-trash"></i>
                </div>
              </li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<?php include('templates/footer.php'); ?>



<!-- MODEL -->
<div id="task-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Add Task</h3>
        <a class="close" data-dismiss="modal">×</a>
      </div>
      <form id="taskForm" name="task" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control todo-list-title" placeholder="Task title">
          </div>
          <div class="form-group">
            <label for="name">Task</label>
            <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
          </div>
          <span class="err-cls" style="display: none;color:red"> </span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- MODEL END-->
<!-- EDIT MODEL -->
<div id="task-modal-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Update Task</h3>
        <a class="close" data-dismiss="modal">×</a>
      </div>
      <form id="taskForm2" name="task" role="form">

        <div class="modal-body">
          <div class="form-group">
            <label for="name">Title</label>
            <input type="text" id="title" class="form-control todo-list-title" placeholder="Task title">
          </div>

          <div class="form-group">
            <label for="name">Task</label>
            <input type="hidden" id="task_id" name="task_id" class="form-control">
            <input type="text" id="task" class="form-control todo-list-input" placeholder="What do you need to do today?">
          </div>
          <span class="err-cls" style="display: none;color:red"> </span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button class="update btn btn-primary font-weight-bold todo-list-update-btn">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- EDIT MODEL END-->