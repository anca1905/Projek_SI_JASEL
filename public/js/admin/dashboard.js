$(document).ready(function () {
    loadData();
});

function loadData() {
    let url = $('#order-table-body').data('url');
    let action = $('#order-table-body').data('action');
    $.ajax({
        url: url,
        method: 'GET',
        success: function (data) {
            $('#order-table-body').empty();
            data.forEach(function (order) {
                $('#order-table-body').append(`
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">#${order.id.toString().padStart(3, '0')}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${order.user.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${order.manage_service?.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${order.status == 'dibatalkan' ? 'bg-red-100 text-red-800' : (order.status == 'selesai' ? 'bg-green-100 text-green-800' : (order.status == 'menunggu_konfirmasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800'))}">${order.status}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">${order.teknisi ? order.teknisi.name : 'Belum Ditugaskan'}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${new Date(order.created_at).toLocaleDateString()}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="${action.replace(':id', order.id)}"><button class="text-blue-600 hover:text-blue-900 mr-2">Detail</button></a>
                            </td>
                    </tr>
                `);
            });
        },
        error: function (error) {
            console.error('Error loading data:', error);
        }
    });
}