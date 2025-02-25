$(document).ready(function () {
    //////////////// index home ////////////////

    $.ajax({
        url: "/front-get-home",
        type: "get",
        dataType: "json",
        success: function (response) {
            console.log(response.brand);
            $.each(response.brand, function (index, items) {
                var htmlContent = `
                <div class="col-lg-3 col-md-4 col-6">
                    <!-- Brand name above the image -->
                        <div class="brand-name mb-2 text-center">
                            <p class="mb-0">${items.brand_name}</p>
                        </div>
                    <div class="client-logo text-center">
                    
                        <!-- Image with equal width and height -->
                        <img src="/admin/images/brand/${items.brand_image}" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    </div>
                </div>
            `;
                $("#brands").append(htmlContent);
            });

            //////////////////// About data ///////////////
            $('#about_title').text(response.about.about_title);
            $('#about_short_description').text(response.about.about_short_description);
            $('#about_short_description').text(response.about.about_short_description);
            $('#about_long_description').html(response.about.about_long_description);

            //////////////////// Services data ///////////////
            $.each(response.service, function(index, itemsservvice) {
                var Services = `
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch  mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box iconbox-blue">
                    <div class="icon">
                    <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        ${itemsservvice.service_icon}
                    </svg>
                    <i class="bx bxl-dribbble"></i>
                    </div>
                    <h4><a href="">${itemsservvice.service_title}</a></h4>
                    <p>${itemsservvice.service_description}</p>
                </div>
                </div>
            `;
                $("#services").append(Services);
            });



             //////////////////// Services data ///////////////
             $.each(response.clients, function(index, itemsclients) {
                var imageURL = itemsclients.client_logo;
                var base_url = "admin/upload/client/"+imageURL;
                var clients = `
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                    <img src="${base_url}" class="img-fluid" alt="">
                    </div>
                </div>
            `;
                $("#clients").append(clients);
            });

        },
        error: function (xhr, status, error) {
            console.log("Response Text:", xhr.responseText);
            $("#brand_error").html("No Record Found");
        },
    });
});
