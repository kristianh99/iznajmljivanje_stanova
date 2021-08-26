const url = document.location.origin + "/api/";

function ShowAlert(data, message) {
  $(function () {
    $(data).siblings(".alert").removeClass("visually-hidden");
    $(data).siblings(".alert").children(".message").text(message);
  });
}

function RemoveMessage(data) {
  $(function () {
    $(data).siblings(".alert").children(".message").text("");
    $(data).closest(".alert").addClass("visually-hidden");
  });
}

function toggleTabs(data) {
  $(function () {
    const buttons = ["first", "second"];
    buttons.forEach((el) => {
      if ($(data).hasClass(el)) {
        buttons.filter((ele) => {
          if (ele != el) {
            $(`.${ele}`).removeClass("active");
          }
        });
      }
    });
    $(data).addClass("active");
  });
}

function Update(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    RemoveMessage(data);
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type, status: "update", data: formData },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function ReservateAd(data, id) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    RemoveMessage(data);
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type: "ads", status: "reservate", data: formData + `&id=${id}` },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function Block(data, type, id) {
  $(function () {
    if (type == "user") {
      id = $(data).siblings("select").val();
    }
    RemoveMessage(data);
    $.ajax({
      url,
      data: { type, status: "block", data: `id=${id}` },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function DeleteComment(data, id) {
  $(function () {
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type: "comments", status: "delete", data: `id=${id}` },
    }).then(() => {
      $(data).closest(".single-comment").remove();
    });
  });
}

function updateComment(data, id) {
  $(function () {
    RemoveMessage(data);
    const formData = $(data).closest("form").serialize();
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: {
        type: "comments",
        status: "update",
        data: formData + `&id=${id}`,
      },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function DeleteAd(data, id) {
  $(function () {
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type: "ads", status: "delete", data: `id=${id}` },
    }).then(() => {
      $(data).closest(".single-ad").remove();
    });
  });
}

function GetEntry(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $.ajax({
      url,
      dataType: "json",
      type: "GET",
      data: { type, status: "get", data: formData },
    }).then(({ body }) => {
      $(".ads-list").empty();
      for (let index = 0; index < body["ads"].length; index++) {
        const element = body["ads"][index];
        if (element["active"] != "0") {
          $(".ads-list").append(`
          <button type='button'  data-toggle='modal' data-target='#ad-${index}' style='border: none; border-radius: 10px; width:250px; height:290px;background:transparent;'>
              <img src='uploads/${
                element["image"]
              }' height='250px' width='250px' style='border-top-right-radius: 10px; border-top-left-radius: 10px'>
              <p style='margin: 8px'>Informacije</p>
          </button>

      <div class='modal fade' id='ad-${index}' tabindex='-1' role='dialog' aria-labelledby='ad-${index}' aria-hidden='true'>
          <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 class='modal-title' id='exampleModalLongTitle'>${
                        element["property_type"]
                      }</h5>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                      </button>
                  </div>
                  <div class='modal-body'>
                      <p class='card-text'><b>Cena: </b>${
                        element["price"]
                      } € / day</p>
                      <p class='card-text'> <b>Lokacija: </b>${
                        element["location"]
                      }</p>

                      <div>
                          <div class='field-single'>
                              <label>Početak iznajmljivanja</label>
                              <input type='date' disabled value='${
                                element["rent_start"]
                              }'/>
                          </div>
                          <div class='field-single'>
                              <label>Kraj iznajmljivanja</label>
                              <input type='date' disabled value='${
                                element["rent_end"]
                              }'/>
                          </div>
                      </div>

                      <p class='card-text' style='margin-top:10px;font-size: 15px;'>${
                        element["description"]
                      }</p>
                      <p class='card-text'><small class='text-muted'>${
                        element["email"]
                      }</small></p>
                  </div>
                  ${(() => {
                    const id = sessionStorage.getItem("id");
                    if (element["rented_by"] != null) {
                      return "<div class='rented'>Već izdato</div>";
                    }
                  })()}
                  ${(() => {
                    const id = sessionStorage.getItem("id");
                    if (id != null) {
                      if (element["rented_by"] == id) {
                        return `
                              <div style='background-color:transparent;'>
                                  <form>
                                      <label style='margin-top:5px; padding-left:20px;'>Komment kod:</label>
                                      <input class='form-control' style='margin-bottom:5px;' name='verification'/>
                                      <h5 style='text-align: center;'>Komment</h5>
                                      <div class='card-footer' style='background-color:transparent;'>
                                          <textarea type='text' class='area form-control'></textarea>
                                          <button type='button' class='btn' onclick=\"sendComment(this, ${element["id"]})\">Pošalji</button>
                                          <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                              <span class='message'></span>
                                              <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                              </button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                                `;
                      } else if (element["id_user"] != id) {
                        return `
                              <div class='card-footer' style='background-color:transparent;'>
                                  <h5 style='text-align: center;'>Pošalji poruku</h5>
                                  <textarea type='text' class='area form-control'></textarea>
                                  <button type='button' class='btn' onclick=\"sendMessage(this, ${element["id_user"]})\">Pošalji</button>
                                  <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                      <span class='message'></span>
                                      <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                      </button>
                                  </div>
                              </div>
                              `;
                      } else {
                        return `
                              <div class='btn' onclick=\"DeleteAd(this, ${
                                element["id"]
                              })\">Izbiši oglasi</div>
                              <form>
                                  <select class='form-control' style='display:block;' name='rented_by'>
                                      <option disabled selected>Korisnik</option>
                                      ${body.users.map((el) => {
                                        return `
                                          <option value='${
                                            el["id_user"]
                                          }' selected='${
                                          el["id_user"] == element["rented_by"]
                                        }'>${el["email"]}</option>
                                          `;
                                      })}
                                  </select>
                                  <div class='btn' onclick=\"ReservateAd(this, ${
                                    element["id"]
                                  })\">Izdaj korisniku</div>
                                  <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                      <span class='message'></span>
                                      <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                      </button>
                                  </div>
                              </form>
                              `;
                      }
                    }
                  })()}
                  <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Zatvori</button>
                  </div>
              </div>
          </div>
      </div>
          `);
        }
        if (!body["ads"].length) {
          $(".ads-list").append(`
          <div class='row'>
            There is no active ad. 
          </div>
          `);
        }
      }
    });
  });
}

