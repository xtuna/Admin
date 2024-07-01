$(document).ready(function() {
    // Stores management functionality
    $('#stores').html(`
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">Store 1</a>
            <a href="#" class="list-group-item list-group-item-action">Store 2</a>
            <a href="#" class="list-group-item list-group-item-action">Store 3</a>
        </div>
    `);

    // Users management functionality
    $('#users').html(`
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Juan Dela Cruz</td>
                    <td>juandelacruz@iskolarngbayan.pup.edu.ph</td>
                    <td>Customer</td>
                    <td>Disabled</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Juanita Marcelo</td>
                    <td>juanitamarcelo@iskolarngbayan.pup.edu.ph</td>
                    <td>Seller</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Jose Rizal</td>
                    <td>joserizal@iskolarngbayan.pup.edu.ph</td>
                    <td>Admin</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    `);
});
$(document).ready(function() {
    // Show the first section by default
    $('.section').first().addClass('active');

    // Handle navigation
    $('#sidebar a').on('click', function(event) {
        event.preventDefault();
        $('.section').removeClass('active');
        const target = $(this).attr('href');
        $(target).addClass('active');
    });
});
