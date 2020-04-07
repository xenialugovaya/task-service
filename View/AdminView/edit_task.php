<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Изменить задачу</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-daterange">
                        <form id="edit_task_form" action="../../Model/change_task.php" method="POST">
                            <textarea name="edit_task_field" id="edit_task_field" class="form-control"
                                placeholder="Изменить задачу"></textarea>
                            <input type="hidden" name="edit_task_id" id="edit_task_id" />
                            <span class="text-success" id="edit_message"></span>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" name="save_new_task" id="save_new_task"
                    class="btn btn-success btn-sm">Изменить</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Закрыть</button>
            </div>

        </div>
    </div>
</div>

<script>
$(document).on('click', '.edit_task', function() {
    const task_id = $(this).attr('id');
    $('#edit_task_id').val(task_id);
    $('#editModal').modal('show');
});

$("#save_new_task").on('click', function() {
    $("#edit_task_form").submit();
});

$('#edit_task_form').validate({
    rules: {
        "edit_task_field": {
            required: true
        }
    },
    messages: {
        "edit_task_field": {
            required: "<span class='text-danger'>Обязательное поле!</span>",
        }
    },
    submitHandler: function(form) {
        $(form).ajaxSubmit({
            type: 'POST',
            url: '../../Model/change_task.php',
            data: {
                formData: $('#edit_task_form').serialize(),
                action: 'edit'
            },
            success: function(response) {
                $('#edit_message').html('Запись успешно изменена');
                console.log(response);
            }
        });
    }
});
</script>