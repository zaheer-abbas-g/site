function generatePagination(response) {
    let aboutPagination = '';

    // Previous Button
    aboutPagination += `<li class="page-item ${response.current_page === 1 ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" aria-label="Previous" data-page="${response.current_page - 1}">
            <span aria-hidden="true" class="mdi mdi-chevron-left mr-1"></span> Prev
            <span class="sr-only">Previous</span>
        </a>
    </li>`;

    // Generate pages
    const startPage = Math.max(1, response.current_page - 1);
    const endPage = Math.min(response.last_page, response.current_page + 1);

    // Ellipsis for skipped pages before current
    if (startPage > 2) {
        aboutPagination += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }

    // Loop for page numbers
    for (let i = startPage; i <= endPage; i++) {
        aboutPagination += `<li class="page-item ${i === response.current_page ? 'active' : ''}">
            <a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a>
        </li>`;
    }

    // Ellipsis for skipped pages after current
    if (endPage < response.last_page - 1) {
        aboutPagination += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }

    // Next Button
    aboutPagination += `<li class="page-item ${response.current_page === response.last_page ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" aria-label="Next" data-page="${response.current_page + 1}">
            Next
            <span aria-hidden="true" class="mdi mdi-chevron-right ml-1"></span>
            <span class="sr-only">Next</span>
        </a>
    </li>`;

    // Showing message
    const entriesPerPage = 5; // Assume 5 entries per page
    const startRecord = (response.current_page - 1) * entriesPerPage + 1;
    const endRecord = Math.min(response.current_page * entriesPerPage, response.total);
    const showingMessage = `Showing ${startRecord} to ${endRecord} of ${response.total} entries`;

    return { paginationHtml: aboutPagination, showingMessage: showingMessage };
}






/////////////////////////  Image Preview    //////////////////////
function imagePreview(fileImage,previewImage){
  $(fileImage).on('change',function(){
            document.getElementById(previewImage).src = window.URL.createObjectURL(this.files[0]);
    });
}

            