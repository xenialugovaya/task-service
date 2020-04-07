<div class="modal" id="formModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Новая задача</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-daterange">
                        <form id="create_task_form" action="../Model/create_task.php" method="POST">
                            <input type="text" name="user" id="user" class="form-control"
                                placeholder="Имя пользователя" />
                            <br />
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" />
                            <br />
                            <textarea name="task" id="task" class="form-control" placeholder="Задача"></textarea>
                            <span class="text-success" id="message"></span>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="hidden" name="task_id" id="task_id" />
                <button type="submit" name="save_task" id="save_task" class="btn btn-success btn-sm">Создать</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Закрыть</button>
            </div>

        </div>
    </div>
</div>

<script>
$(document).on('click', '#create_task', function() {
    $('#formModal').modal('show');
});

$("#save_task").on('click', function() {
    $("#create_task_form").submit();
});

$('#create_task_form').validate({
    rules: {
        "user": {
            required: true
        },
        "email": {
            required: true,
            email: true
        },
        "task": {
            required: true
        }
    },
    messages: {
        "user": {
            required: "<span class='text-danger'>Обязательное поле!</span>",
        },
        "email": {
            required: "<span class='text-danger'>Обязательное поле!</span>",
            email: "<span class='text-danger'>Неверный email</span>"
        },
        "task": {
            required: "<span class='text-danger'>Обязательное поле!</span>"
        }
    },
    submitHandler: function(form) {
        $(form).ajaxSubmit({
            type: 'POST',
            url: '../Model/create_task.php',
            data: {
                formData: $('#create_task_form').serialize(),
                action: 'add_task'
            },
            success: function(response) {
                $('#message').html('Запись успешно добавлена');
            }
        });
    }
});
</script>