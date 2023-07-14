{{-- Vue.js Example 2  --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vue.js Example</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="app">
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="formData.name">
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="formData.email">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        // -- creates a new Vue instance.
        new Vue({
            // starting point (div id) --  uses the CSS selector #app to select the element with the id of app
            el: '#app',

            // defines the data properties used in the Vue instance
            data: {

                // form Data is the property that is an object containing the properties name and email
                formData: {
                    name: '',
                    email: '',
                }
            },
            // function
            methods: {
                // the submitForm method must have the same name as the method specified in the form's submission event.
                submitForm() {
                    // ( pass Route , and this form property  named as FormData which contain all properties of form )
                    axios.post('/save', this.formData)
                        .then(response => {
                            console.log(response.data);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            }
        });
    </script>

</body>

</html>