function sendComment(textarea, id) {
  $(function () {
    const formData = $(textarea).closest("form").serialize();
    const message = $(textarea).siblings("textarea").val();
    $(textarea).siblings("textarea").val("");
    RemoveMessage(textarea);
    $.ajax({
      url,
      dataType: "json",
      type: "GET",
      data: {
        type: "comments",
        status: "create",
        data: formData + `&id=${id}&message=${message}`,
      },
    }).then(({ message: resmessage }) => ShowAlert(textarea, resmessage));
  });
}

function sendMessage(textarea, id) {
  $(function () {
    const message = $(textarea).siblings("textarea").val();
    $(textarea).siblings("textarea").val("");
    $.ajax({
      url,
      dataType: "json",
      type: "GET",
      data: {
        type: "messages",
        status: "update",
        data: `id=${id}&message=${message}`,
      },
    }).then(showMessages(id));
  });
}

function showMessages(id) {
  $(function () {
    $.ajax({
      url,
      dataType: "json",
      type: "GET",
      data: { type: "messages", status: "get", data: `id=${id}` },
    }).then(({ messages }) => {
      $(".messages").empty();
      for (let index = 0; index < messages.length; index++) {
        const element = messages[index];
        $(".messages").append(`
          ${
            id == element["sender"]
              ? `<div class="messages-left"><span>${element["message"]}</span></div>`
              : `<div class="messages-right"><span>${element["message"]}</span></div>`
          }
        `);
      }
      $(".messages").scrollTop($(".messages")[0].scrollHeight);
      if ($(".actions").children().length == 0) {
        $(".actions").append(`
        <textarea class="area form-control" style="border:1px solid #34495e; border-radius:15px;"></textarea>
        <button type='button' class="btn" onclick="sendMessage(this, ${id})">Pošalji</button>
        `);
      } else {
        $(".actions button").attr("onclick", `sendMessage(this, ${id})`);
      }
    });
  });
}

