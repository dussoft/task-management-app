function sendAjaxRequest(url, method, data, successCallback, errorCallback) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            if (successCallback) {
                successCallback(response);
            }
        },
        error: function() {
            if (errorCallback) {
                errorCallback();
            }
        }
    });
}

function reorderTasks(taskIds) {
    var url = '/tasks/reorder';

    var method = "POST";

    var data = {
        taskIds: taskIds
    };

    sendAjaxRequest(url, method, data, function(response) {
        if (response.success) {
            console.log("Tasks reordered successfully.");
        } else {
            console.log("Error reordering tasks.");
        }
    }, function() {
        console.log("Error reordering tasks.");
    });
}

function deleteTask(taskId) {

    var url = '/tasks/'+ taskId;

    var method = "DELETE";
    var data = {};

    sendAjaxRequest(url, method, data, function(response) {
        
        if (response.success) {
            console.log("Task deleted successfully.");
            $("li[data-task-id='" + taskId + "']").remove();
        } else {
            console.log("Error deleting task.");
        }
    }, function() {
        console.log("Error deleting task.");
    });
}

$(function() {
    $("#tasks").sortable({
        axis: "y",
        update: function(event, ui) {
            var taskIds = $(this).sortable("toArray", { attribute: "data-task-id" });
            reorderTasks(taskIds);
        }
    });

    $(".btn-delete").on("click", function() {
        var taskId = $(this).closest("li").data("task-id");
        deleteTask(taskId);
    });

    $(".btn-edit").on("click", function() {
        var taskId = $(this).closest("li").data("task-id");

        console.log('some');
        window.location.href = '/tasks/' + taskId + '/edit'; 
    });
});
