
{{-- Example 1 CRUD using Axios in Laravel   --}}

<html>

<head>
    <title>API Call Using AXIOS</title>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Laravel Vue Axios Post</div>
                    <div class="card-body">
                        <div style="margin: 20px">
                            <button class="btn btn-primary" onclick="getItems()">GET</button>
                            <button class="btn btn-primary" onclick="addItem()">POST</button>
                            <button class="btn btn-primary" onclick="updateItem()">UPDATE</button>
                            <button class="btn btn-primary" onclick="deleteItem()">DELETE</button>
                        </div>
                        <form id="addItemForm">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input class="form-control" type="text" name="name" placeholder="Item Name">
                            </div>
                            <div class="form-group">
                                <label for="title">Description:</label>
                                <textarea class="form-control" type="text" name="description" placeholder="Item Description"></textarea>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary" onclick="addItemRequest()">Add</button>
                            </div>
                        </form>
                        <div>
                            <h4>OUTPUT:</h4>
                            <pre id="itemList"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const itemList = document.getElementById('itemList');
        const addItemForm = document.getElementById('addItemForm');

        const getItems = async () => {
            try {
                const response = await axios.get('/items');
                const items = response.data;
                itemList.innerText = JSON.stringify(items, null, 2);
            } catch (error) {
                console.error(error);
            }
        };

        const addItemRequest = async () => {
            try {
                const formData = new FormData(addItemForm);
                const response = await axios.post('/items', formData);
                const newItem = response.data;
                itemList.innerText = JSON.stringify(newItem, null, 2);
                addItemForm.reset();
            } catch (error) {
                console.error(error);
            }
        };

        // const updateItem = async () => {
        //     try {
        //         const formData = new FormData(addItemForm);
        //         const itemId = prompt('Enter the ID of the item to update:');
        //         const response = await axios.put(`/items/${itemId}`, formData);
        //         const updatedItem = response.data;
        //         itemList.innerText = JSON.stringify(updatedItem, null, 2);
        //         addItemForm.reset();
        //     } catch (error) {
        //         console.error(error);
        //     }
        // };
        const updateItem = async () => {
            try {
                const itemId = prompt('Enter the ID of the item to update:');
                const response = await axios.get(`/items/${itemId}`);
                const item = response.data;

                if (item) {
                    const updateForm = document.createElement('form');
                    updateForm.id = 'updateItemForm';
                    updateForm.innerHTML = `
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input class="form-control" type="text" name="name" value="${item.name}" placeholder="Item Name">
                </div>
                <div class="form-group">
                    <label for="title">Description:</label>
                    <textarea class="form-control" name="description" placeholder="Item Description">${item.description}</textarea>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-primary" onclick="updateItemRequest(${itemId})">Update</button>
                </div>
            `;

                    const cardBody = document.querySelector('.card-body');
                    cardBody.appendChild(updateForm);
                } else {
                    console.log('Item not found.');
                }
            } catch (error) {
                console.error(error);
            }
        };

        const updateItemRequest = async (itemId) => {
            try {
                const updateForm = document.getElementById('updateItemForm');
                const formData = new FormData(updateForm);

                // Get CSRF token value
                const token = document.querySelector('meta[name="token"]').getAttribute('content');

                // Set headers with CSRF token
                const headers = {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': token
                };

                const response = await axios.post(`/items/${itemId}?_method=PUT`, formData, {
                    headers
                });
                const updatedItem = response.data;
                itemList.innerText = JSON.stringify(updatedItem, null, 2);

                // Remove the update form
                updateForm.remove();
            } catch (error) {
                console.error(error);
            }
        };

        // Delete Item
        const deleteItem = async () => {
            try {
                const itemId = prompt('Enter the ID of the item to delete:');
                await axios.delete(`/items/${itemId}`);
                itemList.innerText = 'Item deleted successfully';
            } catch (error) {
                console.error(error);
            }
        };
    </script>
</body>

</html
