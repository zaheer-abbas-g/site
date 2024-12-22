

$(document).ready(function(){

  
//////////////// index home ////////////////

  $.ajax({
    url:'/front-get-home',
    type:"get",
    dataType:"json",
    success:function(response){
        console.log(response.brand);
        $.each(response.brand,function(index,items){
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
              $('#brands').append(htmlContent);
        });
    },
    error: function(xhr, status, error) {
        console.log('Response Text:', xhr.responseText);
        $('#brand_error').html('No Record Found');
    }
  });

  
})

