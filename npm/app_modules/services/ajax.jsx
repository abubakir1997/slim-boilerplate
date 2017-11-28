import axios from 'axios';

const ajax = axios.create({
	baseURL: localStorage.getItem('base'),
	headers: {
		'Authorization'   : localStorage.getItem('token'),
		'X-CSRFToken'     : localStorage.getItem('csrfToken'),
		'X-CSRFKey'       : localStorage.getItem('csrfKey'),
		'X-Requested-With': 'XMLHttpRequest'
	}
});

export default ajax;