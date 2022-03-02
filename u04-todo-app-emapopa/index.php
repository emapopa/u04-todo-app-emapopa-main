<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Task Hero</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-5">
        <h1 class="text-center">Task_Hero</h1>
        <hr style="height: 1px; color: black; background-color: black;">
      </div>
    </div>
    <div class="row">
      <div class="col-md-5 mx-auto">
        <form id="form" action="post">
          <div id="result"></div>
          <div class="form-group">
            <label for="">Title</label>
            <input type="text" id="title" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="description" cols="" rows="3" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" id="submit" class="btn btn-outline-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 mt-1">
        <div id="show"></div>
        <div id="fetch"></div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="read_data"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Modal -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="edit_data"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="update">Update</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    $(document).on("click", "#submit", function(e) {
      e.preventDefault();
      let title = $("#title").val();
      let description = $("#description").val();
      let status = $("#status").val();
      let submit = $("#submit").val();

      $.ajax({
        url: "insert.php",
        type: "post",
        data: {
          title: title,
          description: description,
          submit: submit
        },
        success: function(data) {
          fetch();
          $("#result").html(data);
        }
      })

      $("#form")[0].reset();
    });

    //Fetch tasks

    function fetch() {
      $.ajax({
        url: "fetch.php",
        type: "post",
        success: function(data) {
          $("#fetch").html(data);
        }
      });
    }
    fetch();

    //Delete

    $(document).on("click", "#del", function(e) {
      e.preventDefault();

      if (window.confirm("Are yyou sure?")) {
        var del_id = $(this).attr("value");

        $.ajax({
          url: "del.php",
          type: "post",
          data: {
            del_id: del_id
          },
          success: function(data) {
            fetch();
            $("#show").html(data);
          }
        });
      } else {
        return false;
      }

    });

    //show data

    $(document).on("click", "#read", function(e) {
      e.preventDefault();

      let read_id = $(this).attr("value");

      $.ajax({
        url: "read.php",
        type: "post",
        data: {
          read_id: read_id
        },
        success: function(data) {
          $("#read_data").html(data);
        }
      })
    });

    //Edit
    $(document).on("click", "#edit", function(e) {
      e.preventDefault();

      let edit_id = $(this).attr("value");

      $.ajax({
        url: "edit.php",
        type: "post",
        data: {
          edit_id: edit_id
        },

        success: function(data) {
          $("#edit_data").html(data);
        }
      });
    });

    //update

    $(document).on("click", "#update", function(e){
      e.preventDefault();

      let edit_title = $("#edit_title").val();
      let edit_description = $("#edit_description").val();
      let edit_status = $("#edit_status").val();
      let update = $("#update").val();
      let edit_id = $("#edit_id").val();
      

      $.ajax({
        url: "update.php",
        type: "post",
        data:{
          edit_id:edit_id,
          edit_title:edit_title,
          edit_description:edit_description,
          edit_status:edit_status,
          update:update
        },
        success: function(data){
          fetch();
          $("#show").html(data);
        }
      });
    });
  </script>
</body>

</html>