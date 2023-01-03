$(document).ready(function () {
    $('#myTable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax_claim_record.php'
        },
        'columns': [
            { data: 'ID' },
            { data: 'date' },
            { data: 'location' },
            { data: 'phoneNo' },
            { data: 'tracking' },
        ]
    });
});