$(document).ready(function () {
  $("form").submit(function () {
    const form = $(this)[0];
    const formName = $(this).attr("class");
    const data = $(this).serialize();

    console.debug(`${formName} ==> `, data);

    try {
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "https://cdn.isaque.it/mailer/",
        data: data,
        success: function (response) {
          console.debug(`${formName} <== `, response);

          $.bootstrapGrowl(response.message, {
            ele: "body",
            type: response.type,
            offset: {
              from: "top",
              amount: 150,
            },
            align: "center",
            width: "auto",
            stackup_spacing: 10,
          });

          form.reset();
        },
        error: function (request, status, error) {
          console.debug("request => ", request);
          console.debug("status => ", status);
          console.error("error => ", error);
        },
      });
    } catch (error) {
      console.error("error => ", error);
    }

    return false;
  });
});
