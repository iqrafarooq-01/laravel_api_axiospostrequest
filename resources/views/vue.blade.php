{{-- Vue.js Example 1  using fetch --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vue.js Example</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
  <div id="app">
    <p>@{{ message }} - @{{first_name}}</p>
    <button @click="getDataFromAPI">Fetch Data</button>
    <button @click="AnotherModeth">Fetch Data 2</button>

    <ul v-if="items.length > 0">
      <li v-for="item in items" :key="item.id">@{{ item.name }}</li>
    </ul>
    <p v-else>No items to display.</p>
  </div>

  <script>
    new Vue({
      el: '#app',
      data: {
        message: 'Hello, Vue.js!',
        items: [],
        first_name: 'Iqra'
      },
      methods: {
        getDataFromAPI() {
        //   fetch('https://jsonplaceholder.typicode.com/todos') // Replace with your API endpoint

          fetch('http://laravel-axiospostrequest.test/items') // Replace with your API endpoint
            .then(response => response.json())
            .then(data => {
              this.items = data;
            })
            .catch(error => {
              console.error('Error:', error);
            });
        },
        AnotherModeth(){
            console.log('Hi from another method')
        }
      }
    });
  </script>
</body>
</html>
