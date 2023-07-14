import './bootstrap';
import axios from 'axios';

const createItem = async (name, description) => {
    try {
        const response = await axios.post('/items', { name, description });
        console.log(response.data);
    } catch (error) {
        console.error(error);
    }
};

// Example usage
createItem('Example Item', 'This is an example item.');
