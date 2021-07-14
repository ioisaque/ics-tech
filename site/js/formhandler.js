$(document).ready(function () {
  $("form").submit(function () {
    const form = $(this).attr("class");
    const data = $(this).serialize();

    console.debug(`${form} ==> `, data);

    try {
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "https://api.ideyou.com.br/mailer/",
        data: data,
        success: function (response) {
          console.debug(`${form} <== `, response);

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
