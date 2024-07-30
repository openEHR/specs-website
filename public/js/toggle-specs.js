$('.toggleable_status.d-flex.d-none').toggleClass('d-flex tempToggle');
$('#toggle-RETIRED').change(function(){
    if ($(this).prop('checked')) {
        $('.tempToggle.toggleable_status.status_RETIRED').toggleClass('d-flex tempToggle');
    }
    $('.toggleable_status.status_RETIRED').toggleClass('d-none');
    $('.toggleable_status.d-flex.d-none').toggleClass('d-flex tempToggle');
});
$('#toggle-DEVELOPMENT').change(function(){
    if ($(this).prop('checked')) {
        $('.tempToggle.toggleable_status.status_DEVELOPMENT').toggleClass('d-flex tempToggle');
    }
    $('.toggleable_status.status_DEVELOPMENT').toggleClass('d-none');
    $('.toggleable_status.d-flex.d-none').toggleClass('d-flex tempToggle');
});
