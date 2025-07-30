jQuery(document).ready(function($) {
    // --- Quick View Modal Logic ---

    // When a 'Quick View' button is clicked
    $('.service-card').on('click', '.btn-quick-view', function(e) {
        e.preventDefault();

        // Get the service type from the data attribute
        var serviceType = $(this).data('service-type');
        var serviceTypeName = $(this).data('service-type-name');
        
        // Show a loading state in the modal
        $('#quickViewModal .modal-title').text('Loading...');
        $('#quickViewModal .modal-body').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        
        // Open the Bootstrap modal
        var quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
        quickViewModal.show();

        // --- AJAX Request to Fetch Services ---
        $.ajax({
            url: smoothmigration.ajax_url, // WordPress AJAX URL (defined in functions.php)
            type: 'POST',
            data: {
                action: 'get_services_for_type', // The WordPress AJAX action hook
                service_type_slug: serviceType,   // The slug of the service type
                nonce: smoothmigration.nonce      // Security nonce
            },
            success: function(response) {
                if (response.success) {
                    // Update modal title
                    $('#quickViewModal .modal-title').text('Quick View: ' + serviceTypeName);
                    
                    // Clear modal body and build the list of services
                    var servicesHtml = '<ul class="list-group list-group-flush">';
                    if (response.data.length > 0) {
                        $.each(response.data, function(index, service) {
                            servicesHtml += '<li class="list-group-item">';
                            servicesHtml += '<h5>' + service.title + '</h5>';
                            if (service.excerpt) {
                                servicesHtml += '<p class="mb-0">' + service.excerpt + '</p>';
                            }
                            servicesHtml += '</li>';
                        });
                    } else {
                        servicesHtml += '<li class="list-group-item">No specific services have been added for this type yet.</li>';
                    }
                    servicesHtml += '</ul>';
                    
                    // Inject the HTML into the modal body
                    $('#quickViewModal .modal-body').html(servicesHtml);
                } else {
                    // Handle errors
                    $('#quickViewModal .modal-body').html('<p class="text-danger">Error: Could not load services. ' + response.data.message + '</p>');
                }
            },
            error: function() {
                // Handle AJAX errors
                $('#quickViewModal .modal-body').html('<p class="text-danger">An unexpected error occurred. Please try again.</p>');
            }
        });
    });
}); 