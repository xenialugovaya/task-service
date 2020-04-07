<?php
session_start();
include 'header.php';
include 'edit_task.php';
include 'add_task.php';
?>

<div class="container" style="margin-top:30px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">Задачи</div>
                <div class="col-md-3" align="right">
                    <button type="button" name="create_task" id="create_task"
                        class="btn btn-success btn-sm">Создать</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="task_table">
                    <thead>
                        <tr>
                            <th>Имя пользователя</th>
                            <th>Email</th>
                            <th>Задача</th>
                            <th>Статус</th>
                            <th>Изменения</th>
                            <th>Редактировать</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>



<script>
$(document).ready(function() {

    const dataTable = $('#task_table').DataTable({
        "lengthMenu": [3, 5, 10],
        "order": [],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
        },
        "ajax": {
            url: "../../Model/tasks_fetch.php",
            type: "POST",
        }
    });

});
</script>