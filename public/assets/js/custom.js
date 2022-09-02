$('.fc-datepicker').datepicker({
    dateFormat: 'dd-mm-yy'
});

$('input[type="number"]').keydown(function (event) {
    return (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 13 || event.keyCode === 9) ? true : !isNaN(Number(event.key));
})