// function getNotifications() {
//   $(function () {
//     $.ajax({
//       url,
//       dataType: "json",
//       type: "GET",
//       data: { type: "messages", status: "notification" },
//     }).then(({ message }) => {
//       if (message[0].seen == 0) {
//         $(".notification").css("color", "#f00 !important");
//       }
//     });
//   });
// }
// getNotifications();
// setInterval(getNotifications, 5000);

function AddNewAd(property_type) {
  $(function aync() {
    $(".ads-list").append(`
      <div class='modal fade newad' id='newad' tabindex='-1' role='dialog' aria-labelledby='newad' aria-hidden='true'>
          <div class='modal-dialog' role='document'>
            <div class='modal-content'>
              <form style='margin:20px;'> 
                <div class='form-group'>
                  <h5 class='card-title'>
                      <b>Novi oglas</b>
                      <hr>
                  </h5>
                  <div>
                    <label class="col-form-label" style='margin-top:8px;'>Lokacija</label>
                    <input class='form-control' name="location">
                  </div>
                  <div>
                    <label class="form-label" style='margin-top:8px;'>Tip nekretnine</label>
                    <select class='form-select' name="property_type">
                      ${property_type.map(
                        (el) =>
                          `<option value="${el.id}">${el.property_type}</option>`
                      )}
                    </select>
                  </div>
                  <div>
                    <label class="form-label" style='margin-top:8px;'>Opis</label>
                    <input class='form-control' name="description">
                  </div>
                  <div>
                    <label class="form-label" style='margin-top:8px;'>Cena</label>
                    <input class='form-control' name="price">
                  </div>
                  <div>
                    <label class="form-label" style='margin-top:8px;'>Slika</label>
                    <input class='form-control' type="file" id="photo">
                  </div>
                  <div>
                    <label class="form-label" style='margin-top:8px;'>Početak iznajmljivanja</label>
                    <input class='form-control' type="date" name="rent_start">
                  </div>
                  <div>
                    <label class="form-label" style='margin-top:8px;'>Kraj iznajmljivanja</label>
                    <input class='form-control' type="date" name="rent_end">
                  </div>
                  <div class='read-more btn' onclick="CreateNewAd(this)" style='margin-top:8px;'><div>
                      <i class='fas fa-arrow-circle-right'></i>
                      Napravi
                  </div></div>
                  <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                      <span class='message alert'></span>
                      <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                      </button>
                  </div>
                </div>
              <form>
              <div class='modal-footer'>
                <button type='button' class='btn btn'secondary' data-dismiss='modal'>Zatvori</button>
              </div>
            </div> 
          </div>
      </div>
    `);
    $("#newad").modal("show");
    $("#newad").on("hidden.bs.modal", function () {
      $(this).remove();
    });
  });
}

function CreateNewAd(data) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    const property = document.getElementById("photo").files[0];

    const form_data = new FormData();
    form_data.append("file", property);
    RemoveMessage(data);
    if (property) {
      $.ajax({
        url: "./uploads/uploads.php",
        data: form_data,
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
      }).then((res) => {
        let response;
        if (res) {
          response = JSON.parse(res);
        }

        $.ajax({
          url,
          data: {
            type: "ads",
            status: "create",
            data: formData + `&picture=${response?.name}`,
          },
        }).then(({ message }) => {
          ShowAlert(data, message);
        });
      });
    }
  });
}
